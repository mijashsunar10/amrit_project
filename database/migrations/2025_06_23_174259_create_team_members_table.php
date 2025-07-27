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
        Schema::create('team_members', function (Blueprint $table) {
            $table->id();
             $table->string('name');
             $table->string('position');
             $table->text('bio');
             $table->string('image_path');
             $table->string('social_instagram')->nullable();
             $table->string('social_facebook')->nullable();
             $table->integer('order')->default(0); // For sorting team members
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('team_members');
    }
};
