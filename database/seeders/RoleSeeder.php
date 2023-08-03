<?php

namespace Database\Seeders;

use App\Model\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superUser = Role::where('id', 1)->first();
        if (!isset($superUser)) {
            Role::create([
                'name' => 'admin',
            ]);
        }
        $operator = Role::where('id', 2)->first();
        if (!isset($operator)) {
            $jsonData = '[
                {"url": "/ticket", "method": "get"},
                {"url": "/ticket/updateStatus/*", "method": "post"},
                {"url": "/ticket/*/consult", "method": "get"},
                {"url": "/ticket/*/consult/create", "method": "get"},
                {"url": "/ticket/*/consult", "method": "post"}
            ]';
            $roleOperator = json_decode($jsonData, true);
            Role::create([
                'name' => 'operator',
                'permissions' => $roleOperator,
            ]);
        }
        $user = Role::where('id', 3)->first();
        if (!isset($user)) {
            $jsonData = '[
                {"url": "/ticket", "method": "get"},
                {"url": "/ticket/create", "method": "get"},
                {"url": "/ticket", "method": "post"},
                {"url": "/ticket/*/edit", "method": "get"},
                {"url": "/ticket/*", "method": "put"},
                {"url": "/ticket/*", "method": "delete"},
                {"url": "/ticket/updateStatus/*", "method": "post"},
                {"url": "/ticket/*/consult", "method": "get"},
                {"url": "/ticket/*/consult/create", "method": "get"},
                {"url": "/ticket/*/consult", "method": "post"}
            ]';

            $endpointsArray = json_decode($jsonData, true);
            Role::create([
                'name' => 'user',
                'permissions' => $endpointsArray,
            ]);
        }
    }
}
