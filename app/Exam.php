<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

	protected $table = 'exams';

	protected $fillable = ['group_id','name_course','institution','duration','type','title','description','total','time_start'];

	public function group(){
		return $this->belongsTo('App\Group');
	}

}
