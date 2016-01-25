<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class PiaLog extends Model {

  protected $primaryKey = "pia_log_id";
  protected $fillable = ['student_number', 'equation_id', 'reaction'];


	public function equation()
  {
    return $this->belongsTo('App\Equation', 'equation_id');
  }

  public function student()
  {
    return $this->belongsTo('App\Student', 'student_number');
  }

}
