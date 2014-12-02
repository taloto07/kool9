<?
class FacebookController extends BaseController{

	public function getLogin(){
		$facebook = new Facebook(Config::get('facebook'));
		$param = array(
			'redirect_uri' => url('/login/fb/callback'),
			'scope' => 'email'
		);

		return Redirect::to($facebook->getLoginUrl($param));
	}

	public function getLoginCallback(){
		$code = Input::get('code');

		if (strlen($code) == 0){
			return Redirect::to("/")->with("global", "There was an error communicating with Facebook!");
		}

		$facebook = new Facebook(Config::get('facebook'));
		$uid = $facebook->getUser();

		if ($uid == 0){
			return Redirect::to('/')->with("global", "There was an error!");
		}

		$me = $facebook->api('/me');
		
		$profile = Profile::where("uid", $uid)->first();
		if (empty($profile)){
			$user = new User();
			$user->firstname =  $me['first_name'];
			$user->lastname = $me['last_name'];
			$user->email = $me['email'];
			$user->password = Hash::make("facebook");
			$user->photo = "https://graph.facebook.com/$uid/picture?type=large";
			$user->active = 1;

			$user->save();

			$profile = new Profile();
			$profile->uid = $uid;
			$profile = $user->profiles()->save($profile);
		}

		$profile->access_token = $facebook->getAccessToken();
		$profile->save();

		$user = $profile->user()->first();

		Auth::login($user);	
		// need password to authenticate
		// need to logout Auth::logout doesn't logged out facebook user

		

		return Redirect::to('/')->with("global", "You have successfully signed in with Facebook!");
	}
}