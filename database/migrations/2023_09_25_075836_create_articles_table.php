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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id');
            $table->foreignId('author_id');
            $table->foreignId('city_id')->nullable();
            $table->string('thumbnail');
            $table->longText('title');
            $table->longText('lead');
            $table->longText('body');
            $table->longText('slug');
            $table->longText('meta_title');
            $table->longText('meta_description');
            $table->boolean('status');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
