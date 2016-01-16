<?php namespace App\Http\Controllers;

use App\Equation;
use App\Hint;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Log;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class DataController extends Controller {


	public function savelog($equation, $id, $status, $mood)
	{

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

	public function savegiven($equation)
	{
		$array = array('equation' => $equation);
		$model = Auth::user()->equations()->create($array);
		return $model->equation_id;
	}

	public function savehint($equation, $id)
	{
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

}
