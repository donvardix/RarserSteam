<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parsers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('total_count');
            $table->integer('sales')->nullable();
            $table->string('median_price')->nullable();
            $table->string('lowest_price')->nullable();
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('date_id');

            $table->foreign('item_id')
                ->references('id')
                ->on('items')
                ->onDelete('cascade');
            $table->foreign('date_id')
                ->references('id')
                ->on('date_parsers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parsers');
    }
}
