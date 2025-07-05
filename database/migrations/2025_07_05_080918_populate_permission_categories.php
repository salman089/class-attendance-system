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
                'name' => 'Head of Department',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Teacher',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Class Representative',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student',
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
