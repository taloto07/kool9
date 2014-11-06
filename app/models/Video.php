<?php
class Video extends Eloquent{
	public $timestamps = false;

	public function links(){
		return $this->hasMany('Link', 'videos_id');
	}
}