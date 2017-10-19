<?php

Route::group(['prefix' => config('adminamazing.path').'/apitokens', 'middleware' => ['web','CheckAccess']], function() {
	Route::get('/', 'selfreliance\apitokens\ApiTokensController@index')->name('AdminApiTokens');
	Route::get('/{id}', 'selfreliance\apitokens\ApiTokensController@action')->name('AdminApiTokensAbout');
	Route::put('/{id}', 'selfreliance\apitokens\ApiTokensController@action')->name('AdminApiTokensUpdate');
	Route::delete('/delete', 'selfreliance\apitokens\ApiTokensController@action')->name('AdminApiTokensDelete');
});