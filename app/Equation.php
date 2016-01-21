<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Equation extends Model {

	//
  //
  protected $primaryKey = 'equation_id';
  protected $fillable = ['equation_id', 'equation', 'student_number', 'status', 'time_started', 'time_finished'];

  public function student()
  {
    return $this->belongsTo('App\Student', 'student_number');
  }

  public function logs()
  {
    return $this->hasMany('App\Log', 'equation_id');
  }

  public function hints()
  {
    return $this->hasMany('App\Hint', 'equation_id');
  }

}
