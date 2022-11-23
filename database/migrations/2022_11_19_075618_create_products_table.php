<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('name');
            $table->string('slug');
            $table->string('sku')->nullable();
            $table->string('barcode')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->integer('sale_price')->default(0);
            $table->integer('regular_price')->default(0);
            $table->integer('is_taxable')->default(0);
            $table->integer('featured')->default(0);
            $table->string('imagePath');
            $table->string('tags')->nullable();
            $table->string('status')->default(0);
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
