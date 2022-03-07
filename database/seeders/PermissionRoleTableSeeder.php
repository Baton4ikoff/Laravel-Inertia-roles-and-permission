<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{

    public function run()
    {

        \DB::table('permission_role')->delete();

        $permissionsRoles = [
            [
                'role_id'       => 1,
                'permission_id' => 1,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 2,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 3,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 4,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 5,
            ],
        ];

        \DB::table('permission_role')->insert($permissionsRoles);

    }

}
