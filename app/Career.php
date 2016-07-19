<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model {

	protected $table = 'careers';
	protected $fillable = ['name','abbr'];


	public function students(){
		return $this->hasMany('App\Student');
	}

	public function courses(){
		return $this->hasMany('App\Course');
	}
}
