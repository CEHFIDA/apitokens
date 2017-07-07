<?php

namespace Selfreliance\Apitokens;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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

    public function destroy($id){
        $ModelToken = Api_Token::findOrFail($id);
        $ModelToken->delete();
        return redirect()->route('AdminApiTokens')->with('status', 'Токен и доступ к api удален!');
    }

    public function edit($id){
        $tokenInfo = Api_Token::findOrFail($id);
        $temp = json_decode($tokenInfo->scope);
        if(count($temp) > 0){
            $tokenInfo->scope_view = $temp;
        }
        
        if($tokenInfo->notiffication_status){
            $tokenInfo->notiffication_status = json_decode($tokenInfo->notiffication_status);
        }
        if($tokenInfo->notiffication_fail){
            $tokenInfo->notiffication_fail = json_decode($tokenInfo->notiffication_fail);
        }
        if($tokenInfo->notiffication_success){
            $tokenInfo->notiffication_success = json_decode($tokenInfo->notiffication_success);
        }
        // dd($tokenInfo);
        return view('apitoken::edit')->with(["tokenInfo"=>$tokenInfo]);
    }

    public function update($id, Request $request){
        $this->validate($request, [
            'name_token' => 'required|min:2',
            'token'      => 'required|min:44',
            'ip_address' => 'required|ip',
            'scope'      => 'array|in:create_address,history_transaction,sending_funds',
        ]);
        $scope = json_encode($request->input('scope'));

        $ModelToken             = Api_Token::where('id',$id)->first();
        $ModelToken->token      = $request->input('token');
        $ModelToken->scope      = $scope;
        $ModelToken->name_token = $request->input('name_token');
        $ModelToken->ip_address = $request->input('ip_address');
        
        $ModelToken->save();
        
        return redirect()->route('AdminApiTokensEdit', ["id"=>$id])->with('status', 'Токен обновлен!');
    }
}
