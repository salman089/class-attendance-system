<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('classroom_id')
                ->references('id')->on('classrooms')
                ->onDelete('set null');
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->foreign('head_of_department_id')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['classroom_id']);
        });

        Schema::table('classrooms', function (Blueprint $table) {
            $table->dropForeign(['head_of_department_id']);
        });
    }
};
