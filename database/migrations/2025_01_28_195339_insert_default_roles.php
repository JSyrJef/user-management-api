<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
   /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Insertar roles por defecto
        DB::table('roles')->insert([
            ['name' => 'client', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'admin', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('roles')->where('name', 'client')->delete();
        DB::table('roles')->where('name', 'admin')->delete();
    }
};
