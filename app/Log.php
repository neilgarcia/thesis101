<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

	protected $primaryKey = 'log_id';

  protected $fillable = ['log_id', 'equation', 'equation_id', 'status', 'emotion'];

  public function student()
  {
    return $this->belongsTo('App\Equation', 'equation_id');
  }

}
