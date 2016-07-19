<?php namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use App\Student;
use App\Teacher;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		if($data['type'] == 1){
			$validate_codsis =  '|exists:teachers,cod_sis';
		}elseif($data['type'] == 2){
			$validate_codsis =  '|exists:students,cod_sis';
		}else{
			$validate_codsis = "";
		}
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:5',
			'type' => 'required|integer|in:1,2',
			'cod_sis' => 'required_with:type|required_if:type,1,2'.$validate_codsis,
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{

		// dd($data['type']);
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'type' => $data['type'],
		]);


		if($data['type'] == 1){
			// Teacher::create(['cod_sis'=>$data['cod_sis']]);
			$teacher = Teacher::where('cod_sis', '=', $data['cod_sis'])->first();
			$teacher->user_id = $user->id;
			$teacher->save();
			// dd("Es de tipo profesor ".$data['type']);
		}elseif($data['type'] == 2){
			// Student::create(['cod_sis'=>$data['cod_sis']]);
			$student = Student::where('cod_sis', '=', $data['cod_sis'])->first();
			$student->user_id = $user->id;
			$student->save();
			// dd("Es de tipo Estudiante ".$data['type']);
		}

		$user->active = 1;
		$user->save();

		return $user;
	}

}
