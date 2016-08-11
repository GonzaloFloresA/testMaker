<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	//
	protected $table = 'students';


	protected $fillable = ['cod_sis'];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function career(){
		return $this->belongsTo('App\Career');
	}

	public function groups(){
		return $this->belongsToMany('App\Group')
								->withPivot('anio','semester');
	}

	public function exams(){
		return $this->belongsToMany('App\Exam')->withPivot('response_id');
	}

	public function scopeCodsis($query, $cod_sis){
		if(trim($cod_sis) != ""){
			$query->where('cod_sis', "LIKE", "%$cod_sis%");

		}
	}

	public function scopeUnknow($query, $cod_sis){
		if(trim($cod_sis) != ""){
			$query->where('user_id','=',0)->where('cod_sis', "LIKE", "%$cod_sis%");

		}
	}

	public function scopeRegister($query, $cod_sis){
		if(trim($cod_sis) != ""){
			$query->where('user_id','!=',0)->where('cod_sis', "LIKE", "%$cod_sis%");

		}
	}
}
