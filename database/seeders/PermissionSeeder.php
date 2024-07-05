<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = Permission::where('name', '=', 'dashboard.index')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "dashboard.index";
            $permission->alias = "View Dashboard Cards";
            $permission->description = "To view the dashboard cards";
            $permission->permission_group = "Dashboard";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'user.index')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "user.index";
            $permission->alias = "View Users";
            $permission->description = "To view the list of members";
            $permission->permission_group = "User";

            $permission->save();
        }

        // $permission = Permission::where('name', '=', 'user.create')->first();

        // if($permission == null)
        // {
        //     $permission = new Permission();

        //     $permission->name = "user.create";
        //     $permission->alias = "Create Members";
        //     $permission->description = "To create a new user";
        //     $permission->permission_group = "User";

        //     $permission->save();
        // }


        $permission = Permission::where('name', '=', 'user.assign_role')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "user.assign_role";
            $permission->alias = "Assign Roles";
            $permission->description = "To assign roles to members";
            $permission->permission_group = "User";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'user.approve')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "user.approve";
            $permission->alias = "Approve Members";
            $permission->description = "To approve a member";
            $permission->permission_group = "User";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'user.delete')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "user.delete";
            $permission->alias = "Delete Members";
            $permission->description = "To delete a member";
            $permission->permission_group = "User";

            $permission->save();
        }

        // PERMISSION GROUP - ROLE

        $permission = Permission::where('name', '=', 'role.index')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "role.index";
            $permission->alias = "View Roles";
            $permission->description = "To view the list of roles";
            $permission->permission_group = "User";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'role.create')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "role.create";
            $permission->alias = "Create Roles";
            $permission->description = "To create a new role";
            $permission->permission_group = "User";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'role.edit')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "role.edit";
            $permission->alias = "Edit Roles";
            $permission->description = "To edit a role";
            $permission->permission_group = "User";

            $permission->save();
        }

        $permission = Permission::where('name', '=', 'role.assign_permission')->first();

        if($permission == null)
        {
            $permission = new Permission();

            $permission->name = "role.assign_permission";
            $permission->alias = "Assign Permissions";
            $permission->description = "To assign permissions to roles";
            $permission->permission_group = "User";

            $permission->save();
        }
    }
}
