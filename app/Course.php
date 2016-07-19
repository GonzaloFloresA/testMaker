<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model {

	//

	protected $table = 'courses';
	protected $fillable = [
		'cod_sis',
		'name'
	];

	public function groups(){
		return $this->hasMany('App\Group');
	}

	public function career(){
		return $this->belongsTo('App\Career');
	}

	public function exams(){
		return $this->hasManyThrough('App\Exam','App\Group');
	}

	public function scopeName($query, $name){
		if(trim($name) != ""){
			$query->where('name', "LIKE", "%$name%");
		}
	}

	public function scopeCodsis($query, $cod_sis){
		if(trim($cod_sis) != ""){
			$query->where('cod_sis', "LIKE", "%$cod_sis%");
		}
	}

	public function scopeLevel($query, $level){
		if(trim($level) != ""){
			$query->where('level', "=", "$level");
		}
	}

}
