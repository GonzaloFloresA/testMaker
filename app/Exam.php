<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

	protected $table = 'exams';

	protected $fillable = ['group_id','name_course','institution','duration','type','title','description','total','time_start'];

	public function group(){
		return $this->belongsTo('App\Group');
	}

	public function questions(){
		return $this->belongsToMany('App\Question')->withPivot('percent','order');
	}

    // verify sum percent all notes is 100
	public function isValid(){
		$questions = $this->questions;
		$percents = array();
		foreach($this->questions as $question){
			$percents[] = $question->pivot->percent;
		}
		$total = array_sum($percents);

		if($total == 100) 
			return TRUE;
		else
			return FALSE;
	}

}
