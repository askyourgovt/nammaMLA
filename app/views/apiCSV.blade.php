@extends('layouts.apilayout')

@section('content')
Date,Attendance
@foreach ($results as $r)
{{ $r->session_date }},{{ $r->attendance }}{{"\n"}}
@endforeach
@stop