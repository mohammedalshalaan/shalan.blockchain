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
            
            $table->id();// it will be hashed and stored in hex_id
            $table->string('title',100);
            $table->string('state',500)->nullable();
            $table->string('image')->nullable(); // it will be hashed and stored in hash_picture
            $table->text('content',1000);
            $table->text('hash',42)->nullable(); // the offer address in the Ethereum blockchain
            $table->text('value',100)->nullable(); // the value or price of the offer
            $table->text('owner',42)->nullable(); // the current owner of the offer
            $table->text('hex_data',266)->nullable(); // this will be used for send the transaction to the Ethereum blockchain
            $table->text('hex_id',64)->nullable(); // this will be embedded in the smart contract
            $table->text('hash_picture',32)->nullable(); // this will be embedded in the smart contract
            $table->text('certificate_type',50)->nullable(); // is the current id of hte real estate hash Id or traditional Id?
            $table->text('certificate_id',100)->nullable(); 
           

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
