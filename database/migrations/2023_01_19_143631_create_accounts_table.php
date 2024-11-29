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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('machine_id');
            $table->string('site')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_code')->nullable();
            $table->string('mobile')->nullable();
            $table->string('password')->nullable();
            $table->string('balance')->nullable();
            $table->text('all_balances')->nullable();
            $table->string('withdraw_balance')->nullable();
            $table->boolean('used')->default(false);
            $table->timestamp('last_check_balance')->nullable();
            $table->json('full_balance')->nullable();
            $table->json('trading_balance')->nullable();
            $table->string('seed')->nullable();
            $table->string('ip')->nullable();
            $table->string('country')->nullable();
            $table->string('geo')->nullable();
            $table->string('uuid')->nullable();
            $table->timestamps();

            $table->foreign('machine_id')->references('id')->on('machines')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
};
