<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('type', ['image', 'script', 'code'])->default('image'); // Image, JS Script, or HTML Code
            $table->text('value'); // Stores image path or script/code
            $table->string('url')->nullable(); // Target URL if type is image
            $table->string('position')->default('sidebar'); // e.g. header_top, sidebar_right, home_middle
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
