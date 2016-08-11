<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {

	protected $table = 'questions';
	protected $fillable = ['group_id','title','description','types'];

	public function multipleQuestion(){
		return $this->hasOne('App\MultipleQuestion');
	}

	public function complementQuestions(){
		return $this->hasMany('App\ComplementQuestion');
	}


	public function exams()
	{
		return $this->belongsToMany('App\Exam');
	}

	public function printVersion(){
		$result = "";

		if($this->types == 'complemento'){
			$regexp =  '/<compl>compl-(.+?)<\/compl>/i';
		    preg_match_all($regexp, $this->description,$matches);
		    $result = str_replace($matches[0],'.................................',$this->description);
			// dd($result);
		}
		return $result;
	}


	public function showVersion(){
		$result = "";

		if($this->types == 'complemento'){
			$regexp =  '/<compl>compl-(.+?)<\/compl>/i';
		    preg_match_all($regexp, $this->description,$matches);
		    $cont = $this->getTags($matches[1]);
		    $result = str_replace($matches[0],$cont,$this->description);
			// dd($result);
		}
		return $result;
	}

	public function getTags($ids){
		$res = array();
		foreach ($ids as $key => $value) {
			//&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$res[] = '<span contenteditable class="span_editable" id="'.$value.'" style="display:inline-block;"></span><input type="hidden" name="id[]" value="'.$value.'">
				     <input type="hidden"  id="_'.$value.'"  name="cont[]" >';
		}
		return $res;
	}

	public function isMultiple(){
		if($this->types == 'multiple')
			return true;
		else
			return false;
	}

	public function isDevelop(){
		if($this->types == 'develop')
			return true;
		else
			return false;
	}

	public function isComplemento(){
		if($this->types == 'complemento')
			return true;
		else
			return false;
	}

	public function isFalsoVerdad(){
		if($this->types == 'falsoVerdad')
			return true;
		else
			return false;
	}


}
