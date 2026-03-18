<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permiso generales de administrador
        $adminPermission=Permission::firstOrCreate(['name'=> 'admin']);

        //Permisos criterios
        $criterio1Permission=Permission::firstOrCreate(['name'=> 'criterio_1']);
        $criterio2Permission=Permission::firstOrCreate(['name'=> 'criterio_2']);
        $criterio3Permission=Permission::firstOrCreate(['name'=> 'criterio_3']);
        $criterio4Permission=Permission::firstOrCreate(['name'=> 'criterio_4']);
        $criterio5Permission=Permission::firstOrCreate(['name'=> 'criterio_5']);
        $criterio6Permission=Permission::firstOrCreate(['name'=> 'criterio_6']);

        //Permisos de gestión de sede (SedeR)
        $gestionSedePermission=Permission::firstOrCreate(['name'=> 'gestion_sede']);
        $asignarCriteriaPermission=Permission::firstOrCreate(['name'=> 'asignar_criteria']);
        $asignarIndicadorPermission=Permission::firstOrCreate(['name'=> 'asignar_indicador']);

        // Crear roles (mantener orden original para compatibilidad de IDs)
        $admin=Role::firstOrCreate(['name' => 'Admin']);       // ID 1
        $criteria_r=Role::firstOrCreate(['name'=> 'CriteriaR']); // ID 2
        $indicator_r=Role::firstOrCreate(['name'=> 'IndicatorR']); // ID 3  
        $viewer=Role::firstOrCreate(['name'=> 'Viewer']);      // ID 4
        $sede_r=Role::firstOrCreate(['name'=> 'SedeR']);       // ID 5 - Responsable de Sede (nuevo)   

        // Asignar permisos al Admin (todos)
        $admin->givePermissionTo([
            $adminPermission,
            $criterio1Permission, $criterio2Permission, $criterio3Permission,
            $criterio4Permission, $criterio5Permission, $criterio6Permission,
            $gestionSedePermission, $asignarCriteriaPermission, $asignarIndicadorPermission
        ]);

        // Asignar permisos al SedeR (gestión de su sede y asignación de usuarios)
        $sede_r->givePermissionTo([
            $gestionSedePermission, 
            $asignarCriteriaPermission, 
            $asignarIndicadorPermission,
            $criterio1Permission, $criterio2Permission, $criterio3Permission,
            $criterio4Permission, $criterio5Permission, $criterio6Permission
        ]);
    }
}
