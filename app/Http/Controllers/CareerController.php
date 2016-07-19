<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Career;
use Hash;
use Session;
use Redirect;
class CareerController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$careers = Career::all();
		return view('career.index',compact('careers'));
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
	public function store(Request $request)
	{
		$career = new Career;
		$rules = array(
			'name' => 'required|string',
			'abbr' => 'required|string|unique:careers'
		);
		$this->validate($request, $rules);
		$career->name = $request['name'];
		$career->abbr = $request['abbr'];
		$career->save();

		Session::flash('flash_message',"Se ha registrado la carrera ".$career->name." de manera exitosa!");

		return Redirect::back();
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
		$career = Career::find($id);
		// dd($career);
		return view('career.edit', compact('career'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$career = Career::find($id);
		$val_abbr = 'required|unique:careers,abbr,'.$career->id;

		$rules = array(
			'name' => 'required|string',
			'abbr' => $val_abbr
		);

		$this->validate($request,$rules);
		$career->name = $request['name'];
		$career->abbr = $request['abbr'];
		$career->save();

		Session::flash('flash_message',"Se han actualizado los datos de ".$career->name." de manera exitosa!");

		return Redirect::back();
	}

	/**
	 * Show confirm form remove record.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$career = Career::find($id);
		return view('career.delete', compact('career'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$career = Career::find($id);
		$career->delete();
		Session::flash('flash_message',"Un registro ha sido eliminado ");
		return redirect('admin/career');
	}

}
