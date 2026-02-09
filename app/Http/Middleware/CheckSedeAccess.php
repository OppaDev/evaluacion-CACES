<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Universidad;
use App\Models\Evaluacion;
use Illuminate\Support\Facades\Auth;

class CheckSedeAccess
{
    /**
     * Verifica si el usuario tiene acceso a la sede/evaluación solicitada
     * 
     * Reglas de acceso:
     * - Admin: acceso total
     * - SedeR (Responsable de Sede): solo a su sede asignada
     * - Otros usuarios: solo a sedes donde tienen permisos específicos
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        
        // Admin tiene acceso total
        if ($user->can('admin')) {
            return $next($request);
        }

        // Obtener el ID de la sede según el tipo de ruta
        $uniId = $this->getUniversidadId($request);
        
        if (!$uniId) {
            return $next($request);
        }

        // Verificar acceso a la sede
        if (!$this->userHasAccessToSede($user, $uniId)) {
            session()->flash('error', 'No tiene permiso para acceder a esta sede.');
            return redirect()->route('universidades.index');
        }

        return $next($request);
    }

    /**
     * Obtiene el ID de la universidad desde la request
     */
    private function getUniversidadId(Request $request): ?int
    {
        $routeName = $request->route()->getName() ?? '';
        
        // Si la ruta tiene parámetro de universidad directamente
        if ($request->route('universidad')) {
            return (int) $request->route('universidad');
        }
        
        // Rutas que usan ID de universidad directamente
        $universidadRoutes = ['evaluaciones.show', 'historico.index', 'historico.grafico.index'];
        
        // Para rutas de resource de evaluaciones (Laravel genera 'evaluacione' como parámetro)
        if ($request->route('evaluacione')) {
            $evaluacionId = $request->route('evaluacione');
            
            // Si es evaluaciones.show, el parámetro es en realidad uni_id
            if ($routeName === 'evaluaciones.show') {
                return (int) $evaluacionId;
            }
            
            // Para otras rutas de evaluación, buscar la evaluación
            $evaluacion = Evaluacion::find($evaluacionId);
            if ($evaluacion) {
                return $evaluacion->uni_id;
            }
        }
        
        // Si la ruta tiene parámetro 'id'
        if ($request->route('id')) {
            // Rutas que usan ID de universidad directamente
            if (in_array($routeName, $universidadRoutes)) {
                return (int) $request->route('id');
            }
            
            // Rutas que usan ID de evaluación - obtener la universidad desde la evaluación
            $evaluacionRoutes = [
                'evaluaciones.edit', 'evaluaciones.destroy', 'indicadores.index', 
                'criterio', 'resultado', 'informes.criterios.index', 'informes.mejora',
                'criteria.assignments.show', 'indicador.assignments.show',
                'personal.academico.informeGeneral', 'personal.academico.informeEspecifico'
            ];
            
            if (in_array($routeName, $evaluacionRoutes)) {
                $evaluacion = Evaluacion::find($request->route('id'));
                if ($evaluacion) {
                    return $evaluacion->uni_id;
                }
            }
        }
        
        // Para rutas con parámetro eva_id (como criterio, resultado)
        if ($request->route('eva_id')) {
            $evaluacion = Evaluacion::find($request->route('eva_id'));
            if ($evaluacion) {
                return $evaluacion->uni_id;
            }
        }
        
        // Para resource de criteria-assignments e indicador-assignments
        if ($request->route('criteria_assignment') || $request->route('indicador_assignment')) {
            $evalId = $request->route('criteria_assignment') ?? $request->route('indicador_assignment');
            $evaluacion = Evaluacion::find($evalId);
            if ($evaluacion) {
                return $evaluacion->uni_id;
            }
        }

        return null;
    }

    /**
     * Verifica si el usuario tiene acceso a una sede específica
     */
    private function userHasAccessToSede($user, int $uniId): bool
    {
        // Viewer tiene acceso a ver todas las sedes
        if ($user->hasRole('Viewer')) {
            return true;
        }
        
        // Responsable de Sede solo a su sede  
        if ($user->hasRole('SedeR')) {
            return $user->esResponsableDeSede($uniId);
        }
        
        // Verificar si el usuario tiene la sede asignada en user_has_universidads
        if ($user->universidades()->where('universidads.id', $uniId)->exists()) {
            return true;
        }
        
        // Verificar si tiene algún permiso para evaluaciones de esta sede
        $evaluacionesIds = Evaluacion::where('uni_id', $uniId)->pluck('id')->toArray();
        foreach ($user->getAllPermissions() as $permission) {
            foreach ($evaluacionesIds as $evaId) {
                if (str_starts_with($permission->name, "$evaId/") || str_starts_with($permission->name, "$evaId-")) {
                    return true;
                }
            }
        }
        
        return false;
    }
}
