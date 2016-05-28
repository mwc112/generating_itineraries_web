Hi, {{$first_name}}!

Please confirm your email address by clicking the following link:<br>

<a href="{{url('confirm_email') . '?key=' . $key . '&email=' . $email}}">Confirm</a><br>

Thanks!
