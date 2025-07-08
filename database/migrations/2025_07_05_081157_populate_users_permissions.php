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
        $userCategoryID = DB::table('permission_categories')->where('name', 'Users')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_users',
                'title' => 'List',
                'description' => 'Can list all users',
                'category_id' => $userCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_users',
                'title' => 'Create',
                'description' => 'Can create a new user',
                'category_id' => $userCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_users',
                'title' => 'Edit',
                'description' => 'Can edit a users',
                'category_id' => $userCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete_users',
                'title' => 'Delete',
                'description' => 'Can delete users',
                'category_id' => $userCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_users',
                'title' => 'View',
                'description' => 'Can view details of users',
                'category_id' => $userCategoryID,
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
