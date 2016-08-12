@extends('layouts.main')
@section('content')

<table border="1">

@for($i = 0; $i < count($trips); $i++)

<tr>

<td>
{{$trips[$i]->city}}
</td>
<td>
{{$trips[$i]->start_date_time}}
</td>
<td>
{{count(json_decode($trips[$i]->waypoints))}}
</td>
@if(Auth::check())
<td>
{{-- TODO: Show when trip has been uploaded - uploaded variable --}}
<form action="{{url('trips')}}" method="POST">
<input type="hidden" name="id" value="{{$trips[$i]->id}}" id="trips_id">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="submit" name="Submit" value="Upload" id="trips_upload">
</form>
</td>
@endif
</tr>


@endfor



</table>


@endsection
