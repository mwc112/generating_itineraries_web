@extends('layouts.main')
@section('content')

<!-- Do validation on input including confirm password  -->

<form action="{{url('register')}}" method="POST">
{{csrf_field()}}
First Name: <input type="text" name="first_name" id="reg_first_name"><br>
Last Name: <input type="text" name="last_name" id="reg_last_name"><br>
Age: <input type="text" name="age" id="reg_age"><br>
Email: <input type="text" name="email" id="reg_email"><br>
Password: <input type="text" name="password" id="reg_password"><br>
Password Confirmation: <input type="text" name="password_confirmation" id="reg_password_confirm"><br>
<input type="submit" name="Submit" value="Register" id="reg_submit">
</form>

<br>
<br>

<!--@foreach($errors->all() as $error)
<p>{{$error}}</p><br>
@endforeach-->

@endsection
