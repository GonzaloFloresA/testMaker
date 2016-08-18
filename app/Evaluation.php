<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model {

	
	protected $table = 'evaluations';
	protected $fillable = ['exam_id','pending','intent','calification','token_access','start','end','content'];

	public function exam(){
		return $this->belongsTo('App\Exam');
	}

	public function students(){
		return $this->belongsToMany('App\Estudent');
	}

}
