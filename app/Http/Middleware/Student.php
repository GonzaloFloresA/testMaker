<?php namespace App\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class Student {

	protected $auth;
	public function __construct(Guard $auth){
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		switch ($this->auth->user()->type) {
			case '0':
				return redirect()->to('admin');
				break;

			case '1':
				return redirect()->to('teacher');
				break;

			case '2':
				//return redirect()->to('student');
			break;

			default:
				return redirect()->to('/');
				break;
		}
		return $next($request);
	}

}
