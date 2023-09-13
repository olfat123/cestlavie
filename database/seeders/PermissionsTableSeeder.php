<?php
namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Schema;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Seed the User's table data.
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table((new Permission())->getTable())->truncate();
       // DB::table('permission_role')->truncate();
        $data = [
            [
                'name' => 'view_dashboard',
                'display_name' => 'View Dashboard',
                'group' => 'Dashboard',
            ],

            [
                'name' => 'view_pages',
                'display_name' => 'View Static Pages',
                'group' => 'Static Pages',
            ],
            [
                'name' => 'edit_pages',
                'display_name' => 'Edit Static Pages',
                'group' => 'Static Pages',
            ],

            [
                'name' => 'view_vendors',
                'display_name' => 'View Vendors',
                'group' => 'Vendors',
            ],
            [
                'name' => 'edit_vendors',
                'display_name' => 'Edit Vendors',
                'group' => 'Vendors',
            ],
            [
                'name' => 'add_vendors',
                'display_name' => 'Add Vendors',
                'group' => 'Vendors',
            ],
            [
                'name' => 'delete_vendors',
                'display_name' => 'Delete Vendors',
                'group' => 'Vendors',
            ],

            [
                'name' => 'view_transactions',
                'display_name' => 'View Transactions',
                'group' => 'Transactions',
            ],

            [
                'name' => 'view_shows',
                'display_name' => 'View Shows',
                'group' => 'Shows',
            ],
            [
                'name' => 'add_shows',
                'display_name' => 'Add Shows',
                'group' => 'Shows',
            ],
            [
                'name' => 'edit_shows',
                'display_name' => 'Edit Shows',
                'group' => 'Shows',
            ],
            [
                'name' => 'delete_shows',
                'display_name' => 'Delete Shows',
                'group' => 'Shows',
            ],

            [
                'name' => 'view_reservations',
                'display_name' => 'View Reservations',
                'group' => 'Reservations',
            ],
            [
                'name' => 'add_reservations',
                'display_name' => 'Add Reservations',
                'group' => 'reservations',
            ],
            [
                'name' => 'edit_reservations',
                'display_name' => 'Edit Reservations',
                'group' => 'Reservations',
            ],
            [
                'name' => 'delete_reservations',
                'display_name' => 'Delete Reservations',
                'group' => 'Reservations',
            ],

            [
                'name' => 'add_events',
                'display_name' => 'Add Events',
                'group' => 'Events',
            ],
            [
                'name' => 'view_events',
                'display_name' => 'View Events',
                'group' => 'Events',
            ],
            [
                'name' => 'edit_events',
                'display_name' => 'Edit events',
                'group' => 'Events',
            ],
            [
                'name' => 'delete_events',
                'display_name' => 'Delete Events',
                'group' => 'Events',
            ],

            [
                'name' => 'view_roles',
                'display_name' => 'View Roles',
                'group' => 'Roles',
            ],
            [
                'name' => 'add_roles',
                'display_name' => 'Add Roles',
                'group' => 'Roles',
            ],
            [
                'name' => 'edit_roles',
                'display_name' => 'Edit Roles',
                'group' => 'Roles',
            ],
            [
                'name' => 'delete_roles',
                'display_name' => 'Delete Roles',
                'group' => 'Roles',
            ],

            [
                'name' => 'view_admins',
                'display_name' => 'View Admins',
                'group' => 'Admins',
            ],
            [
                'name' => 'add_admins',
                'display_name' => 'Add Admins',
                'group' => 'Admins',
            ],
            [
                'name' => 'edit_admins',
                'display_name' => 'Edit Admins',
                'group' => 'Admins',
            ],
            [
                'name' => 'delete_admins',
                'display_name' => 'Delete Admins',
                'group' => 'Admins',
            ],
        ];
        Permission::insert($data);
       // Role::where('name','admin')->first()->attachPermissions(Permission::get());
    }
}
