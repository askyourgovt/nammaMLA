@extends('layouts.fullpage')

@section('header_section')
    @parent
    <link media="Screen" type="text/css" rel="stylesheet" href="/static/datatable/css/jquery.dataTables.css" rel="stylesheet">
    <script type="text/javascript" src="/static/datatable/js/jquery.dataTables.min.js"></script>
@stop



@section('main_title')
    @parent
    <h2><?php echo $assembly->assembly_name; ?></h2>            
@stop


@section('content')
<div class="table-responsive">
  <table class="table" id="data_table">
    <thead>
        <td>Representative</td>
        <td>Party</td>
        <td>Role</td>
        <td>Constituency Name</td>
    </thead>
    <tbody>
        @foreach ($all_reps as $rep)
        <tr>
            <td><a href="/rep/{{ $rep->rep_key }}">{{ $rep->name }}</a></td>
            <td>{{ $rep->role_name }}</td>
            <td>{{ $rep->party_name }}</td>
            <td>{{ $rep->constituency_name }}&nbsp;({{ $rep->constituency_number }})</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<script>
    $(document).ready(function() {
        var oTable = $('#data_table').dataTable(
        {   
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers"
        }
            );
        oTable.fnSort( [ [0,'asc'] ] );
    } );
</script>

@stop
