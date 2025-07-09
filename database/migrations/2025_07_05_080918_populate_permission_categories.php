<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('permission_categories')->insert([
            [
                'name' => 'Users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Classrooms',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Subjects',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Students',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Attendance',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Reports',
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
