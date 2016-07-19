<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection as Collection;

class Teacher extends Model {

	//

	protected $table = 'teachers';


	protected $fillable = ['cod_sis'];

	public function user(){
		return $this->belongsTo('App\User');
	}

	public function groups(){
		return $this->hasMany('App\Group');
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
