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
        $adminPermission=Permission::create(['name'=> 'admin']);

        //Permisos criterios
        $criterio1Permission=Permission::create(['name'=> 'criterio_1']);
        $criterio2Permission=Permission::create(['name'=> 'criterio_2']);
        $criterio3Permission=Permission::create(['name'=> 'criterio_3']);
        $criterio4Permission=Permission::create(['name'=> 'criterio_4']);
        $criterio5Permission=Permission::create(['name'=> 'criterio_5']);
        $criterio6Permission=Permission::create(['name'=> 'criterio_6']);

        //Permisos de gestión de sede (SedeR)
        $gestionSedePermission=Permission::create(['name'=> 'gestion_sede']);
        $asignarCriteriaPermission=Permission::create(['name'=> 'asignar_criteria']);
        $asignarIndicadorPermission=Permission::create(['name'=> 'asignar_indicador']);

        // Crear roles (mantener orden original para compatibilidad de IDs)
        $admin=Role::create(['name' => 'Admin']);       // ID 1
        $criteria_r=Role::create(['name'=> 'CriteriaR']); // ID 2
        $indicator_r=Role::create(['name'=> 'IndicatorR']); // ID 3  
        $viewer=Role::create(['name'=> 'Viewer']);      // ID 4
        $sede_r=Role::create(['name'=> 'SedeR']);       // ID 5 - Responsable de Sede (nuevo)   

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
