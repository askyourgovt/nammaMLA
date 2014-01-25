
@section('header_section')
    @parent
    <link media="Screen" type="text/css" rel="stylesheet" href="/static/datatable/css/jquery.dataTables.css" rel="stylesheet">
    <script type="text/javascript" src="/static/datatable/js/jquery.dataTables.min.js"></script>
@stop




@section('main_title')
    @parent
    <h2><?php echo $rep->name; ?></h2>            
    <p class="lead"><?php echo $rep_role->role_name; ?> (<?php echo $rep_role->constituency_name; ?> - <?php echo $rep_role->constituency_number; ?>)</p>    
@stop


@section('content')
<ul class="nav nav-tabs">
  <li><a href="/rep/{{ $rep->rep_key }}" ><i class="icon-home"></i> Home</a></li>
  <li><a href="/rep/{{ $rep->rep_key }}/attendance" ><i class="icon-calendar"></i> Attendance</a></li>
  <li class="active"><a href="/rep/{{ $rep->rep_key }}/questions" ><i class="icon-question"></i> Questions</a></li>
</ul>

<div class="table-responsive">
  <table class="table" id="data_table">
    <thead>
        <td>Assembly</td>
        <td>Session</td>
        <td>Date</td>
        <td>Type</td>
        <td>Question Subject</td>
    </thead>
    <tbody>
        @foreach ($questions as $q)
        <tr>
            <td>{{ $q->assembly_name }}</td>
            <td>{{ $q->session_name }}</td>
            <td>{{ $q->asked_date }}</td>
            <td>{{ $q->question_type }}</td>
            <td>{{ $q->question }}</td>
        </tr>
        @endforeach
    </tbody>
  </table>
</div>
<script>
    $(document).ready(function() {
        var oTable = $('#data_table').dataTable(
        {   
            "iDisplayLength": 15,
            "sPaginationType": "full_numbers"
        }
            );
        oTable.fnSort( [ [0,'asc'] ] );
    } );
</script>
   

@stop
