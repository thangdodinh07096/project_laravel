<?php

namespace App\Models;

use App\Models\Product;
use App\Models\UserInfo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */

	protected $fillable = [
		'name', 'email', 'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */

	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */

	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	protected $table = 'users';

	public function userInfo() {
		return $this->hasOne(UserInfo::class);
	}
	
	public function products() {
		return $this->hasMany(Product::class);
	}
}