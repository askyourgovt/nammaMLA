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
    <img src="/static/profile_pictures/d-k-shivakumar.jpg" style="width:250px; border-radius:10px;" />
    <h4><?php echo $rep_role->role_name; ?> (<?php echo $rep_role->constituency_name; ?> - <?php echo $rep_role->constituency_number; ?>)</h4>    
    <table>
        <tr>
            <td valign="top"><b>Born</b></td><td> Karnataka (1954)</td>
        </tr>
        <tr>
            <td><b>Party</b></td><td> Indian National Congress</td>
        </tr>
        <tr>
            <td><b>Education</b></td><td> Graduate (B.Sc)</td>
        </tr>

        <tr>
            <td valign="top"><b>Address</b></td><td>No.602,KENKRERI,18th Cross, Sadashiva Nagar, <br>Bangalore-560 080.</td>
        </tr>
        <tr>
            <td><b>Phone:</b></td><td>9845156524</td>

        </tr>
    </table>
    </center>
@stop

@section('content')
    <row>
        <p>D. K. Shivakumar is a politician from Karnataka.He belongs to Vokalliga community. He is Congress MLA from Kanakapura consitituency.</p>
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
