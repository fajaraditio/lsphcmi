<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = json_decode(file_get_contents(storage_path('db-json/users.json')), true);

        foreach ($users as $user) {
            $role = Role::firstOrCreate(
                [
                    'slug' => $user['role']['slug']
                ],
                [
                    'name' => $user['role']['name']
                ]
            );

            if (!empty($user['email'])) {
                User::updateOrCreate(
                    [
                        'email' => $user['email'],
                    ],
                    [
                        'name'      => $user['name'],
                        'password'  => Hash::make($user['password']),
                        'role_id'   => $role->id,
                        'email_verified_at' => Carbon::now(),
                    ]
                );
            }
        }
    }
}
