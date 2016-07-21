<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'questions';
	protected $fillable = ['group_id','title','description','types'];

	public function multipleQuestion(){
		return $this->hasOne('App\MultipleQuestion');
	}


}
