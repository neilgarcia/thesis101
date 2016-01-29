<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Student extends Model implements AuthenticatableContract, CanResetPasswordContract
{

  use Authenticatable, CanResetPassword;

	protected $primaryKey = 'student_number';


  protected $fillable = ['first_name', 'last_name', 'student_number', 'password', 'student_group'];

  public function piaLogs()
  {
    return $this->hasMany('App\PiaLog', 'student_number');
  }

  public function equations()
  {
    return $this->hasMany('App\Equation', 'student_number');
  }

  public function hints()
  {
    return $this->hasMany('App\Hint', 'student_number');
  }

  public function reactions()
  {
    return $this->hasMany('App\PiaLog', 'student_number');
  }

}
