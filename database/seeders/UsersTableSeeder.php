<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
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
        $password = Hash::make('secret');
        $verification_time = \Carbon\Carbon::now();

        $administrator = [
            'super-delete' => true,
            'super-add' => true,
            'super-update' => true,
            'super-view' => true,
        ];

        $administrator_user = Role::create([
            'name' => 'administrator',
            'display_name'=>'Administrator',
            'permissions' => $administrator,
            'guard_name'=>'web'
        ]);

        $administrator = User::create(['name' => 'Admin', 'email' => 'admin@ec-rinp.co.za','is_approved'=>'Yes',
            'email_verified_at' => $verification_time, 'password' => $password]);
        $administrator->roles()->attach($administrator_user->id);

        $notAssigned = [
            'super-delete' => true,
            'super-add' => true,
            'super-update' => true,
            'super-view' => true,
        ];

        $notAssigned_user = Role::create([
            'name' => 'not assigned',
            'display_name'=>'Not Assigned',
            'permissions' => $notAssigned,
            'guard_name'=>'web'
        ]);

        $innovator = [
            'super-delete' => true,
            'super-add' => true,
            'super-update' => true,
            'super-view' => true,
        ];

        $innovator_user = Role::create([
            'name' => 'innovator',
            'display_name'=>'Innovator',
            'permissions' => $innovator,
            'guard_name'=>'web'
        ]);


        /* DB::table('users')->insert([
             'name' => 'Admin Admin',
             'email' => 'admin@ec-rinp.com',
             'role' => 'admin',
             'email_verified_at' => now(),
             'password' => Hash::make('secret'),
             'created_at' => now(),
             'updated_at' => now()
         ]);*/
    }
}
