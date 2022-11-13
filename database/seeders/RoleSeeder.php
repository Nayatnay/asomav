<?php

namespace Database\Seeders;

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
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'comun']);

        Permission::create(['name' => 'ppal.index'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'buzon.index'])->syncRoles([$role1, $role2]);
        
        Permission::create(['name' => 'perfil.index'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'perfil.edit'])->syncRoles([$role1, $role2]);

        Permission::create(['name' => 'usuarios.index'])->assignRole($role1);
        Permission::create(['name' => 'usuarios.create'])->assignRole($role1);
        Permission::create(['name' => 'usuarios.edit'])->assignRole($role1);       
        Permission::create(['name' => 'usuarios.destroy'])->assignRole($role1);
        Permission::create(['name' => 'usuarios-cxc'])->assignRole($role1);
        Permission::create(['name' => 'usuarios-mov'])->assignRole($role1);

        Permission::create(['name' => 'gastos.index'])->assignRole($role1);
        Permission::create(['name' => 'gastos.create'])->assignRole($role1);
        Permission::create(['name' => 'gastos.edit'])->assignRole($role1);
        Permission::create(['name' => 'gastos.destroy'])->assignRole($role1);

        Permission::create(['name' => 'comunicados.index'])->assignRole($role1);
        Permission::create(['name' => 'comunicados.create'])->assignRole($role1);
        Permission::create(['name' => 'comunicados.edit'])->assignRole($role1);
        Permission::create(['name' => 'comunicados.destroy'])->assignRole($role1);

        Permission::create(['name' => 'facturas.index'])->assignRole($role1);
        Permission::create(['name' => 'facturas.create'])->assignRole($role1);
        Permission::create(['name' => 'facturas.edit'])->assignRole($role1);
        Permission::create(['name' => 'facturas.destroy'])->assignRole($role1);
        Permission::create(['name' => 'facturas.show'])->assignRole($role1);
        Permission::create(['name' => 'facturas.detallesFACTURA'])->assignRole($role1);
        Permission::create(['name' => 'facturas.verCTASXC'])->assignRole($role1);

        Permission::create(['name' => 'fondos.index'])->assignRole($role1);
        Permission::create(['name' => 'fondos.create'])->assignRole($role1);
        Permission::create(['name' => 'fondos.edit'])->assignRole($role1);
        Permission::create(['name' => 'fondos.destroy'])->assignRole($role1);
        
        Permission::create(['name' => 'fondos-egresos'])->assignRole($role1);
        Permission::create(['name' => 'fondos-reservas'])->assignRole($role1);
        Permission::create(['name' => 'fondos-reservas-create'])->assignRole($role1);
        Permission::create(['name' => 'fondos-pagos'])->assignRole($role1);
        Permission::create(['name' => 'fondos-pagos-cxp'])->assignRole($role1);
        
        Permission::create(['name' => 'ver-conciliar-pagos'])->assignRole($role1);
        Permission::create(['name' => 'conciliar-pagos'])->assignRole($role1);
        Permission::create(['name' => 'conciliar-deuda'])->assignRole($role1);

        Permission::create(['name' => 'gastos-proveedores'])->assignRole($role1);

    }
}
