<div class='container'>

	<div class="page-header">
	  <h1>{{ ucfirst($country) }} {{ ucfirst($category) }}</h1>
	</div>

	<div class='row'>
		<div class='row'>
		<?php $i = 0; ?>
		<?php foreach ($videos as $video) {?>
			<?php
				$id = $video->name; 
				$id .= $video->links()->first()->link.".jpg"; 
				if ($i % 4 == 0) {
					echo "</div>";
					echo "<div class='row'>";
				}
				$i++;
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
			</div>
		<?php } ?>
	</div>
</dvi>