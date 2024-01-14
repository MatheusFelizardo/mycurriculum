<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('languages')->insert([
            ['name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'French', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Spanish', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Chinese (Mandarin)', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hindi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Arabic', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Portuguese', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Bengali', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Russian', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Japanese', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'German', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
