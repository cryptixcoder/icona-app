<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contract_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->string('tow_number');
            $table->string('vehicle_owner')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('make')->nullable();
            $table->string('model')->nullable();
            $table->string('year')->nullable();
            $table->string('vehicle_color')->nullable();
            $table->string('state')->nullable();
            $table->string('tag_number')->nullable();
            $table->string('vin')->nullable();
            $table->integer('mileage')->nullable();
            $table->string('officer_id')->nullable();
            $table->string('complaint_id')->nullable();
            $table->integer('lot_id')->unsigned()->nullable();
            $table->text('tags')->nullable();
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();
            $table->boolean('archive')->default(false);
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('tows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tows');
    }
}
