<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $hodCategoryID = DB::table('permission_categories')->where('name', 'Head of Department')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_classes',
                'title' => 'List Classes',
                'description' => 'Can view list of all classes',
                'category_id' => $hodCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manage_teachers',
                'title' => 'Manage Teachers',
                'description' => 'Can assign or remove teachers',
                'category_id' => $hodCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_attendance_reports',
                'title' => 'View Reports',
                'description' => 'Can view attendance reports of all classes',
                'category_id' => $hodCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'export_attendance',
                'title' => 'Export Attendance',
                'description' => 'Can export attendance records',
                'category_id' => $hodCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'manage_roles',
                'title' => 'Manage Roles',
                'description' => 'Can manage roles and permissions',
                'category_id' => $hodCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
