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
            $table->integer("sku");
            $table->string('name');
            $table->integer('dimension_id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->longText('description');
            $table->string('product_image');
            $table->integer('stock');
            $table->string('brand_name');
            $table->integer('model_number');
            $table->double('price', 12,2);
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
