<?php namespace App\Http\Middleware;

use Closure;

class RoleMiddleware {


	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	// public function handle($request, Closure $next)
	// {
	// 	if(\Auth::check() && \Auth::user()->isAdmin()){
	// 		return $next($request);
	// 	}else{
	// 		$rol = "Teacher o Student";
	// 		return view('admin.userole',['rol'=> $rol]);
	// 	}
	//
	// 	// return $next($request);
	// }

	public function handle($request, Closure $next){
		if(\Auth::check()){

				if( \Auth::user()->isAdmin() ){
					// $rol = "Administrador";
					return $next($request);
				}elseif( \Auth::user()->isTeacher() ){
					$rol = "Profesor";
					// dd($rol);
					return redirect()->to('teacher');
					// return $next($request);
				}elseif( \Auth::user()->isStudent() ){
					$rol = "Estudiante";

					return $next($request);
				}else{
					$rol = "Desconocido";
				}
				return view('admin.userole', compact('rol'));

		}else{
			 return redirect()->to('/home');
		}
	}


}
