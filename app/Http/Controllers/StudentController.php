<?php namespace App\Http\Controllers;


use App\Equation;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\LoginUserRequest;
use App\Log;
use App\Student;
use Illuminate\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Redirect;
use ReverseRegex\Generator\Scope;
use ReverseRegex\Lexer;
use ReverseRegex\Parser;
use ReverseRegex\Random\SimpleRandom;

class StudentController extends Controller {


	function __construct() {
		$this->middleware('auth', ['except'=>['login','store']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

			$user = Auth::user();
			$method = "auto";
			return view('partials.students', compact('user', 'method'));
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
		return Redirect::to('pia/method/manual');
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

		Auth::attempt($credentials);
		return Redirect::back();
	}

	public function method($method)
	{
		$user = Auth::user();
		if($method == "manual"){
			$given = $this->generateEquation();
			$data = array('equation'=>$given);
			$model = $user->equations()->create($data);
			$id = $model->equation_id;
			return view("partials.students", compact('user', 'method', 'given', 'id'));
		}
		return view("partials.students", compact('user', 'method'));
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

	public function test()
	{
		$logs = Student::with('equations.hints')->get();
		// dd($logs);
		return view('partials.test', compact('logs'));
	}

	public function generateEquation()
	{
		$lexer = new  Lexer('[1-9]{1}[x]([\+\-]{1}[1-9]{1}[x]{0,1}){0,1}=[1-9]{1}([\+\-]{1}[1-9]{1}[x]{0,1}){0,1}');
		$rand = rand(1, 99999);
		$gen   = new SimpleRandom($rand);
		$result = '';

		$parser = new Parser($lexer,new Scope(),new Scope());
		$parser->parse()->getResult()->generate($result,$gen);

		return $result;
	}

}

