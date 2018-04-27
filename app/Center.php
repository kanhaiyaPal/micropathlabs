<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Center extends Model
{
    protected $table = 'center';

	public function getUserNameAttribute()
	{
		$load_user = User::find($this->user_id);	
	    return $load_user->username;
	}

	public function getUserRealNameAttribute()
	{
		$load_user = User::find($this->user_id);	
	    return $load_user->name;
	}

	public function getUserEmailAttribute()
	{
		$load_user = User::find($this->user_id);
	    return $load_user->email;
	}
}
