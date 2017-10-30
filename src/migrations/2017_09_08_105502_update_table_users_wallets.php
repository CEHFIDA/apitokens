<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTableUsersWallets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        //
        if(!Schema::hasColumn('users_wallets', 'wallet_name')){
            Schema::table('users_wallets', function (Blueprint $table) {
                $table->string('wallet_name')->after('user_id')->default('My wallet');
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
        //
    }
}
