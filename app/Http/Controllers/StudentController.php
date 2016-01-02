<?php namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Authenticatable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Hash;
use Redirect;
use App\Student;



class StudentController extends Controller {


	function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{


			$user = Auth::user();
			$proc = "pia";
			return view('partials.students', compact('user', 'proc'));


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
	public function store(CreateStudentRequest $request)
	{
		$request['password'] = Hash::make(ucfirst(strtolower($request->last_name)) . substr($request->student_number, -3));
		Student::create($request->all());
		Auth::loginUsingId($request->student_number);
		return Redirect::to('pia');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

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

	public function login(LoginUserRequest $request)
	{
		$credentials = [

			'student_number' => $request->student_number,
			'password' => $request->password

		];
		if(Auth::attempt($credentials)){
			return Redirect::to('pia');
		}else{
		Auth::loginUsingId($credentials['student_number']);
		return Redirect::to('pia');
		}
	}

	public function action($id)
	{
		if($id == 'automatic'){

		}else{

		}
	}

	/**
	 * logs out the user
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
		return Redirect::to('pia');
	}

}
