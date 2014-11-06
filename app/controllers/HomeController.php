<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public $layout = "layouts.default";

	/* 
	/ Home page controller
	*/
	public function index()
	{
		

		$view = View::make('index');
		$view->greeting = "hello";
		$view->name = "Chamnap";

		//get recent added videos
		$view->recentyAddedVideos = Video::orderBy("date",'desc')->take(12)->get(); 

		//get most view videos
		$view->mostViewVideos = Video::orderBy('view','desc')->take(12)->get();

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Home Page";
		$this->layout->home = "active";

		return $this->layout;
	}

	/* 
	/controller for videos in the same country and category
	*/
	public function videos($countryId, $categoryId){
		$countryCategoryId = CountryCategory::where('countries_id',$countryId)->where('categories_id', $categoryId)->first();
		
		if (!isset($countryCategoryId)){
			return "Not Found";
		}

		$videos = Video::where('countries_categories_id', $countryCategoryId->id)->get();

		$view = View::make('video');
		$view->videos = $videos;
		$view->country = Country::find($countryId)->name;
		$view->category = Category::find($categoryId)->name;

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Video";

		return $this->layout;
	}

	/* 
	/ controller for playing video
	*/
	public function getPlay($videoId, $partNumber = 1){

		$video = Video::find($videoId);

		// need handle video not found!!
		if (is_null($video)){
			return "No video found!!!";
		}		


		$view = View::make("play");
		$view->video = $video;
		$view->link = $video->links()->where("video_order", "=", $partNumber)->first();
		$view->partNumber = $partNumber;

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Video";

		return $this->layout;
	}

}
