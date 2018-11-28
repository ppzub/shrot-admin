<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('status')->nullable();
            $table->integer('price')->nullable();
            $table->boolean('sold')->default(0);
            $table->integer('product_id');
            $table->integer('carmodel_id');
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
        Schema::dropIfExists('descriptions');
    }
}
