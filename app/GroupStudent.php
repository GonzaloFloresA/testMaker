<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupStudent extends Model {

	//
	protected $table = 'group_student';
	protected $fillable = ['group_id','student_id','anio','semester'];

	public function group(){
		return $this->belongsTo('App\Group');
	}

	public function student(){
		return $this->belongsTo('App\Student');
	}


}
