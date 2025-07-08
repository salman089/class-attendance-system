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
        $subjectCategoryID = DB::table('permission_categories')->where('name', 'Subjects')->first()->id;

        DB::table('permissions')->insert([
            [
                'name' => 'list_subjects',
                'title' => 'List',
                'description' => 'Can list all subjects',
                'category_id' => $subjectCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'create_subjects',
                'title' => 'Create',
                'description' => 'Can create a new subject',
                'category_id' => $subjectCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'edit_subjects',
                'title' => 'Edit',
                'description' => 'Can edit a subjects',
                'category_id' => $subjectCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'delete_subjects',
                'title' => 'Delete',
                'description' => 'Can delete subjects',
                'category_id' => $subjectCategoryID,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'view_subjects',
                'title' => 'View',
                'description' => 'Can view details of subjects',
                'category_id' => $subjectCategoryID,
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
