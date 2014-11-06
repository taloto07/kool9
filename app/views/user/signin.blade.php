<div class='container'>

	@if(Session::has('global'))
		<p>{{ Session::get('global') }}}</p>
	@endif

	<form action="{{ url('/user/signin') }}" method='post'>
		Email: <input type='text' name='email'/>
		@if($errors->has('email'))
		{{ $errors->first('email') }}
		@endif
		<br/>
		
		Password: <input type='password' name='password'/>
		@if($errors->has('password'))
		{{ $errors->first('password') }}
		@endif
		<br/>
		
		<input type='submit' value='Sign In'>
		{{ Form::token() }}
	</form>
</div>