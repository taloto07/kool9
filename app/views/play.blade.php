<div class='container'>
	<div class='row'>
		<div class='col-md-6'>
			<div class="page-header">
				<h3>{{$video->name}} Part {{ $partNumber }}</h3>
			</div>
			<div class="embed-responsive embed-responsive-16by9">
			  <iframe class="embed-responsive-item" src="//www.youtube.com/embed/{{$link->link}}"></iframe>
			</div>
		</div>

		<div class='col-md-4'>
			<div class="page-header">
				<h3>Play List</h3>
			</div>
			<div class="panel panel-default">
			  <?php $i = 1; ?>
			  <?php foreach ($video->links()->get() as $eachLink) {?>
			  	<div @if($partNumber == $i) class="bg-info" @else class="media" @endif>
			  	  <a class="media-left" @if($partNumber != $i) href="{{ url("/play/$video->id/$i") }}" @endif>
					<img src="{{ url("$eachLink->image") }}" width='100' height='100' class='img-thumbnail' title='{{ $video->name }}'/>
				  </a>
				
				  <div class="media-body">
				    <h5 class="media-heading">{{$video->name}} Part {{$i++}}</h5>
				    View: <span class="label label-default">{{$eachLink->view}}</span>
				  </div>
				</div>
			  <?php } ?>
			</div>
		</div>
	</div>
</div>
