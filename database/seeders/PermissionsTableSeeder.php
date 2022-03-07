<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_index',
            ],
            [
                'id'    => 2,
                'title' => 'user_create',
            ],
            [
                'id'    => 3,
                'title' => 'user_show',
            ],
            [
                'id'    => 4,
                'title' => 'user_edit',
            ],
            [
                'id'    => 5,
                'title' => 'user_destroy',
            ],
        ];

        Permission::insert($permissions);
    }
}
