<?php
class CountryCategory extends Eloquent{
	public $timestamps = false;

	protected $table = "countries_categories";

	public function country(){
		return $this->belongsTo('Country', 'contries_id');
	}

	public function category(){
		return $this->belongsTo('Category', 'categories_id');
	}
}