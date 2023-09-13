<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Seed the User's table data.
     */
    public function run()
    {

        $list = [
            [
                'name' => 'admin',
                'display_name' => 'Admin',
            ],
        ];

        foreach ($list as $k => $v) {
            if(!Role::where('name',$v['name'])->count()){
                $role = Role::create($v);
                if($k == 0){
                    $role->syncPermissions(Permission::get());
                }
            }
            
        }

    }
}
