<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if(!Schema::hasTable('api_tokens')){
            Schema::create('api_tokens', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('wallet_id');
                $table->text('token');
                $table->json('scope');
                $table->string('name_token');
                $table->text('ip_address');
                $table->json('notiffication_success');
                $table->json('notiffication_fail');
                $table->json('notiffication_status');
                $table->string('image');
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
        //
        Schema::dropIfExists('api_tokens');
    }
}
