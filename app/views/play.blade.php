<div class='container main'>
	<div class='row'>
		<div class='col-md-8'>
			<div class='row'>
				<div class='col-md-12'>
					<div class="page-header">
						<h3>{{$video->name}} Part {{ $partNumber }}</h3>
					</div>
					<div class="embed-responsive embed-responsive-16by9">
					  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$link->link}}" allowfullscreen='true'></iframe>
					</div>
				</div>
			</div>

			<div class='row playlist-navigation'>
				<div class='col-md-12'>
					<div class="panel panel-primary">
						<div class="panel-body">
							<?php $previousPart = $partNumber - 1; ?>
							@if($previousPart >= 1) <a href="{{ url("play/$video->id/$previousPart") }}"> @endif
								<span class="glyphicon glyphicon-chevron-left"></span>
							@if($previousPart >= 1) </a> @endif

							<?php $nextPart = $partNumber + 1; ?>

							@if( $nextPart <= $video->links()->count() ) <a href="{{ url("play/$video->id/$nextPart") }}"> @endif
								<span class="glyphicon glyphicon-chevron-right pull-right"></span>
							@if($nextPart <= $video->links()->count()) </a> @endif
						</div>
					</div>
				</div>
			</div>

			<div class='row'>
				<div class='col-md-12'>
					<div class="well well-lg">
						Comment section goes here!
					</div>
				</div>
			</div>

		</div>

		<?php //playlist section ?>
		<div class='col-md-4'>
			<div class="page-header">
				<h3>Play List</h3>
			</div>
			<div class="panel panel-default play-playlist">
			  <?php $i = 1; ?>

				@foreach ($video->links()->get() as $eachLink)
				  <div class="media {{ ($partNumber == $i) ? 'bg-info' : '' }}">
				  	<a class="media-left media-top" @if($partNumber != $i) href="{{ url("/play/$video->id/$i") }}" @endif>
						<img src="{{ url("$eachLink->image") }}" width='100px' height='100px' title='{{ $video->name }}' />
					</a>
					<div class='media-body'>
						<h4 class="media-heading">{{$video->name}} Part {{$i++}}</h4>
						View: <span class="label label-default">{{$eachLink->view}}</span>
					</div>
				  </div>
				  <hr />
				@endforeach

			</div>
		</div>
	</div>
</div>
