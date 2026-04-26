<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('duration');
            $table->decimal('price', 10, 2)->default(0);
            $table->string('level'); // beginner, intermediate, advanced
            $table->json('curriculum')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('views')->default(0);
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};