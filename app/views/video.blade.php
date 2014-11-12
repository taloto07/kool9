<div class='container main'>
	<cl>
	<ol class="breadcrumb">
		<li><a href="#">{{ ucfirst($country) }}</a></li>
		<li class='active'>{{ ucfirst($category) }}</li>
	</ol>



		<?php $i = 0; ?>
		<?php foreach ($videos as $video) {?>
			<?php
				$id = $video->name; 
				$id .= $video->links()->first()->link.".jpg";
			?>
			<div class='col-sm-3 col-xs-6'>
				<?php $videoId = $video->id; ?>
				
				<div class="thumbnail">
				  	<a href="{{ url("/play/$video->id") }}">
			        	<img src="{{ url("$video->image") }}" width='300' height='300' title='{{ $video->name }}'/>
			  	  	</a>
			      	<div class="caption">
			        	<h5>{{ substr($video->name, 0, 18) }}...</h5>
			        	<p>Views: <span class="label label-default">{{$video->view}}</span><p>
						<p>Date: {{$video->date}}</p>
			      	</div>
			    </div>
			</div> <!-- close div for each video -->
		<?php } ?>

</div>



