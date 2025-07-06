<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         DB::table('users')->insert([
            [ 'name' => 'Salman Kazi',
                'email' => 'sskazi089@gmail.com',
                'password' => Hash::make('password'),
                'address' => 'Dapoli',
                'phone' => '+919373486979',
                'date_of_birth' => '2005-04-14',
                'is_superuser' => true,
                'is_active' => true,
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
