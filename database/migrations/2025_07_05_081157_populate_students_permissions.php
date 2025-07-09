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
        $studentCategoryID = DB::table('permission_categories')->where('name', 'Students')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_students',
                'title' => 'List',
                'description' => 'Can list all students',
                'category_id' => $studentCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_students',
                'title' => 'Create',
                'description' => 'Can create a new student',
                'category_id' => $studentCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_students',
                'title' => 'Edit',
                'description' => 'Can edit a students',
                'category_id' => $studentCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete_students',
                'title' => 'Delete',
                'description' => 'Can delete students',
                'category_id' => $studentCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_students',
                'title' => 'View',
                'description' => 'Can view details of students',
                'category_id' => $studentCategoryID,
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
