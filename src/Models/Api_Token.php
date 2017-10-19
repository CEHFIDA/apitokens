<?php

namespace Selfreliance\apitokens\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use DB;
class Api_Token extends Model
{
	use SoftDeletes;
	use Notifiable;
    //
    protected $table = 'api_tokens';

    protected $fillable = [
        'wallet_id', 'token', 'scope', 'image', 'name_token', 'ip_address', 'notiffication_success', 'notiffication_fail', 'notiffication_status'
    ];
}
