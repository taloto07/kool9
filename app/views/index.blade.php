
<div class="container">
	<div class='row'>
		<div class="page-header">
	  		<h1>Recently Added</h1>
		</div>
		<?php foreach ($recentyAddedVideos as $video) {?>
			<div class='col-sm-3 col-xs-6'>
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
			</div>	
		<?php } ?>
	</div>

	<div class='row'>
		<div class="page-header">
			<h1>Most View</h1>
		</div>
		<?php foreach ($mostViewVideos as $video) {?>
			<div class='col-sm-3 col-xs-6'>
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
			</div>
		<?php } ?>
	</div>
</div> <!-- /container -->
