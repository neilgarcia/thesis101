<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class hint extends Model {

	//

  protected $primaryKey = 'hint_id';
  protected $fillable = ['equation', 'hint_id', 'equation_id', 'student_number'];


  public function equation()
  {
    return $this->belongsTo('App\Equation', 'equation_id');
  }


  public function student()
  {
    return $this->belongsTo('App\Student', 'student_number');
  }


}
