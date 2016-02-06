<?php namespace App\Http\Controllers;


use App\Equation;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\LoginUserRequest;
use App\Log;
use App\Student;
use App\PiaLog;
use Carbon\Carbon;
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
			return view("module")->with('user', $user);
	}

	public function module()
	{
		$user = Auth::user();
		return view('module')->with('user', $user);
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
		$request['student_group'] = "emphatic";
		Student::create($request->all());
		Auth::loginUsingId($request->student_number);
		$user = Auth::user();
		return Redirect::to('pia/method/manual')->with("user", $user);
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
		return Redirect::to('/pia/module');
	}

	public function method($method)
	{
		$user = Auth::user();
		if($method == "manual"){
			$given = $this->generateEquation();

			$data = array('equation'=>$given['equation'], 'difficulty'=>$given['difficulty'], 'time_started'=>Carbon::now());

			$model = $user->equations()->create($data);
			$id = $model->equation_id;
			$eq = $model->equation;
			return view("partials.students", compact('user', 'method', 'eq', 'id'));
		}
		return view("partials.students", compact('user', 'method'));
	}

	public function userInput()
	{
		$user = Auth::user();
		$method = "user-input";
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
		$logs = Student::with('equations', 'piaLogs')->where('student_group', '=', 'non-emphatic')->get();
		// dd($logs);
		return view('partials.test', compact('logs'));
	}

	public function generateEquation()
	{
		// $lexer = new  Lexer('[2-9]{1}[x]=[1-9]{1}([\+\-]{1}[2-9]{1}[x]{0,1}){0,1}');
		$data = json_decode($this->generateLexer());
		$lexer = new Lexer($data->{'lexer'});
		// $lexer = new  Lexer('[2-9]{1}[x]=[1-9]{1,2}');
		$rand = rand(1, 99999);
		$gen   = new SimpleRandom($rand);
		$result = '';

		$parser = new Parser($lexer,new Scope(),new Scope());
		$parser->parse()->getResult()->generate($result,$gen);
		$eq = array('equation'=>$result, 'difficulty'=>$data->{'difficulty'});
		return $eq;
	}

	public function generateLexer()
	{
		$user = Auth::user();
		$lexer = "";
		$difficulty = "";
		$difficult = $user->equations()->where('difficulty', '=', 'difficult')
												 ->where('status', '=', 'finished')
												 ->count();
		$average = $user->equations()->where('difficulty', '=', 'average')
												 ->where('status', '=', 'finished')
												 ->count();
		$easy = $user->equations()->where('difficulty', '=', 'easy')
												 ->where('status', '=', 'finished')
												 ->count();

		if($average > 25){
			 $difficulty = "difficult";
			 $lexer = '[2-9]\([2-9][x][\+\-]{1}[2-9]\)=[2-9]\([2-9][x][\+\-]{1}[2-9]\)([\+\-]{1}[2-9][x]{0,1}){0,1}';
		}else if($easy > 25){
			 $lexer = '[2-9][x]([\-\+]{1}[2-9]{1,2}){1}=[1-9]{1,2}(\-[2-9][x]){0,1}';
			 $difficulty = "average";
		}else{
			$difficulty = "easy";
			$lexer = '[2-9]{1}[x]=[1-9]{1,2}';
		}
		$data = array('lexer'=>$lexer, 'difficulty'=>$difficulty);
		return json_encode($data);
	}

	public function logs()
	{
		$user = Auth::user();
		$equations = $user->equations()->get();
	  $correctEquations = $user->equations()->where('status', '=', 'finished')->get();
		$wrongEquations = $user->equations()->where('status', '=', 'abandoned')->get();
		$hints = $user->hints()->with('equation')->get();
		$easy = $user->equations()->where('difficulty', '=', 'easy')->where('status', '=', 'finished')->get();
		$average  = $user->equations()->where('difficulty', '=', 'average')->where('status', '=', 'finished')->get();
		$difficult = $user->equations()->where('difficulty', '=', 'difficult')->where('status', '=', 'finished')->get();
		return view('partials.logs', compact('user', 'equations', 'correctEquations' ,'wrongEquations', 'hints', 'easy', 'average', 'difficult'));

	}

	public function profile()
	{
		$user = Auth::user();
		return view('partials.profile', compact('user'));
	}

}

