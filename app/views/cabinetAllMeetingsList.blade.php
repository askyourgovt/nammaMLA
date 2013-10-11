
@extends('layouts.master')

@section('header_section')
    @parent
@stop



@section('main_title')
    @parent
    <h2>Cabinet Meetings</h2>            
@stop



@section('sidebar')
    @parent
    <center>
        Note about these cabinet meetings
    </center>
@stop

@section('content')
    <table class="table table-hover">
    <thead>
        <tr>
            <th> Month/Year </th>
            <td> No of Meetings</td>
            <th> English </th>
            <th> Kannada </th>
        </tr>
    </thead>
    <tbody>
            <tr>
                <td> May 2013 </td>
                <td> 10</td>
                <td> <a href="">Download</a></td>
                <td></td>
            </tr> 

            <tr>
                <td> Jun 2013 </td>
                <td></td>                
                <td> <a href="">Download</a></td>
                <td></td>
            </tr>    
            
            <tr>
                <td> Jul 2013 </td>
                <td></td>                
                <td> <a href="">Download</a></td>
                <td></td>
            </tr>    
            
            <tr>
                <td> Aug 2013 </td>
                <td></td>                
                <td> <a href="">Download</a></td>
                <td></td>
            </tr>    

            <tr>
                <td> Sep 2013 </td>
                <td></td>
                <td> <a href="">Download</a></td>
                <td></td>
            </tr>    

     </tbody>
</table>



@stop
