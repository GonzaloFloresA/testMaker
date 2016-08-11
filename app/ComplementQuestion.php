<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ComplementQuestion extends Model {

	protected $table = 'complementquestions';
	protected $fillable = ['question_id','solution'];

	public function question(){
		return $this->belongsTo('App\Question');
	}

	

}
