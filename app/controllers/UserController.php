<?php
class UserController extends BaseController{
	
	public $layout = "layouts.default";

	public function getCreate(){
		
		$view = View::make("user.create");

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Creat User";

		return $this->layout;
	}

	public function postCreate(){
		$validator = Validator::make(Input::all(),
			array(
				'firstName' => "required | max:50",
				'lastName' => "required | max:50",
				'email' => "required | max:50 | email | unique:users",
				'confirmEmail' => "required | same:email",
				'password' => "required | max:50 | min:6",
				'confirmPassword' => "required | same:password"
			)
		);

		if ($validator->fails()){
			return Redirect::to('/user/create')
					->withErrors($validator)
					->withInput();
		}else{
			$email = Input::get('email');
			$firstName = Input::get('firstName');
			$lastName = Input::get('lastName');
			$password = Input::get('password');

			$user = new User();
			$user->firstname = $firstName;
			$user->lastname = $lastName;
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->save();

			if ($user->id){
				return Redirect::to('/')->with('global', 'Successfully create account.');
			}else{
				return "error";
			}
		}
	}

	public function getSignin(){

		$view = View::make("user.signin");

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Sign In";

		return $this->layout;
	}

	public function postSignin(){
		$validator = Validator::make(Input::all(), array(
			'email' => 'required | max:50 | email',
			'password' => 'required | max:50'
		));

		if ($validator->fails()){
			return Redirect::to("/user/signin")->withErrors($validator)->withInput();
		}else{
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			));

			if ($auth){
				// route to intended page
				return Redirect::intended('/');	
			}else{
				return Redirect::to('/user/signin')
					->with('global', 'Email/password wrong!');
			}
		}

		return Redirect::to('/user/sign')->with('global', 'There was problem with this account!');
	}

	public function getSignout(){
		Auth::logout();

		return Redirect::to('/')->with('global', 'You have Successfully logout!!');
	}

	public function getSecure(){
		return "I'm secure!!!:)";
	}
}












