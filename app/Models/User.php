<?php namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract{

	use Authenticatable;
	/**
	 * Db name
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes, that are mass assignable
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email'];


	/**
	 * Protected model attributes
	 * @var array
	 */
	protected $guarded = ['id', 'password'];

	/**
	 * The attributes excluded from the model's JSON form.
	 * @var array
	 */

 	protected $hidden = ['password'];

}