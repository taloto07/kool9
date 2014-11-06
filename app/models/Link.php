<?php
class Link extends Eloquent{
	public $timestamps = false;

	public function video(){
		return $this->belongsTo('Video', 'videos_id');
	}
}