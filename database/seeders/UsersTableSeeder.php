<?php
namespace Database\Seeders;
use App\Models\User;
use App\Acme\Core;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Admin
        $user = User::create([
            'name' => "Admin",
            'email' => "admin@teamwa7ed.com",
            'password' => 'secret',
            'email_verified_at' => now(),
        ]);
        $user->assignRole('admin');

//        $user->addHashedMedia(public_path('assets/admin/img/avatars/avatar_' . rand(1, 6) . '.png'))
//            ->preservingOriginal()
//            ->toMediaCollection('avatar');
       // $user->syncRoles(['admin']);

    }
}