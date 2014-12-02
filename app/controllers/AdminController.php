<?php
class AdminController extends BaseController{
	public $layout = "layouts.default";

	/*
	/ GET upload form for admin 
	*/
	public function getUpload(){

		$allowUser = array("taloto07@gmail.com");

		$view = "";

		if (in_array(Auth::user()->email, $allowUser)){	// allow to use this page
			$view = View::make('admins.upload');
			$view->countries = Country::all();
			$view->categories = Category::all();

			$this->layout->title = "Upload";			// set title of the home page	

			// get in-line script
			$inlineScript = View::make('admins.uploadScript');
			$this->layout->inlineScript = $inlineScript;

		}else{	// restrict from using this page
			$view = View::make("admins.forbidden");

			$this->layout->title = "Forbidden";			// set title of the home page		
		}

		$this->layout->countries = Country::all();	// get all countries for menu
		$this->layout->content = $view;				// set view for home page

		return $this->layout;
	}

	/*
	/ POST upload form for admin 
	*/
	public function postUpload(){
		$title = Input::get('title');
		$parts = Input::get('parts');
		$countryId = Input::get('country');
		$categoryId = Input::get('category');
		
		$youtubVideoIds = array();

		foreach ($parts as $part){
			if ( $part !== ""){
				$url = $part;
				parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
				array_push($youtubVideoIds, $my_array_of_vars['v']);  	
			}
		}
		
		
		
		// get CountryCategory object
		$countryCategory = CountryCategory::where("countries_id", $countryId)->where("categories_id", $categoryId)->first();

		// create CountryCategory object if it doesn't existed
		if (is_null($countryCategory)) {
			$countryCategory = new CountryCategory();
			$countryCategory->image = "";
			$countryCategory->countries_id = $countryId;
			$countryCategory->categories_id = $categoryId;
			$countryCategory->save();	
		}

		$videoImageURL = "http://img.youtube.com/vi/$youtubVideoIds[0]/0.jpg";
		$videoFileName = $youtubVideoIds[0].".jpg";
		$videoImage = "images/links/$videoFileName";
		file_put_contents($videoImage, file_get_contents($videoImageURL));

		// store video to database
		$video = new Video();
		$video->name = $title;
		$video->date = Date("Y-m-d");
		$video->image = $videoImage;
		$video->total_part = count($youtubVideoIds);
		$video->view = 0;
		$video->countries_categories_id = $countryCategory->id;
		$video->save();

		$video_order = 1;
		foreach($youtubVideoIds as $id){
			$videoImageURL = "http://img.youtube.com/vi/$id/0.jpg";
			$videoFileName = "$id.jpg";
			$videoImage = "images/links/$videoFileName";
			file_put_contents($videoImage, file_get_contents($videoImageURL));

			$link = new Link();
			$link->link = $id;
			$link->video_order = $video_order++;
			$link->image = $videoImage;
			$link->view = 0;
			$link->date = date("Y-m-d"); 			
			$link->videos_id = $video->id;
			$link->save();
		}

		return Redirect::to("/admin/upload")->with("global", "Successfully upload videos.");
	}
}