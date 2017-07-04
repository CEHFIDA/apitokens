<?php

Route::group(['middleware' => 'web'], function () {
	Route::get(config('adminamazing.path').'/apitokens', 'selfreliance\apitokens\ApiTokensController@index')->name('AdminApiTokens');
});