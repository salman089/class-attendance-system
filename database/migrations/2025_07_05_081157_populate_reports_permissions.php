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
        $reportsCategoryID = DB::table('permission_categories')->where('name', 'Reports')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'view_reports',
                'title' => 'View',
                'description' => 'Can view reports',
                'category_id' => $reportsCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'download_reports',
                'title' => 'Download',
                'description' => 'Can download reports',
                'category_id' => $reportsCategoryID,
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
