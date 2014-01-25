
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
        <td>Department</td>      
        <td>Type</td>
        <td>Question Subject</td>
    </thead>
    <tbody>
        @foreach ($questions as $q)
        <tr>
            <td>{{ $q->assembly_name }}</td>
            <td>{{ $q->session_name }}</td>
            <td>{{ $q->asked_date }}</td>
            <td>{{ $q->dept_name }}</td>            
            <td>
              @if ($q->question_type === 'S')
                <span data-toggle="tooltip" title="Starred questions">S</span>
              @else
                <span data-toggle="tooltip" title="Unstarred questions">S</span>
              @endif
            </td>
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
            "iDisplayLength": 25,
            "sPaginationType": "full_numbers",
            "aoColumnDefs": [
            { "bVisible": false, "aTargets": [ 0 ] }
            ],
            "aaSortingFixed": [[ 0, 'asc' ]],
            "aaSorting": [[ 1, 'asc' ]],
            "sDom": 'lfr<"giveHeight"t>ip',
            "fnDrawCallback": function ( oSettings ) {
                if ( oSettings.aiDisplay.length == 0 )
                {
                    return;
                }


            

                var nTrs = $('#data_table tbody tr');
                var iColspan = nTrs[0].getElementsByTagName('td').length;
                var sLastGroup = "";
                for ( var i=0 ; i<nTrs.length ; i++ )
                {
                    var iDisplayIndex = oSettings._iDisplayStart + i;
                    var sGroup = oSettings.aoData[ oSettings.aiDisplay[iDisplayIndex] ]._aData[0];
                    if ( sGroup != sLastGroup )
                    {
                        var nGroup = document.createElement( 'tr' );
                        var nCell = document.createElement( 'td' );
                        nCell.colSpan = iColspan;
                        nCell.className = "group";
                        nCell.innerHTML = "<b>Assembly: "+sGroup+"</b>";
                        nGroup.appendChild( nCell );
                        nTrs[i].parentNode.insertBefore( nGroup, nTrs[i] );
                        sLastGroup = sGroup;
                    }
                }



            }//fndrawcallback




        }
        

        );


    } );
</script>
   

@stop
