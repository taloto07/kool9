<?php
class Category extends Eloquent{
	public $timestamps = false;

	public function countries(){
		return $this->belongsToMany('Country', 'countries_categories', 'countries_id', 'categories_id');
	}

	public function countriescategories(){
		return $this->hasMany('CountryCategory', 'categories_id');
	}
}