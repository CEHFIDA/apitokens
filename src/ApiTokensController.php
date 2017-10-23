<?php

namespace Selfreliance\apitokens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Apitokens\Models\Api_Token;

class ApiTokensController extends Controller
{
	/**
	 * Index
	 * @return view home with tokens
	*/
	public function index()
	{
		$tokens = Api_Token::orderBy('id', 'desc')->paginate(10);
    	$tokens->each(
    		function($row)
    		{
				if($row->scope != "null") $row->scope = json_decode($row->scope);
				else $row->scope = null;
    		}
    	);
		return view('apitokens::home')->with(['tokens' => $tokens]);
	}

	/**
	 * Edit token
	 * @param int $id
	 * @return view edit with $token
	*/
	public function edit($id)
	{
		$token = Api_Token::findOrFail($id);
		if($token->scope != "null") $token->scope = json_decode($token->scope);
		else $token->scope = [""];

		$token->notiffication_status = json_decode($token->notiffication_status);
		$token->notiffication_fail = json_decode($token->notiffication_fail);
		$token->notiffication_success = json_decode($token->notiffication_success);

		$creator = \DB::table('users')->where('id', $token->wallet_id)->select('id', 'name', 'email')->first();

		return view('apitokens::edit')->with([
			'token' => $token, 
			'creator' => $creator
		]);
	}

	/**
	 * Update token
	 * @param int $id
	 * @param request $request
	 * @return mixed
	*/
	public function update($id, Request $request)
	{
		$this->validate($request, [
			'name_token' => 'required|min:2',
			'token' => 'required|min:44',
			'ip_address' => 'required|ip',
			'scope' => 'array|in:create_address,history_transaction,sending_funds',
            'notiffication_success_url' => 'required|url|max:191',
            'notiffication_success_method' => 'in:GET,POST',
            'notiffication_fail_url' => 'required|url|max:191',
            'notiffication_fail_method' => 'in:GET,POST',
            'notiffication_status_url' => 'required|url|max:191',
        	'notiffication_status_method' => 'in:GET,POST'
		]);

		$token = Api_Token::findOrFail($id);

		$token->name_token = $request->input('name_token');
		$token->token = $request->input('token');
		$token->ip_address = $request->input('ip_address');
		$token->scope = json_encode($request->input('scope'));

		$token->notiffication_success = json_encode(
			[
				"url" => $request->input('notiffication_success_url'), 
				"method" => $request->input('notiffication_success_method')
			]
		);

		$token->notiffication_fail = json_encode(
			[
				"url" => $request->input('notiffication_fail_url'), 
				"method" => $request->input('notiffication_fail_method')
			]
		);

		$token->notiffication_status = json_encode(
			[
				"url" => $request->input('notiffication_status_url'), 
				"method" => $request->input('notiffication_status_method')
			]
		);

		$token->save();

		return redirect()->route('AdminApiTokens')->with('status', 'Токен обновлен!');		
	}

    /**
     * Destroy token
     * @param int $id
     * @return mixed
    */	
	public function destroy($id)
	{
		$token = Api_Token::findOrFail($id);
		$token->delete();

		return redirect()->route('AdminApiTokens')->with('status', 'Токен удален!');
	}
}