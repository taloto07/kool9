<?php
class UserController extends BaseController{
	
	public $layout = "layouts.default";

	/*
	/ Sign Up form request with GET
	*/
	public function getSignup(){
		// initialize view
		$this->layout->countries = Country::all();
		$this->layout->title = "Creat User";

		// get content
		$view = View::make("user.create");
		$this->layout->content = $view;

		// add style
		$styles = array('css/angular_validation.css');
		$this->layout->styles = $styles;

		return $this->layout;
	}

	/*
	/ Sign Up form request with POST
	/ Validate form and put user information if valid
	/ If not valid send sign up form back
	*/
	public function postSignup(){
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
			return Redirect::to('/user/signup')
					->withErrors($validator)
					->withInput();
		}else{
			$email = Input::get('email');
			$firstName = Input::get('firstName');
			$lastName = Input::get('lastName');
			$password = Input::get('password');
			$activationCode = str_random(60);

			$user = new User();
			$user->firstname = $firstName;
			$user->lastname = $lastName;
			$user->email = $email;
			$user->password = Hash::make($password);
			$user->activation_code = $activationCode;
			$user->save();

			// check if user successfully insert into database
			if ($user->id){
				// send email to user with a link to active their account
				$variable = array('firstName' => $firstName, 'lastName' => $lastName, 'link' => url('/user/activate/'.$activationCode));
				Mail::queue('emails.auth.emailTemplate', $variable, function($message) use ($user){
					$message->to($user->email, $user->firstname ." ". $user->lastname)
					->subject('Account Activation');
				});

				// send email to admin to alert user sign up with website
				Mail::later(5, 'emails.auth.emailAdmin', array('firstname'=>$firstName, 'lastname'=>$lastName), function($message){
					$message->to('info@kool9.com', 'kool9')
					->subject('Sign Up User');
				});

				return Redirect::intended('/')->with('global', 'Successfully create account. Please check your email to active your account!');
			}else{
				return Redirect::to('/')->with('global', 'Something wrong with Server. Please try again later!');
			}
		}
	}

	/*
	/ GET request
	/ Activate user account with activation code
	*/
	public function getActivate($activationCode){

		$user = User::where('activation_code', '=', $activationCode)->where('active', '=', '0');

		if ($user->count()){
			$user = $user->first();

			// update user activation code and active = 1
			$user->active = 1;
			$user->activation_code = '';

			if ($user->save()){
				return Redirect::to('/')->with('global', 'Congratulation, your account is activated!');
			}

			return Redirect::to('/')->with('global', 'We could not activate your account. Please try again later!');
		}

		return Redirect::to('/')->with('global', 'We could not activate your account. Please try again later!');
	}

	/*
	/ Sign in form request with GET
	*/
	public function getSignin(){

		$view = View::make("user.signin");

		$this->layout->countries = Country::all();
		$this->layout->content = $view;
		$this->layout->title = "Sign In";

		// add script
		$scripts = array("users/loginApp.js");
		$this->layout->scripts = $scripts;

		return $this->layout;
	}

	/*
	/ Sign in form request with POST
	/ Validate form and put user information if valid
	/ If not valid send sign up form back
	*/
	public function postSignin(){
		$validator = Validator::make(Input::all(), array(
			'email' => 'required | max:50 | email',
			'password' => 'required | max:50 | min:6'
		));

		// form is not valid
		if ($validator->fails()){
			return Redirect::to("/user/signin")->withErrors($validator)->withInput();
		}

		// check for activation
		$user = User::where('email', Input::get('email'));
		if ($user->count() && $user->first()->active == 0){
			return Redirect::to('/user/signin')
				->with('signin', 'Account hasn\'t activated! Check your email to activate.');
		}

		$auth = Auth::attempt(array(
			'email' => Input::get('email'),
			'password' => Input::get('password'),
			'active' => '1'
		));

		if ($auth){	// authenticated
			// route to intended page
			return Redirect::intended('/');
		}else{
			return Redirect::to('/user/signin')
				->with('signin', 'Email/password wrong!');
		}

		return Redirect::to('/user/sign')->with('global', 'There was problem with this account!');
	}

	/*
	/ Sign out user form system and redirect back home page with message
	*/
	public function getSignout(){
		// logout from our own system
		Auth::logout();

		// logout from facebook
		$facebook = new Facebook(Config::get('facebook'));
		$param = array('next' => url("/"));
		$logout = $facebook->getLogoutUrl($param);

		return Redirect::to($logout)->with('global', "You have successfully logged out!");
	}

	public function getSecure(){
		return "I'm secure!!!:)";
	}

	public function getTest(){

		// Mail::send('emails.auth.test', array('name' => 'alex', 'link' => 'kool9.com/user/activate'), function($message){
		// 	$message->to('chamnaplim18@yahoo.com', 'Chamnap Lim')
		// 			->subject('Test Laravel Mail Service');
		// });

		$user = User::where('email','chamnaplim18@yahoo.com');

		if ($user->count())
			return $user->first();
		else
			return "No user found!";
	}
}












