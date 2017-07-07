<?php

Route::group(['middleware' => 'web'], function () {
	Route::get(config('adminamazing.path').'/apitokens', 'selfreliance\apitokens\ApiTokensController@index')->name('AdminApiTokens');
	Route::get(config('adminamazing.path').'/apitokens/{id}', 'selfreliance\apitokens\ApiTokensController@edit')->name('AdminApiTokensEdit');
	Route::put(config('adminamazing.path').'/apitokens/{id}', 'selfreliance\apitokens\ApiTokensController@update')->name('AdminApiTokenUpdate');
	Route::delete(config('adminamazing.path').'/apitokens/{id}', 'selfreliance\apitokens\ApiTokensController@destroy')->name('AdminApiTokensDeleted');
});