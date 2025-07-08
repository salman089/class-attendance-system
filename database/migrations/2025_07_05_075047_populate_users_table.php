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
                'address_line_1' => 'Shaukat Electrics Works',
                'address_line_2' => 'Kalkai Kond',
                'city' => 'Dapoli',
                'state' => 'Maharashtra',
                'postcode' => '415712',
                'country' => 'India',
                'phone' => '+919373486979',
                'date_of_birth' => '2005-04-14',
                'gender' => 'male',
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
