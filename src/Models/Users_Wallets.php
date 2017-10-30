<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Users_Wallets extends Model
{
	use Notifiable;
	protected $table = 'users_wallets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'walletId', 'adress_default', 'num_wallet', 'wallet_name', 'commission'
    ];

    public function routeNotificationForMail()
    {
    	return $this->email;
    }
}
