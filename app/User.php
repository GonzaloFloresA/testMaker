<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'email', 'password','phone','active','type','user_img'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];


	public function isAdmin(){
		return $this->type === 0;
	}

	public function isTeacher(){
		return $this->type === 1;
	}

	public function isStudent(){
		return $this->type === 2;
	}

	public function isActive(){
		return $this->active === 1;
	}

	public function userPhoto(){
		if($this->user_img != 'nan'){
			return 'images/profileimg/'.$this->user_img;
		}else{
			return 'images/profileimg/default_avatar.png';
		}
	}

	public function teacher(){
		return $this->hasOne('App\Teacher');
	}

	public function student(){
		return $this->hasOne('App\Student');
	}

	public function scopeName($query, $name){
		if(trim($name) != ""){
					$query->where('name', "LIKE", "%$name%");
		}
	}

	public function scopeEmail($query, $email){
		if(trim($email) != ""){

					$query->where('email', "LIKE", "%$email%");
		}

	}

	public function scopeType($query, $type){
		if(trim($type) != ""){

					$query->where('type', "LIKE", "%$type%");
		}

	}

	public function scopeState($query, $state){
		if(trim($state) != ""){

					$query->where('active', "LIKE", "%$state%");
		}

	}

}
