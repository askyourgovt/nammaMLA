<!DOCTYPE html>
<html>
<head>

<title>NammaMLA</title>
<meta name="description"  content="">
<meta property="og:title" content=""/>
<meta property="og:description" content=""/>
<meta property="og:site_name" content=""/>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">


<link href="/static/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/static/bootstrap/css/bootstrap_spacelab.css" rel="stylesheet">
<link href="/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link rel="stylesheet" href="/static/font-awesome/css/font-awesome.min.css">
<script src="/static/jqueryui/js/jquery-1.9.1.js"></script>
<script src="/static/bootstrap/js/bootstrap.js"></script>
@section('header_section')
@show

</head>
<body data-spy="scroll" data-target=".subnav" data-offset="80">
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
      <div class="container" style="width: auto;">
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="/">Namma MLA</a>
        <div class="nav-collapse">
          <ul class="nav">
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">About Us<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="/about">About</a></li>
                  <li><a href="/license">License</a></li>
                </ul>
               </li>
             <li><a href="">Help</a></li>     
          </ul>
          <form class="navbar-search pull-right">
              <input type="text" class="search-query span2" name="search_mla_place" id="search_mla_place" placeholder="Search MLA or Constituency">
          </form>
        </div><!-- /.nav-collapse -->
      </div> <!-- /container -->
    </div><!-- /navbar-inner -->
  </div><!-- /navbar -->
  
         <div class="container">
         <!-- Masthead
		================================================== -->
		<header class="jumbotron subhead" id="overview">
		  <div class="row">
		    <div class="span12">
		    	<div class="span6">
					@section('main_title')
					@show
				</div>
		    </div>
		  </div>
		</header>
         
         
		<!-- main section
		================================================== -->
		    <div class="span3">
		    	 <div class="well">

			@section('sidebar')
			    <!--This is the master sidebar. -->
			@show
			 </div>
		    </div>
		    <div class="span8">


		 
		 
				    @yield('content')
		
		  
	            </div>
		
	
	
	
		<br>

	      
	      </div><!-- /container -->
        
	     <!-- Footer
	      ================================================== -->
	      <footer class="footer">
	      <div class="container">
		<div class="span12">
		  <div class="span2">
		    <row>
		    <div class="span2" align="center" style="height:125px; width:125px; background-color:#0B5BAE;border-radius:10px;"><br><center><font color="white"><br>Namma<br>MLA</font></center></div>
		    </row>
		  </div>
		 </div>
	      </div>
	      </footer>
        
        
        
        
        
        </body>
</html>
