<?php namespace App\Http\Controllers;

use App\Equation;
use App\Hint;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Log;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use ReverseRegex\Generator\Scope;
use ReverseRegex\Lexer;
use ReverseRegex\Parser;
use ReverseRegex\Random\SimpleRandom;

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
		$user = Auth::user();
		$equation = Input::get('equation');
		$id = Input::get('id');
		$hint = array('equation' => $equation, 'equation_id'=>$id);

		$user->hints()->create($hint);

	}

	public function updateStatus()
	{
			$id = Input::get('equation_id');
			$eq = Equation::find($id);
			$eq->time_finished = Carbon::now();
			$eq->status = "finished";
			$eq->save();
			return $eq->toArray();
	}


	public function savereaction()
	{
		$data = Input::all();
		$user = Auth::user();
		$user->reactions()->create($data);

	}

	public function seed()
	{
		$data = json_decode($this->generateLexer());
		$lexer = new  Lexer($data->{'lexer'});
		srand();
		$gen   = new SimpleRandom(rand());
		$result = '';

		$parser = new Parser($lexer,new Scope(),new Scope());
		// echo "<table border=1>";
		// for ($i=0; $i < 100; $i++) {
		// 	echo "<tr>";
		// 	for ($j=0; $j < 100; $j++) {
		// 		$result = "";
		// 		$parser->parse()->getResult()->generate($result,$gen);
		// 		echo "<td>" . $result . "</td>";
		// 	}
		// 	echo "</tr>";
		// }
		// echo "</table>";

		$parser->parse()->getResult()->generate($result,$gen);

		$data = array('equation'=>$result, 'time_started'=>Carbon::now(), 'difficulty'=>$data->{'difficulty'});

		$model = Auth::user()->equations()->create($data);
		return json_encode($model);
	}


	public function seed_students()
	{
		$students = array("Ronalette Aman",
											"Stephen Cudia",
											"Amando Golondrina",
											"Veronica Reyes",
											"Benjie Vega",
											"Jeric Acosta",
											"Kenneth Bucad",
											"Jan Nombre",
											"Alex Palana",
											"Francis Reynante",
											"Ronadine Amata",
											"Maisie Ariz",
											"Shane Canete",
											"Shaira Castor",
											"Jellana Magadia",
											"Angel Moneda",
											"Janella Sonon",
											"Jeane Soriano",
											"Alfonso Ansaldo",
											"Khier Bejar",
											"Charles Cerez",
											"Kyla Perucho",
											"Judith Ramiso",
											"Kathleen Tabi",
											"Blase Blase");
		foreach ($students as $student) {
			$name = explode(" ", $student);
			$data = array("first_name"=>$name[0],
										"last_name"=>$name[1],
										"password"=>Hash::make('1234'),
										"student_group"=>"emphatic");
			Equation::create($data);
		}
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
}
