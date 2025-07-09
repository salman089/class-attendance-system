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
        $attendanceCategoryID = DB::table('permission_categories')->where('name', 'Attendance')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_attendance',
                'title' => 'List',
                'description' => 'Can view attendance records',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'mark_attendance',
                'title' => 'Mark',
                'description' => 'Can mark attendance',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_attendance',
                'title' => 'Edit',
                'description' => 'Can edit a attendance record',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete_attendance',
                'title' => 'Delete',
                'description' => 'Can delete a attendance record',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_attendance',
                'title' => 'View',
                'description' => 'Can view details of a attendance record',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'export_attendance',
                'title' => 'Export',
                'description' => 'Can export a attendance record',
                'category_id' => $attendanceCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ]
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
