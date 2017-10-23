<?php

Route::group(['prefix' => config('adminamazing.path').'/apitokens', 'middleware' => ['web','CheckAccess']], function() {
	Route::get('/', 'selfreliance\apitokens\ApiTokensController@index')->name('AdminApiTokens');
	Route::get('/{id}', 'selfreliance\apitokens\ApiTokensController@edit')->name('AdminApiTokensEdit');
	Route::put('/{id}', 'selfreliance\apitokens\ApiTokensController@update')->name('AdminApiTokensUpdate');
	Route::delete('/{id?}', 'selfreliance\apitokens\ApiTokensController@destroy')->name('AdminApiTokensDelete');
});