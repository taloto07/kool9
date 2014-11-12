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

		//get recently added videos
		$view->recentyAddedVideos = Video::orderBy("date",'desc')->take(12)->get(); 

		//get most view videos
		$view->mostViewVideos = Video::orderBy('view','desc')->take(12)->get();

		// get the first 12 commedy videos
		$comedyCountryCategories = CountryCategory::where("categories_id", Category::where("name","comedy")->first()->id)->get();

		$comedyVideos = array();
		foreach ($comedyCountryCategories as $ccc){
			$videos = Video::where("countries_categories_id", $ccc->id)->get();

			foreach ($videos as $video) {
				array_push($comedyVideos, $video);
			}
		}

		$first12ComedyVideos = array();
		for ($i = 0; $i < 12; $i++){
			array_push($first12ComedyVideos, $comedyVideos[$i]);
		}

		$view->comdeyVideos = $first12ComedyVideos;

		// /get 12 comedy videos

		// get js script needed for makescrollable
		$scripts = array('makescrollable/jquery-ui-1.10.3.custom.min.js','makescrollable/jquery.kinetic.min.js',
			'makescrollable/jquery.mousewheel.min.js','makescrollable/jquery.smoothdivscroll-1.3-min.js', 'makescrollable/scrollable.js');
		$this->layout->scripts = $scripts;

		// get css needed for makescrollable
		$styles = array('makescrollable/smoothDivScroll.css', 'makescrollable/scrollable.css');
		$this->layout->styles = $styles;

		$this->layout->countries = Country::all();	// get all countries for menu
		$this->layout->content = $view;				// set view for home page
		$this->layout->title = "Home Page";			// set title of the home page
		$this->layout->home = "active";				// set active to home, hi-light the home menu

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

		$this->layout->countries = Country::all();	// get all countries for menu
		$this->layout->content = $view;
		$this->layout->title = "Video";

		return $this->layout;
	}

	/* 
	/ controller for playing video
	/ part number of the video is set to 1 if not provided
	*/
	public function getPlay($videoId, $partNumber = 1){

		$video = Video::find($videoId);

		// handling video not found!!
		if (is_null($video)){

			return "No video found!!!";
		}

		// increment video view by 1
		$video->view++;
		$video->save();

		$view = View::make("play");
		$view->video = $video;
		$view->link = $video->links()->where("video_order", "=", $partNumber)->first();
		$view->partNumber = $partNumber;

		$this->layout->countries = Country::all();	// get all countries for menu
		$this->layout->content = $view;
		$this->layout->title = "Play";				// set title of the video page

		return $this->layout;
	}

}
