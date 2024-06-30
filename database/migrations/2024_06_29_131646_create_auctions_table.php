<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('auctions', function (Blueprint $table) {
            $table->id();
            $table->string('LotNumber');
            $table->string('Title');
            $table->unsignedBigInteger('user_id');  // Add this line

            $table->text('Description');
            $table->string('ArtistName');
            $table->integer('BuiltYear');
            $table->date('AuctionDate');
            $table->decimal('EstimatedPrice', 10, 2);
            $table->unsignedBigInteger('AuctionCategory');
            $table->string('image')->nullable();
            $table->decimal('height', 8, 2);
            $table->decimal('width', 8, 2);
            $table->decimal('weight', 8, 2);
            $table->boolean('Frame');
            $table->timestamps();

            $table->foreign('AuctionCategory')->references('id')->on('auction_categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Add this line

        });
    }

    public function down()
    {
        Schema::dropIfExists('auctions');
    }
};
