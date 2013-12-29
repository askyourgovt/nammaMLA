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

@section('sidebar')
    @parent
    <center>
     <?php if($rep->rep_picture == 'n') { ?>   
        <img src="/static/profile_pictures/rep_picture.jpg" style="width:225px; border-radius:200px;" />
     <?php }else { ?>   
        <img src="/static/profile_pictures/<?php echo $rep->rep_key; ?>.jpg" style="width:225px; border-radius:225px;" />    
     <?php } ?>   
    <h4><a href="/rep/<?php echo $rep->rep_key; ?>"><?php echo $rep->name; ?></a></h4>
    <h4><?php echo $rep_role->role_name; ?> (<?php echo $rep_role->constituency_name; ?> - <?php echo $rep_role->constituency_number; ?>)</h4>    

    <table>
        <tr>
            <td ><b>Born:</b></td><td> </td>
        </tr>
        <tr>
            <td><b>Party:</b></td><td> <?php echo $rep_role->party_name; ?></td>
        </tr>
        <tr>
            <td><b>Education:</b></td><td> </td>
        </tr>

        <tr>
            <td><b>Address:</b></td><td></td>
        </tr>
        <tr>
            <td><b>Phone:</b></td><td></td>
        </tr>
        <tr>
            <td><b>Email:</b></td><td></td>
        </tr>
        <tr>
            <td><b>Web:</b></td><td></td>
        </tr>
        <tr>
            <td colspan=2><i class="icon-calendar"></i> <a href="/rep/attendance/{{ $rep->rep_key }}">Detailed Attendance Sheet</a></td>
        </tr>

     <?php if($rep_role->ec_affidavits != 'n') { ?>   
        <tr>
            <td colspan=2><i class="icon-download"></i> <a href="/document/view/{{ $rep_role->ec_affidavits }}">EC Affidavit</a></td>
        </tr>
     <?php } ?>
    </table>
        

    </center>
@stop

@section('content')
    <row>
    </row>
    <row>
        <h2>Session Attendance</h2>
        <div class="span4">
            <h4>Recent Session Attendance</h4>
            <canvas id="last_session_attendance" data-type="Doughnut" width="250" height="250"></canvas>

        </div>
        <div class="span3">
            <h4>Overall Session Attendance</h4>
            <canvas id="overall_session_attendance" data-type="Doughnut" width="250" height="250"></canvas>
        </div>
    </row>
    <row>
        <div class="span4">
         <h4>Relative Attendance</h4>
        <canvas id="comparison_barcharts" data-type="Bar" width="500" height="250"></canvas>
        </div>
    </row>

    <script>
var ctx1 = document.getElementById("last_session_attendance").getContext("2d");
var ctx2 = document.getElementById("overall_session_attendance").getContext("2d");
var ctx3 = document.getElementById("comparison_barcharts").getContext("2d");

var data = [
    {
        value: 30,
        color:"#F7464A"
    },
    {
        value : 50,
        color : "#00FE00"
    },
    {
        value : 100,
        color : "#D4CCC5"
    }

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
            data : [28,48]
        }
    ]
};
new Chart(ctx1).Doughnut(data);
new Chart(ctx2).Doughnut(data);
new Chart(ctx3).Bar(data2);

    </script>

@stop
