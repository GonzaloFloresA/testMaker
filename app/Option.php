<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model {

	protected $table = 'options';
	protected $fillable = ['multiplequestions_id','description'];

	public function MultipleOption(){
		return $this->belongsTo('App\MultipleQuestion');
	}
}
