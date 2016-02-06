@extends('app')

@section('css')
  <link rel="stylesheet" type="text/css" href="/css/style.css">
@stop

@section('content')
    <div class="content">
        <div class="wrapper">
        <h1>
          Personal Information
        </h1>
        <div class="form-wrapper">
            <form role="form">
              <div class="form-group col-lg-7">
                <label>Student Code: </label>
                <input type="text" class="form-control" value="{!! $user->student_number !!}" disabled>
              </div>
              <div class="form-group col-lg-7">
                <label>First Name: </label>
                <input type="text" class="form-control" value="{!! $user->first_name !!}">
              </div>
              <div class="clear"></div>
              <div class="form-group col-lg-7">
                <label>Last Name: </label>
                <input type="text" class="form-control" value="{!! $user->last_name !!}">
              </div>
              <div class="clear"></div>
              <div class="form-group col-lg-7">
                <label>Birthday: </label>
                <input type="date" class="form-control">
              </div>
              <div class="form-group col-lg-10">
                <label>Address </label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group col-lg-6">
                <input type="submit" class="btn btn-primary col-lg-3" value="Edit" style="margin-right:10px">
                <input type="submit" class="btn btn-success col-lg-3" value="Save">
              </div>
            </form>
        </div>
        </div>
    </div>
@stop
