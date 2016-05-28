@extends('layouts.main')
@section('content')

<form action="{{url('login')}}" method="POST">
{{csrf_field()}}
Email: <input type="text" name="email" id="login_email"><br>
Password: <input type="text" name="password" id="login_password"><br>
<input type="submit" name="Submit" value="Login" id="login_submit">
</form>

<br>
<br>

@if(Session::has('bad_login'))
<p>{{Session::get('bad_login')}}</p>
@endif

@endsection
