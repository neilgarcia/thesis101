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

  protected $fillable = ['first_name', 'last_name', 'student_number', 'password'];

}
