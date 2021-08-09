<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            
            $table->id();
            $table->string('title',30);
            $table->string('state',500)->nullable();
            $table->string('image')->nullable();
            $table->text('content',500);
            $table->text('hash',500)->nullable();
            $table->text('value',100)->nullable();
            $table->text('owner',500)->nullable();
            $table->text('hex_data',500)->nullable();
            $table->text('hex_id',500)->nullable();
            $table->text('hash_picture',500)->nullable();
            $table->text('certificate_type',500)->nullable();
            $table->text('certificate_id',500)->nullable();
           
            



            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
            
            $table->bigInteger('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('areas')
            ->onDelete('cascade')->onUpdate('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offers');
    }
}
