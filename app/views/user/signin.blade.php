<div class='container signin-form' ng-app='loginApp' ng-controller='FormController as form'>

	@if(Session::has('signin'))
		<div class="alert alert-danger">
			{{ Session::get('signin') }}
		</div>
	@endif

	<div class="jumbotron col-sm-offset-1 col-sm-10">
		<div class='row'>
			<h1 class="col-sm-offset-4 col-sm-8">Sign In</h1>
		</div>
		
		@if($errors->has())
			<div class="row" ng-hide='loginForm.$dirty'>
				<div class="alert alert-danger">
					<ul>
						@if($errors->has('email'))
							<li>{{ $errors->first('email') }}</li>
						@endif
						@if($errors->has('password'))
							<li>{{ $errors->first('password') }}</li>
						@endif
					</ul>
				</div>
			</div>
		@endif
		
		<div class='row' ng-show='loginForm.$dirty && loginForm.$invalid'>
			<div class='alert alert-danger'>
				<ul>
					<li ng-show='loginForm.email.$dirty && loginForm.email.$error.required'>Email is required!</li>
					<li ng-show='loginForm.email.$dirty && loginForm.email.$error.email'>Email is invalid!</li>
					<li ng-show='loginForm.password.$dirty && loginForm.password.$error.required'>Password is required!</li>
					<li ng-show='loginForm.password.$dirty && loginForm.password.$error.minlength'>Password is at least 6 character!</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<form class="form-horizontal" role="form" method="post" action="{{ url("/user/signin") }}" name='loginForm'>

			  <div class="form-group @if($errors->has() && !$errors->has('email')) has-success @endif @if($errors->has('email')) has-error @endif has-feedback">
			    <label for="email" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="email" placeholder="Email" value='{{ e(Input::old('email')) }}' name="email" ng-model='form.model.email' required>
			      @if($errors->has() && !$errors->has('email'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('email'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('password')) has-success @endif @if($errors->has('password')) has-error @endif has-feedback">
			    <label for="password" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="email" placeholder="Password" name="password" ng-model='form.model.password' required
			      ng-minlength=6>
			      @if($errors->has() && !$errors->has('password'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('password'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default" ng-disabled='loginForm.$invalid'>Sign in</button>
			      <button type="reset" class="btn btn-default">Reset</button>
			    </div>
			  </div>
			  <div class='col-sm-offset-2 col-sm-12'>
			  	Doesn't have account yet. <a href="{{url("/user/signup")}}">Create one!</a>
			  </div>
			  {{ Form::token() }}
			</form>
		</div>
	</div>
</div>
