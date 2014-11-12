<div class='intro-header'>
	<div class='container'>
		<div class='row'>
			<div class='col-md-offset-3 col-md-6'>
				<form action='{{ url("/") }}' method='get'>
					<div class="form-group form-group-lg">
						<div class="input-group">
					      	<input class="form-control" type="text" placeholder="Search" name='key'>
					      	<div class="input-group-addon"><span class="glyphicon glyphicon-search"></span></div>
					    </div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="content-section-a">
	<div class='row padding'>

        <div class="page-header">
            <h1>Recently Added</h1>
        </div>


        <div id='makeMeScrollable'>
            @foreach ($recentyAddedVideos as $video)
                <div class="thumbnail" id='scroll-item'>
                  <a href="{{ url("/play/$video->id") }}">
                    <img src="{{ url("$video->image") }}" width='300' height='300' class='img-thumbnail' title='{{$video->name}}'/>
                      </a>
                  <div class="caption">
                    <h5>{{ substr($video->name, 0, 18) }}...</h5>
                    <p>Views: <span class="label label-default">{{$video->view}}</span><p>
                    <p>Date: {{$video->date}}</p>
                  </div>
                </div>
            @endforeach
        </div>
	</div>
</div>

<div class='content-section-b'>
	<div class='row padding'>
		<div class="page-header">
			<h1>Most View</h1>
		</div>

		<div id='makeMeScrollable'>
		@foreach ($mostViewVideos as $video)

			<div class="thumbnail">
			  	<a href="{{ url("/play/$video->id") }}">
			    	<img src="{{ url("$video->image") }}" width='300' height='300' class='img-thumbnail' title='{{$video->name}}'/>
				 </a>
			  	<div class="caption">
			    	<h5>{{ substr($video->name, 0, 18) }}...</h5>
			    	<p>Views: <span class="label label-default">{{$video->view}}</span><p>
					<p>Date: {{$video->date}}</p>
				</div>
			</div>

		@endforeach
		</div>
	</div>
</div>

<div class="content-section-a">
	<div class='row padding'>
		<div class="page-header">
	  		<h1>Comedy</h1>
		</div>
		<div id='makeMeScrollable'>
		@foreach ($comdeyVideos as $video) {?>

			<div class="thumbnail">
			  <a href="{{ url("/play/$video->id") }}">
			    <img src="{{ url("$video->image") }}" width='300' height='300' class='img-thumbnail' title='{{$video->name}}'/>
				  </a>
			  <div class="caption">
			    <h5>{{ substr($video->name, 0, 18) }}...</h5>
			    <p>Views: <span class="label label-default">{{$video->view}}</span><p>
				<p>Date: {{$video->date}}</p>
			  </div>
			</div>

		@endforeach
		</div>
	</div>
</div>
