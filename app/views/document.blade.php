
@extends('layouts.master')

@section('header_section')
    @parent
@stop



@section('main_title')
    @parent
    <h2>{{ $document->document_name }}</h2>            
@stop



@section('sidebar')
    @parent
    <center>
    <table>
      <tbody>
        <tr>
            <td>{{ $document->document_description }} </td>
        </tr>
       

         <tr>
            <td><a href="http://docs.nammamla.org.s3.amazonaws.com/{{ $document->document_url }}"><i class="icon-download-alt"></i> Download</a>&nbsp;<span class="label label-warning"><?=$document['document_file_type']?></span>
            </td>
        </tr>
      </tbody>
    </table>
        
    </center>
@stop

@section('content')
 
 <table class="table table-striped table-bordered">
    <tbody>


    @if ($document->document_format == "pdf")
      <tr><td colspan=2><canvas id="the-canvas" style="border:1px solid black"></canvas></td></tr>
    <tr >
        <td colspan=2><button id="prev" onclick="goPrevious()">Previous</button> <button id="next" onclick="goNext()">Next</button> &nbsp; &nbsp;<span>Page: <span id="page_num"></span> / <span id="page_count"></span></span></td>              
    </tr>                  
      <script type="text/javascript" src="/static/pdf/pdf.js"></script>
      <script type="text/javascript">
          var url = 'http://docs.nammamla.org.s3.amazonaws.com/{{ $document->document_url }}';
      </script>  
      <script type="text/javascript" src="/static/pdf/pdfview.js"></script>
    @endif



    @if ($document->document_format == "jpg" or $document->document_format == "png")
       <tr>
        <td  colspan=2><img style="border:1px solid black" src="http://docs.nammamla.org.s3.amazonaws.com/{{ $document->document_url }}" width="600px"></td>
      </tr>
    @endif

    </tbody>
</table>

@stop
