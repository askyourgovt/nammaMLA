@extends('layouts.apilayout')
header('Content-type: text/javascript');
@section('content')
<?php
echo json_encode($data);

?>
@stop