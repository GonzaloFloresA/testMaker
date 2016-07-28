<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

	//
	protected $table = 'groups';
	protected $fillable = ['course_id','nro'];

	public function course(){
		return $this->belongsTo('App\Course');
	}

	public function teacher(){
		return $this->belongsTo('App\Teacher');
	}

	public function students(){
		return $this->belongsToMany('App\Student');
	}

	public function exams(){
		return $this->hasMany('App\Exam');
	}

	public function scopeAnio($query, $year){
		if(trim($year) != ""){
			$query->where('year', "LIKE", "%$year%");

		}
	}

	public function scopeDocente($query, $docente){
		if(trim($docente) != ""){
			$query->where('year', "LIKE", "%$year%");

		}
	}

	public function scopeMateria($query, $materia){
		if(trim($docente) != ""){
			
			$query->where('year', "LIKE", "%$year%");

		}
	}


}
