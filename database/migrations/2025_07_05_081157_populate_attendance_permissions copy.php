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
        $dashboardCategoryID = DB::table('permission_categories')->where('name', 'Dashboard')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'admin_dashboard',
                'title' => 'Admin',
                'description' => 'Give access to admin dashboard',
                'category_id' => $dashboardCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'hod_dashboard',
                'title' => 'Head of Department',
                'description' => 'Give access to head of department dashboard',
                'category_id' => $dashboardCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'student_dashboard',
                'title' => 'Student',
                'description' => 'Give access to student dashboard',
                'category_id' => $dashboardCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'teacher_dashboard',
                'title' => 'Teacher',
                'description' => 'Give access to teacher dashboard',
                'category_id' => $dashboardCategoryID,
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
