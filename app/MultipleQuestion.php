<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class MultipleQuestion extends Model {

	protected $table = 'multiplequestions';
	protected $fillable = ['question_id','solution','des_solution'];

	public function question(){
		return $this->belongsTo('App\Question');
	}

	public function options(){
		return $this->hasMany('App\Option');
	}

}
