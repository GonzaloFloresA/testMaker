<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Redirect;
use Session;
use Storage;
use File;
use Mail;
class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{

		switch ($request->get('attribute')) {
			case 'email':
				$users = User::email($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
			case 'type':
				$users = User::type($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
			case 'name':
			default:
				$users = User::name($request->get('field'))->orderBy('id', 'ASC')->paginate(10);
				break;
		}


		return view('users.userList', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);
		return view('admin.profile', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$user = User::find($id);
		$val_email  = $user->email === $request['email']? 'required|email':'required|email|unique:users';

		$rules = array(
			'name' => 'required|string',
			'email' => $val_email
		);

		$this->validate($request, $rules);

		$user->name = $request['name'];
		$user->email = $request['email'];
		$user->phone = $request['phone'];
		$user->save();

		Session::flash('flash_message',"Tus datos de usuario se han actualizado.");
		// return redirect('home');
		return Redirect::back();
	}

	public function resetPassword($id,Request $request){
		$user = User::find($id);
		// $pass = $user->password;

		$rules = array(
			'old_pass' => 'required',
			'new_pass' => 'required|min:5'
		);

		// $this->validate($request, $rules);
		if($this->validate($request, $rules)){
			if (Hash::check($request['old_pass'], $user->password)) {
				$user->password = Hash::make($request['new_pass']);
				$user->save();
				Session::flash('flash_message',"Tu password se ha cambiado!!! ");

			}
		}

		return Redirect::back();




		// if (Hash::check($request['old_pass'], $pass)) {
	 // 		$user->password = Hash::make($request['new_pass']);

    // 	return 'es el pass';
		// }else{
		// 	return 'no es el pass';
		// }

	}


	public function storage($id,Request $request){

			$file = $request->file('file-up');
			$rules = array(
				'file-up' => 'required|max:512|mimes:gif,png,jpg,jpeg',
			);

			$this->validate($request, $rules);

		$mime = $file->getClientMimeType();
		$typefile = strtolower($file->getClientOriginalExtension());
		$name = 'user_'.$id.'.'.$typefile;
		// $extension = $file->getClientMimeType()
		Storage::disk('local')->put($name, File::get($file));
		// return public_path();
		$user = User::find($id);
		$user->user_img = $name;
		$user->save();
		Session::flash('flash_message',"La imagen de usuario se ha cargado exitosamente.");
		return Redirect::back();
	}

	/**
	 * Active/Desactive the user account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function activate($id){
		$user = User::find($id);
		if($user->isActive()){
			$user->active = 0;
		}else{
			$user->active = 1;
		}
		$user->save();

		Session::flash('flash_message',"El estado de la cuenta del usuario ".$user->name." ha sido cambiado.");
		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	public function createEmail(Request $request){
		// dd($request['id']);
		// dd($request->get('id'));
		$users = User::find($request->get('id'));
		if($users == null){
			return Redirect::back();
		}else{
			return view('users.sendmail',compact('users'));
		}
	}

	public function sendEmail(Request $request){
			$emails = $request->get('email');
			$content = $request->get('contentemail');
			if($content != ""){

					Mail::queue('emails.personal',['content' => $content ],function($message) use ($emails) {
						$message->to($emails)
						->subject('Probando el email desde testmaker');
					});

					Session::flash('flash_message',"Se han enviado los correos exitosamente.");
			}

			return redirect('admin/user');

	}

	public function deleteGroup(Request $request){
		dd($request['id']);
	}



}
