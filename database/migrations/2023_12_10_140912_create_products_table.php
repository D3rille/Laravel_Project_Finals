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
            $table->uuid('id')->primary();
            $table->double('price');
            $table->double('quantity');
            $table->string('crop_id');
            $table->unsignedBigInteger('user_id'); // Change to unsignedBigInteger
            $table->timestamps();
        });

        // Add foreign key constraints
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('crop_id')->references('crop_id')->on('crops')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
