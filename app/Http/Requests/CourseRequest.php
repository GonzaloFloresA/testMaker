<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class CourseRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
				'cod_sis' => 'required|unique:courses',
				'name' => 'required',
				'level' => 'required|integer|between:1,10',
				'career_id' => 'required|integer|exists:careers,id',
		];
	}

}
