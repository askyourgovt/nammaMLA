@extends('layouts.master')

@section('header_section')
    @parent
    <style>
        body {
          shape-rendering: crispEdges;
        }

        .day {
          fill: #fff;
          stroke: #ccc;
          stroke-width: 1.2px;

        }

        .month {
          fill: none;
          stroke: #000;
          stroke-width: 1.2px;
        }

        .RdYlGn .q0-11{fill:rgb(255,0,0)}
        .RdYlGn .q1-11{fill:rgb(0,104,55)}
        .RdYlGn .q2-11{fill:rgb(255,255,191)}
</style>
<script src="/static/d3/d3.min.js"></script>
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
            <td colspan=2><i class="icon-calendar"></i> <a href="/rep/attendance/<?php echo $rep->rep_key; ?>">Detailed Attendance Sheet</a></td>
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
   

    <script>
    var width = 960,
    height = 136,
    cellSize = 17; // cell size

var    attendance = ['Absent','Present','N.A']

var day = d3.time.format("%w"),
    week = d3.time.format("%U"),
    percent = d3.format(".1%"),
    format = d3.time.format("%Y-%m-%d");

var color = d3.scale.quantize()
    .domain([0, 2])
    .range(d3.range(3).map(function(d) { return "q" + d + "-11"; }));


var svg = d3.select("row").selectAll("svg")
    .data(d3.range(2013,2014))
  .enter().append("svg")
    .attr("width", width)
    .attr("height", height)
    .attr("class", "RdYlGn")
  .append("g")
    .attr("transform", "translate(" + ((width - cellSize * 53) / 2) + "," + (height - cellSize * 7 - 1) + ")");

svg.append("text")
    .attr("transform", "translate(-6," + cellSize * 3.5 + ")rotate(-90)")
    .style("text-anchor", "middle")
    .text(function(d) { return d; });

var rect = svg.selectAll(".day")
    .data(function(d) { return d3.time.days(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
  .enter().append("rect")
    .attr("class", "day")
    .attr("width", cellSize)
    .attr("height", cellSize)
    .attr("x", function(d) { return week(d) * cellSize; })
    .attr("y", function(d) { return day(d) * cellSize; })
    .datum(format);

rect.append("title")
    .text(function(d) { return d; });

svg.selectAll(".month")
    .data(function(d) { return d3.time.months(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
  .enter().append("path")
    .attr("class", "month")
    .attr("d", monthPath);

d3.csv("/api/rep/<?php echo $rep->rep_key; ?>/attendance/csv", function(error, csv) {
  var data = d3.nest()
    .key(function(d) { return d.Date; })
    .rollup(function(d) {  console.log("'"+d[0].Attendance+"'"); if(d[0].Attendance == 'P'){ return 1; } else if(d[0].Attendance == 'A'){ return 0 ;}else{ return 2;} })
    .map(csv);

  rect.filter(function(d) { return d in data; })
      .attr("class", function(d) { return "day " + color(data[d]); })
    .select("title")
      .text(function(d) { return d + ": " + attendance[data[d]] ; });
});

function monthPath(t0) {
  var t1 = new Date(t0.getFullYear(), t0.getMonth() + 1, 0),
      d0 = +day(t0), w0 = +week(t0),
      d1 = +day(t1), w1 = +week(t1);
  return "M" + (w0 + 1) * cellSize + "," + d0 * cellSize
      + "H" + w0 * cellSize + "V" + 7 * cellSize
      + "H" + w1 * cellSize + "V" + (d1 + 1) * cellSize
      + "H" + (w1 + 1) * cellSize + "V" + 0
      + "H" + (w0 + 1) * cellSize + "Z";
}

d3.select(self.frameElement).style("height", "2910px");
    </script>
    </row>

@stop
