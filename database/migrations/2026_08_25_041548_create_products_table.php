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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand');
            $table->enum('age_category', ['dewasa', 'remaja', 'anak']);
            $table->enum('gender', ['pria', 'wanita']);
            $table->string('sport_category'); 
            $table->decimal('price', 12, 2);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
