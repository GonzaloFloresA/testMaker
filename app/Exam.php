<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

	protected $table = 'exams';

	protected $fillable = ['group_id','type','title','description','total'];

	public function group(){
		return $this->belongsTo('App\Group');
	}

}
