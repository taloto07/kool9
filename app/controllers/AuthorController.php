<?php

class AuthorController extends BaseController{

	public function index($name){
		$variable = array('title'=>'Author Page fuck', 'content'=>'hello author', 'name'=>$name);
		$view = View::make('authors.index', $variable);

		$countries = Country::all();
		$view->countries = $countries;

		$video = Video::find(7);

		$link = Link::find(7);	
		// $video->load('link');
		
		$oneVideo = $link->video();

		$view->video = $video;
		$view->links = $video->links()->get();
		

		$orderByColumn = "date";

		Video::where(function($query){
			$query->where('id','>=','7')
			->where('id','<=','8');
		})
		->orderBy($orderByColumn,'desc')
		->get();

		 foreach (Country::all() as $country){
		 	foreach ($country->categories()->get() as $category){
		 		echo $country->name ." ". $category->name ."<br/>";
		 	}
		 }

		 $cambodian = Country::where('name','cambodian')->first();

		 $movie = Category::where('name','movie')->first(); 

		 // return CountryCategory::find(4);

		 $cambodianMovie = CountryCategory::first()->where('countries_id',$cambodian->id)
		 	->where('categories_id', $movie->id)->first();

		// return Video::where('countries_categories_id',$cambodianMovie->id)->get();

		 $users = User::all();
		 
		 echo "<table>";
		 foreach ($users as $user){
		 	echo "<tr>";
		 	echo "<td>$user->id</td> 
		 		 <td>$user->first_name</td> 
		 		 <td>$user->last_name</td> 
		 		 <td>$user->sex</td> 
		 		 <td>$user->DOB</td> 
		 		 <td>$user->e_mail</td> 
		 		 <td>$user->user_name</td>";
		 	echo "</tr>";
		 }	
		 echo "</table>";

		return $view;
	}
}
