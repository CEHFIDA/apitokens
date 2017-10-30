<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUserWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable('users_wallets')){
            Schema::create('users_wallets', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('walletId')->default('');
                $table->string('adress_default')->default('');
                $table->integer('num_wallet')->default(1);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users_wallets');
    }
}
