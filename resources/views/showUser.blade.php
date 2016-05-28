@extends('layouts.main')
@section('content')

<h1>Show user information</h1>

<form action="{{url('user')}}" method="POST">
{{csrf_field()}}
First Name: <input type="text" name="first_name" id="show_first_name" value="{{$user->first_name}}"><br>
Last Name: <input type="text" name="last_name" id="show_last_name" value="{{$user->last_name}}"><br>
Age: <input type="text" name="age" id="show_age" value="{{$user->age}}"><br>
Email: <input type="text" name="email" id="show_email" value="{{$user->email}}"><br>
Password: <input type="text" name="password" id="show_password"><br>
Password Confirmation: <input type="text" name="password_confirmation" id="show_password_confirm"><br>
<input type="submit" name="Submit" value="Update" id="show_update">
</form>

@endsection
