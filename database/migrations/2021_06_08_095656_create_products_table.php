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
            $table->date('inhouse_date');
            $table->string('style_ref');
            $table->string('color');
            $table->string('fabric_type');
            $table->string('pantone_number');
            $table->string('collection_ref');
            $table->string('supplier');
            $table->string('gsm_weight')->nullable();
            $table->string('quantity_inhouse');
            $table->string('unit');
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
