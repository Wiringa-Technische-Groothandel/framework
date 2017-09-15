<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 75);
            $table->integer('sku')->unique();
            $table->integer('group');
            $table->string('alt_sku', 16);
            $table->string('registered_per', 5);
            $table->string('packed_per', 5);
            $table->string('price_per', 5);
            $table->string('refactor', 6);
            $table->string('ean', 16);
            $table->string('image', 34);
            $table->string('length', 9)->nullable();
            $table->string('price', 10);
            $table->integer('vat', false, true);
            $table->string('brand', 50);
            $table->string('series', 50);
            $table->string('type', 50);
            $table->decimal('special_price', 10, 2);
            $table->string('action_type', 10);
            $table->string('keywords', 100);
            $table->string('related_products', 85);
            $table->string('catalog_group', 50);
            $table->string('catalog_index', 100);
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
}