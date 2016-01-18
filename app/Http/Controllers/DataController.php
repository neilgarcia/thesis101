<?php namespace App\Http\Controllers;

use App\Equation;
use App\Hint;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Log;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use ReverseRegex\Lexer;
use ReverseRegex\Random\SimpleRandom;
use ReverseRegex\Parser;
use ReverseRegex\Generator\Scope;

class DataController extends Controller {


	public function savelog()
	{
		$equation = Input::get('equation');
		$id = Input::get('id');
		$status = Input::get('status');
		$mood = Input::get('mood');
		$log = array('equation'=>$equation, 'equation_id'=>$id, 'status'=>$status, 'emotion'=>$mood);
		$model = Log::create($log);
		// dd($model);

	}

	public function analyze($id, $given, $method)
	{

		return view('partials.analyze')->with([
				'equation' => $id,
				'given' => $given,
				'method' => $method
			]);
	}

	public function test(){
		return view('partials.test');
	}

	public function analyzeUserInput($id)
	{
		return view('partials.analyze-user-input')->with([
				'equation' => $id
			]);
	}

	public function savegiven()
	{
		$equation = Input::get('equation');
		$array = array('equation' => $equation);
		$model = Auth::user()->equations()->create($array);
		return $model->equation_id;
	}

	public function savehint()
	{
		$equation = Input::get('equation');
		$id = Input::get('id');
		$hint = array('equation' => $equation, 'equation_id'=>$id);
		Hint::create($hint);

	}

	public function updateStatus()
	{
			$id = Input::get('equation_id');
			$eq = Equation::find($id);
			$eq->status = "finished";
			$eq->save();
			return $eq->toArray();
	}

	public function seed()
	{
		$lexer = new  Lexer('[2-9]{1}[x]([\+\-]{1}[2-9]{1}[x]{0,1}){0,1}=[2-9]{1}([\+\-]{1}[2-9]{1}[x]{0,1}){0,1}');
		$rand = rand(1, 99999);
		$gen   = new SimpleRandom($rand);
		$result = '';

		$parser = new Parser($lexer,new Scope(),new Scope());
		$parser->parse()->getResult()->generate($result,$gen);

		echo $result;
	}

}
