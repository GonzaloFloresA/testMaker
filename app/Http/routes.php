<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



// Route::get('test-mail',function(){
// 	Mail::send("emails.test",[],function($message){
// 		$message->to('jultum88@gmail.com',"Julio Alberto")
// 		->subject('Probando el email desde testmaker');
// 	});
// });
// Rutas permitidas para todo aquel usuario que este autentificado
Route::group(['middleware'=>['auth','activate']],function(){
	// Route::get('/', 'WelcomeController@index');
	Route::post('user/storage/{id}','UserController@storage');
	Route::get('user/profile/{id}', 'UserController@edit');
	Route::post('user/edit/{id}', 'UserController@update');
	Route::post('user/resetpass/{id}', 'UserController@resetPassword');
});


// Rutas permitidas para el usuario tipo administrador (admin)
Route::group(['middleware'=>['auth','activate','admin'], 'prefix' => 'admin'], function(){
	Route::get('/', 'WelcomeController@index');

	Route::get('course','CourseController@index');
	Route::post('course/create', 'CourseController@store');
	Route::get('course/excel', 'CourseController@excel');
	Route::post('course/excel', 'CourseController@previs');
	Route::get('course/savexcel', 'CourseController@saveModel');

	Route::get('course/deletegroup', 'CourseController@deleteGroup');
	Route::get('course/edit/{id}','CourseController@edit');
	Route::post('course/edit/{id}','CourseController@update');
	Route::get('course/eliminate/{id}','CourseController@eliminate');
	Route::post('course/delete/{id}','CourseController@destroy');
	Route::get('course/show/{id}','CourseController@show');

	Route::get('user','UserController@index');
	Route::get('user/activeUser/{id}','UserController@activate');
	Route::post('user/create/email', 'UserController@createEmail');
	Route::post('user/send/email', 'UserController@sendEmail');
	Route::get('user/deletegroup', 'UserController@deleteGroup');

	Route::get('teacher','TeacherController@index');
	Route::post('teacher/create', 'TeacherController@store');
	Route::get('teacher/eliminate/{id}','TeacherController@eliminate');
	Route::post('teacher/delete/{id}','TeacherController@destroy');
	Route::post('teacher/excel', 'TeacherController@previs');
	Route::post('teacher/savexcel', 'TeacherController@saveModel');

	Route::get('group', 'GroupController@index');
	Route::post('group/store', 'GroupController@store');
	Route::get('group/eliminate/{id}','GroupController@eliminate');
	Route::post('group/delete/{id}','GroupController@destroy');
	Route::get('group/excel', 'GroupController@excel');
	Route::post('group/create', 'GroupController@create');
	Route::post('group/savexcel', 'GroupController@saveModel');
	Route::post('group/asign', 'GroupController@asign');
	Route::post('group/inscription', 'GroupController@inscription');
	Route::get('group/show/{id}', 'GroupController@show');
	Route::post('group/{group}/registerstudent', 'GroupController@registerstudent');


	Route::get('student','StudentController@index');
	Route::post('student/create', 'StudentController@store');
	Route::get('student/eliminate/{id}','StudentController@eliminate');
	Route::post('student/delete/{id}','StudentController@destroy');
	Route::post('student/excel', 'StudentController@previs');
	Route::post('student/savexcel', 'StudentController@saveModel');

	Route::get('career/{id}/delete','CareerController@delete');
	Route::resource('career','CareerController');

	

});

// rutas permitidas para el usuario tipo docente(teacher)
Route::group(['middleware'=>['auth','activate','teacher'], 'prefix' => 'teacher'], function()  {

		Route::get('/', 'WelcomeController@index');
		Route::get('/{id}/course', 'TeacherController@mycourses');
		Route::get('/{teacher}/course/{course}','TeacherController@groups');
		Route::get('/group/{group}/questions', 'TeacherController@myquestions');
		Route::get('group/{group}/exams','TeacherController@myexams');

		Route::get('group/{group}/exam/create','ExamController@create');
		Route::post('group/{group}/exam/create','ExamController@store');
		Route::get('group/{group}/exam/edit/{id}','ExamController@edit');
		Route::post('group/{group}/exam/edit/{id}','ExamController@update');
		Route::get('group/{group}/exam/delete/{id}','ExamController@delete');
		Route::post('group/{group}/exam/delete/{id}','ExamController@destroy');

		Route::get('group/{group}/exam/edit/{id}/asign','ExamController@asign');
		Route::post('group/{group}/exam/edit/{id}/asign','ExamController@populate');
		Route::get('group/{group}/exam/{id}/terminate','ExamController@terminate');
		Route::post('group/{group}/exam/{id}/terminate','ExamController@terminateEdition');

		Route::get('group/{group}/exam/{id}/show','ExamController@show');
		Route::get('group/{group}/exam/{id}/publicate', 'TeacherController@publicate');

		Route::get('group/{group}/question/store','QuestionController@store');
		Route::get('group/{group}/question/show/{id}','QuestionController@show');
		Route::get('group/{group}/question/edit/{id}','QuestionController@edit');
		Route::post('group/{group}/question/edit/{id}','QuestionController@update');
		Route::get('group/{group}/question/delete/{id}','QuestionController@delete');
		Route::post('group/{group}/question/delete/{id}','QuestionController@destroy');
		Route::post('group/{group}/question/verify/{id}','QuestionController@verifyResponse');

		Route::get('/{teacher}/student/list','TeacherController@mystudents');
		Route::post('user/create/email', 'UserController@createEmail');
		Route::post('user/send/email', 'UserController@sendEmail');

		Route::get('/exam/{id}/pdf', 'PdfController@invoice');

		Route::get('/group/{group}/description', 'GroupController@editDescription');
		Route::post('/group/{group}/description', 'GroupController@updateDescription');

});

// rutas permitidas para el usuario tipo estudiante (student)
Route::group(['middleware'=>['auth','student'], 'prefix' => 'student'], function(){
		Route::get('/', 'WelcomeController@index');
		Route::get('/{id}/course', 'StudentController@mycourses');
		Route::get('/{id}/group/{group}/','StudentController@myexams');
		Route::get('/{id}/group/{group}/exam/{exam}/eval/{eval}','StudentController@verifyToken');
		Route::post('/{id}/group/{group}/exam/{exam}/eval/{eval}','StudentController@startEvaluation');
		Route::post('/{id}/group/{group}/exam/{exam}/eval/{eval}/terminate','StudentController@terminateEvaluation');

});
