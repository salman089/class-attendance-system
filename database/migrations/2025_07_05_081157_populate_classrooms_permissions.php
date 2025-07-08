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
        $classroomCategoryID = DB::table('permission_categories')->where('name', 'Classrooms')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_classrooms',
                'title' => 'List',
                'description' => 'Can list all classrooms',
                'category_id' => $classroomCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_classrooms',
                'title' => 'Create',
                'description' => 'Can create a new classroom',
                'category_id' => $classroomCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_classrooms',
                'title' => 'Edit',
                'description' => 'Can edit a classrooms',
                'category_id' => $classroomCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete_classrooms',
                'title' => 'Delete',
                'description' => 'Can delete classrooms',
                'category_id' => $classroomCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_classrooms',
                'title' => 'View',
                'description' => 'Can view details of classrooms',
                'category_id' => $classroomCategoryID,
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
