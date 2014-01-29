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
        .RdYlGn .q2-11{fill:rgb(255,255,0)}
</style>
<script src="/static/d3/d3.min.js"></script>
@stop



@section('main_title')
    @parent
    <h2><?php echo $rep->name; ?></h2>            
@stop




@section('content')
<ul class="nav nav-tabs">
  <li><a href="/rep/{{ $rep->rep_key }}" ><i class="icon-home"></i> Home</a></li>
  <li class="active"><a href="/rep/{{ $rep->rep_key }}/attendance" ><i class="icon-calendar"></i> Attendance</a></li>
  <li><a href="/rep/{{ $rep->rep_key }}/questions" ><i class="icon-question"></i> Questions</a></li>
</ul>

    <row>
   

    <script>
            var width = 960,
            height = 136,
            cellSize = 17; // cell size

            var    attendance = ['Absent','Present','Not Applicable','No Session']

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
                .text(function(d) { return d + ": " + "No Session"; });

            svg.selectAll(".month")
                .data(function(d) { return d3.time.months(new Date(d, 0, 1), new Date(d + 1, 0, 1)); })
              .enter().append("path")
                .attr("class", "month")
                .attr("d", monthPath);

            d3.csv("/api/rep/<?php echo $rep->rep_key; ?>/attendance/csv", function(error, csv) {
              var data = d3.nest()
                .key(function(d) { return d.Date; })
                .rollup(function(d) {  console.log("'"+d[0].Attendance+"'"); if(d[0].Attendance == 'p'){ return 1; } else if(d[0].Attendance == 'a'){ return 0 ;} else if(d[0].Attendance == 'na'){ return 2 ;} else{ return 3;} })
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
<br><br>
<row>
    <table border=1 cellpadding="5">
        <tr>
          <td width="100px">No session</td>
          <td width="100px" bgcolor="green">Present</td>
          <td width="100px" bgcolor="red">Absent</td>
          <td width="100px" bgcolor="yellow">Not Applicable</td>          
        </tr>
    </table>
</row>


@stop
