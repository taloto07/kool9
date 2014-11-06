<?php
class Country extends Eloquent{
	public $timestamps = false;

	public function categories(){
		return $this->belongsToMany('Category', 'countries_categories', 'countries_id', 'categories_id');
	}

	public function countriescategories(){
		return $this->hasMany('CountryCategories', 'countries_id');
	}
}