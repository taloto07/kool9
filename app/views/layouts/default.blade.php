<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="{{url("favicon.ico")}}">

    <title>{{ $title }}</title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('css/bootstrap.min.css') }}

    <!-- Custom styles for this template -->
    {{ HTML::style('css/jumbotron.css') }}

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if(isset($styles))
      @foreach ($styles as $style)
        {{ HTML::style('css/'.$style) }}
      @endforeach
    @endif

  </head>

  <body>
    <div class="navbar navbar-default navbar-fixed-top nav-main" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{url('/')}}">Movie Project</a>
		    </div>

        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-left">
            <li class="{{ $home or ''}}"><a href="{{url('/')}}">Home</a></li>
            <?php if(isset($countries)) {
            	foreach ($countries as $country) {?>
            	<?php if (!is_null($country->categories()->first())) { ?>	
		            <li class="dropdown">
		              <a href="" class="dropdown-toggle" data-toggle="dropdown"><?= $country->name ?> <span class="caret"></span></a>
		              <ul class="dropdown-menu" role="menu">

		              	<?php foreach ($country->categories()->get() as $category){ ?>
		              		<li><a href="{{url('/videos', array($country->id, $category->id)) }}"><?= $category->name ?></a></li>
		              	<?php } ?>

		              </ul>
		            </li>
		        <?php } ?>
            <?php } }?>
            <!-- <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li> -->
          </ul>	
          @if(!isset($home))
            <form class="navbar-form navbar-right" role="form" action=" {{url("/search")}} " method="get">
              <div class="form-group form-group-md">
                <div class="input-group">
                      <input class="form-control" type="text" placeholder="Search" name='k'>
                      <div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
                  </div>
              </div>
            </form>
          @endif

          @if(Auth::check())
            <ul class="nav navbar-nav navbar-right">
              <li class="dropdown">
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  <span class="glyphicon glyphicon-user"></span>
                  {{Auth::user()->firstname}} {{ Auth::user()->lastname }}
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                  <li><a href="{{ url('/user/signout') }}">Logout</a></li>
                  @if(Auth::user()->email === "taloto07@gmail.com")
                    <li><a href="{{ url('/admin/upload') }}">Upload</a></li>
                  @endif
                </ul>
              </li>
            </ul>
          @else
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="{{url("user/signin")}}">Sign In</a>
              </li>
            </ul>
          @endif
        </div><!--/.navbar-collapse -->
      </div>
    </div>

    @if(Session::has('global'))
      <div class="alert alert-warning alert-dismissible" role="alert" style="position:absolute; left:0px; top:50px">
        <button type="button" class="close" data-dismiss="alert">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('global') }}</strong>
      </div>
    @endif

    <noscript>
      <style type="text/css">
        .hide-if-no-javascript{
          display: none;
        }
      </style>
      <div class="alert alert-danger main">
        <h2>Please, enable javascript to properly display all contents!!!</h2>
      </div>
    </noscript>
    
    {{ $content }}

    <footer>
      <div class='container'>
        <div class='row'>
          <div class='col-lg-12'>
            <div class='row'>
      	      <p>&copy; Company 2014</p>
            </div>
            <div class='row'>
              @foreach ($countries as $country)
                @if(!is_null($country->categories()->first()))
                  <div class='col-lg-2'>
                    <p class='page-header'>{{$country->name}}</p>
                    @foreach($country->categories()->get() as $category)
                      <p><a href="{{ url( "videos", array( $country->id, $category->id ) ) }}">{{$category->name}}</a></p>
                    @endforeach
                  </div>
                @endif
              @endforeach
            </div>
          </div>
        </div>
    	</div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"></script>

    {{ HTML::script('js/bootstrap.min.js'); }}

    @if(isset($scripts))
      @foreach($scripts as $script)
        {{ HTML::script('js/'.$script) }}
      @endforeach
    @endif

    {{ $inlineScript or "" }}
    
  
  </body>
</html>
