<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
class GenerateController extends Controller {

	public function checkCollege($id)
	{
		if($id == 'dentistry'){
			return 'COLLEGE OF DENTISTRY';
		}else if ($id == 'computer') {
			return 'COLLEGE OF COMPUTER STUDIES AND SYSTEMS';
		}else if ($id == 'education') {
			return 'COLLEGE OF EDUCATION';
		}else if ($id == 'arts') {
			return 'COLLEGE OF ARTS AND SCIENCES';
		}else if ($id == 'business') {
			return 'COLLEGE OF BUSINESS ADMINISTRATION';
		}else if ($id == 'engineering') {
			return 'COLLEGE OF ENGINEERING';
		}
	}

	public function generate($id)
	{
		$college = $this->checkCollege($id);
		$students = Student::where('college', 'LIKE', '%' . $college . '%')->orderBy('lastname')->get();
		$pdf = \PDF::loadView('layouts.spreadsheet', compact('students'));
		//return view('layouts.spreadsheet', compact('students'));
		return $pdf->download('test.pdf');
	}

}
