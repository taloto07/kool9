
	<a href='#'>go home</a>
	<a href='{{ url('/') }}'>Go Home</a>
	<br/>
	<?php echo $content; echo " $name";?> 
	<br/> what the!<br/>

	<ul>
	<?php foreach ($countries as $country) {?>
		<li><?= $country->name ?> : <?= $country->image ?> </li>
	<?php } ?>
	</ul>
	
	<p><?php echo $video->name ?></p>
	
	<ul>
	<?php foreach ($video->links()->get() as $link) { ?>
		<li> <?php echo $link->id ." $link->link ".$link->video()->first()->name;?> </li>
	<?php } ?>
	</ul>
