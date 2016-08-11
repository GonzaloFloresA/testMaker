<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Exam extends Model {

	protected $table = 'exams';

	protected $fillable = ['group_id','name_course','institution','duration','type','title','description','total','time_start','types','state'];

	public function group(){
		return $this->belongsTo('App\Group');
	}

	public function questions(){
		return $this->belongsToMany('App\Question')->withPivot('percent','order');
	}

	public function students(){
		return $this->belongsToMany('App\Student');
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

	public function totalPercent(){
		$percents = array();
		foreach($this->questions as $question){
			$percents[] = $question->pivot->percent;
		}
		$total = array_sum($percents);
		return $total;
	}

	public function questionOrdered(){
		$questions_order = $this->questions->sortBy(function($question){
			return $question->pivot->order;
		});

		return $questions_order;
	}

	public function getDate(){
		$date_exam = new DateTime($this->time_start);
		return $date_exam->format('Y-m-d');
	}

	public function getStartTime(){
		$start = new DateTime($this->time_start);
		return $start->format('H:i');
	}

	public function getEndTime(){
		$end = new DateTime($this->duration);
		return $end->format('H:i');	
	}

	public  function isOnline(){
		return $this->types == 'online';
	}

	public function isPresential(){
		return $this->types == 'presential';
	}

	public function statePublicate(){
		return $this->state == 'publicate';
	}

	public function stateTerminate(){
		return $this->state == 'terminate';
	}

	public function stateEdition(){
		return $this->state == 'edition';
	}

}
