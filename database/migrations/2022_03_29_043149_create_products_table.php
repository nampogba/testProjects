<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->timestamps();
            $table->string('nameProduct');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('productCat_id')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('origin')->nullable();
            $table->bigInteger('barcode')->nullable();
            $table->unsignedBigInteger('productionArea')->nullable();
            $table->unsignedBigInteger('resource')->nullable();
            $table->unsignedBigInteger('producer')->nullable();
            $table->unsignedBigInteger('importers')->nullable();
            $table->unsignedBigInteger('distributor')->nullable();
            $table->unsignedBigInteger('transporters')->nullable();
            $table->unsignedBigInteger('manager')->nullable();
            $table->longText('storageConditions')->nullable();
            $table->longText('description')->nullable();
            $table->longText('contentProduct')->nullable();
            $table->string('ingredient')->nullable();
            $table->longText('usesProduct')->nullable();
            $table->longText('userManual')->nullable();
            $table->string('avatar')->nullable();
            $table->text('verifications')->nullable();
            $table->integer('status')->nullable();
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
