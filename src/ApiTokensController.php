<?php

namespace Selfreliance\apitokens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Selfreliance\Apitokens\Models\Api_Token;

class ApiTokensController extends Controller
{
	public function index()
	{
		$tokens = Api_Token::orderBy('id', 'desc')->paginate(10);
    	$tokens->each(function($row)
    	{
			if(count($row->scope) > 0) $row->scope = json_decode($row->scope);
			else $row->scope = [""];
    	});
		return view('apitokens::home')->with(['tokens' => $tokens]);
	}

	public function action(Request $request, $id = null)
	{
		$method = $request->method();
		if($method == 'GET')
		{// Get token
			$Token = Api_Token::findOrFail($id);

			$Token->scope = json_decode($Token->scope);
			if(!$Token->scope) $Token->scope = [""];

			if($Token->notiffication_status)
			{
				$Token->notiffication_status = json_decode($Token->notiffication_status);
			}
			if($Token->notiffication_fail) 
			{
				$Token->notiffication_fail = json_decode($Token->notiffication_fail);
			}
			if($Token->notiffication_success) 
			{
				$Token->notiffication_success = json_decode($Token->notiffication_success);
			}

			return view('apitokens::edit')->with(['token' => $Token]);
		}
		else if($method == 'PUT')
		{// Update token
			$this->validate($request, 
				[
					'name_token' => 							'required|min:2',
					'token' => 									'required|min:44',
					'ip_address' => 							'required|ip',
					'scope' => 									'array|in:create_address,history_transaction,sending_funds',
		            'notiffication_success_url' => 				'required|url|max:191',
		            'notiffication_success_method' => 			'in:GET,POST',
		            'notiffication_fail_url' => 				'required|url|max:191',
		            'notiffication_fail_method' => 				'in:GET,POST',
		            'notiffication_status_url' => 				'required|url|max:191',
		        	'notiffication_status_method' => 			'in:GET,POST'
				]
			);
			$Token = Api_Token::findOrFail($id);

			$scope = json_encode($request->input('scope'));

			$Token->name_token = $request->input('name_token');
			$Token->token = $request->input('token');
			$Token->ip_address = $request->input('ip_address');
			$Token->scope = $scope;

			$Token->notiffication_success = json_encode(
				[
					"url" => $request->input('notiffication_success_url'), 
					"method" => $request->input('notiffication_status_method')
				]
			);
			$Token->notiffication_fail = json_encode(
				[
					"url" => $request->input('notiffication_fail_url'), 
					"method" => $request->input('notiffication_fail_method')
				]
			);
			$Token->notiffication_status = json_encode(
				[
					"url" => $request->input('notiffication_status_url'), 
					"method" => $request->input('notiffication_status_method')
				]
			);

			$Token->save();

			return redirect()->route('AdminApiTokens')->with('status', 'Токен успешно обновлен!');
		}
		else if($method == 'DELETE')
		{// Delete token
			$this->validate($request, [
				'id' => 'required'
			]);

			Api_Token::where('id', $request->input('id'))->delete();
		}

		return redirect()->route('AdminApiTokens');
	}
}