<html>
<head>
</head>
<body>
@if(Auth::check())
<a href="{{url('user')}}">Account</a>
<a href="{{url('logout')}}">Logout</a>
@else
<a href="{{url('register')}}">Register</a>
<a href="{{url('login')}}">Login</a>
@endif

@yield('content')
</body>
</html>
