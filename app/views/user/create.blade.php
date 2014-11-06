<div class='container'>



	<form action="{{ url('/user/create') }}" method='post'>
		First Name: <input type='text' name='firstName' value='{{ e(Input::old('firstName')) }}' /> 
			@if($errors->has('firstName')) 
				{{ $errors->first('firstName') }}
			@endif
		<br/>
		Last Name: <input type='text' name='lastName' value='{{ e(Input::old('lastName')) }}' />
		@if($errors->has('lastName')) 
			{{ $errors->first('lastName') }}
		@endif
		<br/>
		Email: <input type='text' name='email' value='{{ e(Input::old('email')) }}'/>
		@if($errors->has('email')) 
			{{ $errors->first('email') }}
		@endif
		<br/>
		Confirm Email: <input type='text' name='confirmEmail' value='{{ e(Input::old('confirmEmail')) }}'/>
		@if($errors->has('confirmEmail')) 
			{{ $errors->first('confirmEmail') }}
		@endif
		<br/>
		Password: <input type='password' name='password'/>
		@if($errors->has('password')) 
			{{ $errors->first('password') }}
		@endif
		<br/>
		Confirm Password: <input type='password' name='confirmPassword'/>
		@if($errors->has('confirmPassword')) 
			{{ $errors->first('confirmPassword') }}
		@endif
		<br/>
		<input type='submit' value='Create'>
		{{ Form::token() }}
	</form>
</div>