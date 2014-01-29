@extends('layouts.master')

@section('header_section')
    @parent
    <script src="/static/chartjs/Chart.min.js"></script>
@stop



@section('main_title')
    @parent
    <h2><?php echo $rep->name; ?></h2>            
    <p class="lead"><?php echo $rep_role->role_name; ?> (<?php echo $rep_role->constituency_name; ?> - <?php echo $rep_role->constituency_number; ?>)</p>    
@stop


@section('content')
<ul class="nav nav-tabs">
  <li class="active"><a href="/rep/{{ $rep->rep_key }}" ><i class="icon-home"></i> Home</a></li>
  <li><a href="/rep/{{ $rep->rep_key }}/attendance" ><i class="icon-calendar"></i> Attendance</a></li>
  <li><a href="/rep/{{ $rep->rep_key }}/questions" ><i class="icon-question"></i> Questions</a></li>
</ul>
<div class="row">
    <div class="span4">
         <?php if($rep->rep_picture == 'n') { ?>   
            <img src="/static/profile_pictures/rep_picture.jpg" style="width:225px; border-radius:200px;" />
         <?php }else { ?>   
            <img src="/static/profile_pictures/<?php echo $rep->rep_key; ?>.jpg" style="width:225px; border-radius:225px;" />    
         <?php } ?>   
    </div>
    <div class="span7">
    <table class="table table-hover">
        <tr>
            <td><b>Party</b></td><td> <?php echo $rep_role->party_name; ?></td>
        </tr>
        <tr>
            <td><b>Education</b></td><td><?php echo $rep->qualification; ?></td>
        </tr>
        <tr>
            <td><b>Gender</b></td>
            <td>
                @if ($rep->gender === 'm')
                    Male
                @else
                    Female
                @endif
            </td>
        </tr>

     <?php if($rep_role->ec_affidavits != 'n') { ?>   
        <tr>
            <td colspan=2><i class="icon-download"></i> <a href="/document/view/{{ $rep_role->ec_affidavits }}">EC Affidavit</a></td>
        </tr>
     <?php } ?>
        <tr><td colspan=2>&nbsp;</td></tr>
    </table>
    </div>
</div>


<div class="row">
        <h3>Attendance Highlights</h3>
        <div class="span3">
            <h4>Recent Session Attendance</h4>
            <canvas id="last_session_attendance" data-type="Pie" width="250" height="250"></canvas>
            <center>
            @foreach ($attendance_session as $att)
                @if ($att->attendance == 'a')
                        Absent: {{$att->attendance_count}}
                @elseif ($att->attendance == 'p')
                        Present: {{$att->attendance_count}}
                @else
                        N.A: {{$att->attendance_count}}
                @endif 
            @endforeach
            </center>
        </div>
        <div class="span3">
            <h4>Overall Attendance</h4>
            <canvas id="overall_session_attendance" data-type="Pie" width="250" height="250"></canvas>
            <center>
            @foreach ($attendance_overall as $att)
                @if ($att->attendance == 'a')
                        Absent: {{$att->attendance_count}}
                @elseif ($att->attendance == 'p')
                        Present: {{$att->attendance_count}}
                @else
                        N.A: {{$att->attendance_count}}
                @endif 
            @endforeach
            </center>

        </div>
        <div class="span3">
         <h4>Relative Attendance</h4>
        <canvas id="comparison_barcharts" data-type="Bar" width="500" height="250"></canvas>
        </div>
</div>
<div class="row">
        <h3>Questions Highlights</h3>
        <div class="span3">
            <h4>Recent Session Questions</h4>
            <canvas id="last_session_attendance" data-type="Pie" width="250" height="250"></canvas>

        </div>
        <div class="span3">
            <h4>Overall Questions</h4>
            <canvas id="overall_session_attendance" data-type="Pie" width="250" height="250"></canvas>
        </div>
        <div class="span3">
         <h4>Relative Number of Questions</h4>
        <canvas id="comparison_barcharts" data-type="Bar" width="500" height="250"></canvas>
        </div>
</div>

    <script>
var ctx1 = document.getElementById("last_session_attendance").getContext("2d");
var ctx2 = document.getElementById("overall_session_attendance").getContext("2d");
var ctx3 = document.getElementById("comparison_barcharts").getContext("2d");

var attendance_session = [
        @foreach ($attendance_session as $att)
            @if ($att->attendance == 'a')
                {
                    value: {{$att->attendance_count}},
                    color:"#F7464A",
                    //labelColor : '#444',
                    //labelFontSize : '1em',
                    //label:"Absent ("+{{$att->attendance_count}}+")"
                },
            @elseif ($att->attendance == 'p')
                {
                    value: {{$att->attendance_count}},
                    color:"#00FE00",
                    //labelColor : '#444',
                    //labelFontSize : '1em',
                    //label:"Present ("+{{$att->attendance_count}}+")"
                },
            @else
                {
                    value: {{$att->attendance_count}},
                    color:"#FFFF00",
                    //labelColor : '#444',
                    //labelFontSize : '1em',                    
                    //label:"N.A ("+{{$att->attendance_count}}+")"

                },
            @endif 
        @endforeach

];

var attendance_overall = [
        @foreach ($attendance_overall as $att)
            @if ($att->attendance == 'a')
                {
                    value: {{$att->attendance_count}},
                    color:"#F7464A",
                    //labelColor : '#444',
                    //labelFontSize : '1em',
                    //label:"Absent"

                },
            @elseif ($att->attendance == 'p')
                {
                    value: {{$att->attendance_count}},
                    color:"#00FE00",
                    //labelColor : '#444',
                    //labelFontSize : '1em',
                    //label:"Present"

                },
            @else
                {
                    value: {{$att->attendance_count}},
                    color:"#FFFF00",
                    //labelColor : '#444',
                    //labelFontSize : '1em',
                    //label:"N.A"

                },
            @endif 
        @endforeach
];

var data2 = {
    labels : ["Attendance Session","Attendance Overall"],
    datasets : [
        {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "rgba(220,220,220,1)",
            data : [65,59]
        },
        {
            fillColor : "rgba(151,187,205,0.5)",
            strokeColor : "rgba(151,187,205,1)",
            data : [28,18]
        }
    ]
};
var options = {
                        tooltips: {
                                fontSize: '75.4%'
                        }
                };
new Chart(ctx1).Doughnut(attendance_session,options);
new Chart(ctx2).Doughnut(attendance_overall);
//new Chart(ctx3).Bar(data2);

    </script>

@stop
