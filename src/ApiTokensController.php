<?php

namespace Selfreliance\Apitokens;

use App\Http\Controllers\Controller;
use App\Models\Api_Token;

class ApiTokensController extends Controller
{

    public function index()
    {
    	$ApiTokens = Api_Token::orderBy('id', 'desc')->paginate(10);
    	$ApiTokens->each(function($row){
			$temp = json_decode($row->scope);
			if(count($temp) > 0){
				$row->scope_view = $temp;
			}
    	});
        return view('apitoken::home')->with(["ApiTokens"=>$ApiTokens]);
    }
}
