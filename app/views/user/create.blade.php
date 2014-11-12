<div class='container signup-form' ng-app="" ng-controller="personController">
	<div class="jumbotron col-sm-offset-1 col-sm-10">
		<div class='row'>
			<h1 class="col-sm-offset-4 col-sm-8">Sign Up</h1>
		</div>

		@if($errors->has())
			<div class="row" ng-hide='signupForm.$dirty'>
				<div class="alert alert-danger">
					<ul>
						@if($errors->has('firstName'))
							<li>{{$errors->first('firstName')}}</li>
						@endif
						@if($errors->has('lastName'))
							<li>{{ $errors->first('lastName') }}</li>
						@endif
						@if($errors->has('email'))
							<li>{{ $errors->first('email') }}</li>
						@endif
						@if($errors->has('confirmEmail'))
							<li>{{ $errors->first('confirmEmail') }}</li>
						@endif
						@if($errors->has('password'))
							<li>{{ $errors->first('password') }}</li>
						@endif
						@if($errors->has('confirmPassword'))
							<li>{{ $errors->first('confirmPassword') }}</li>
						@endif
					</ul>
				</div>
			</div>
		@endif

		<div class='row' ng-show='signupForm.$dirty && signupForm.$invalid'>
			<div class='alert alert-danger'>
				<ul>
					<li ng-show='signupForm.$dirty && signupForm.firstName.$error.required'>First Name is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.lastName.$error.required'>Last Name is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.email.$error.required'>Email is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.email.$error.email'>Email is invalid!</li>
					<li ng-show='signupForm.$dirty && signupForm.confirmEmail.$error.required'>Confirm Email is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.confirmEmail.$error.email'>Confirm Email is invalid!</li>
					<li ng-show='signupForm.$dirty && signupForm.password.$error.required'>Password is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.password.$error.minlength'>Password is at least 6 characters!</li>
					<li ng-show='signupForm.$dirty && signupForm.confirmPassword.$error.required'>Confirm Password is required!</li>
					<li ng-show='signupForm.$dirty && signupForm.confirmPassword.$error.minlength'>Confirm Password is at least 6 characters!</li>
				</ul>
			</div>
		</div>

		<div class="row">
			<form class="form-horizontal" role="form" method="post" action="{{ url("/user/signup") }}" name='signupForm'>

			  <div class="form-group @if($errors->has() && !$errors->has('firstName')) has-success @endif @if($errors->has('firstName')) has-error @endif has-feedback">
			    <label for="firstName" class="col-sm-2 control-label">First Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="firstName" placeholder="First Name" value='{{ e(Input::old('firstName')) }}' name="firstName"
			      ng-model='firstName' required>
			      @if($errors->has() && !$errors->has('firstName'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('firstName'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('lastName')) has-success @endif @if($errors->has('lastName')) has-error @endif has-feedback">
			    <label for="lastName" class="col-sm-2 control-label">Last Name</label>
			    <div class="col-sm-10">
			      <input type="text" class="form-control" id="inputPassword3" placeholder="Last Name" value='{{ e(Input::old('lastName')) }}' name="lastName"
			      ng-model='lastName' required>
			      @if($errors->has() && !$errors->has('lastName'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('lastName'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('email')) has-success @endif @if($errors->has('email')) has-error @endif has-feedback">
			    <label for="email" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="email" placeholder="Email" value='{{ e(Input::old('email')) }}' name="email"
			      ng-model='email' required>
			      @if($errors->has() && !$errors->has('email'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('email'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('confirmEmail')) has-success @endif @if($errors->has('confirmEmail')) has-error @endif has-feedback">
			    <label for="confirmEmail" class="col-sm-2 control-label">Confirm Email</label>
			    <div class="col-sm-10">
			      <input type="email" class="form-control" id="confirmEmail" placeholder="Confirm Email" value='{{ e(Input::old('confirmEmail')) }}' name="confirmEmail"
			      ng-model='confirmEmail' required>
			      @if($errors->has() && !$errors->has('confirmEmail'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('confirmEmail'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('password')) has-success @endif @if($errors->has('password')) has-error @endif has-feedback">
			    <label for="password" class="col-sm-2 control-label">Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="email" placeholder="Password" name="password"
			      ng-model='password' ng-minlength='6' required>
			      @if($errors->has() && !$errors->has('password'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('password'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group @if($errors->has() && !$errors->has('confirmPassword')) has-success @endif @if($errors->has('confirmPassword')) has-error @endif has-feedback">
			    <label for="confirmPassword" class="col-sm-2 control-label">Confirm Password</label>
			    <div class="col-sm-10">
			      <input type="password" class="form-control" id="confirmPassword" placeholder="confirmPassword" name="confirmPassword"
			      ng-model='confirmPassword' ng-minlength='6' required>
			      @if($errors->has() && !$errors->has('confirmPassword'))
			      	<span class="glyphicon glyphicon-ok form-control-feedback"></span>
			      @endif
			      @if($errors->has('confirmPassword'))
			      	<span class="glyphicon glyphicon-remove form-control-feedback"></span>
			      @endif
			    </div>
			  </div>

			  <div class="form-group">
			    <div class="col-xs-offset-3 col-xs-9 col-sm-offset-2 col-sm-10">
			      <button type="submit" class="btn btn-default" ng-disabled='signupForm.$invalid'>Sign Up</button>
			      <button type="reset" class="btn btn-default">Reset</button>
			    </div>
			  </div>
			  {{ Form::token() }}
			</form>
		</div>
	</div>
	<script>
		function personController($scope) {

			@if(Input::old('firstName'))
				$scope.firstName = "{{ Input::old('firstName') }}";
			@endif

			@if(Input::old('lastName'))
				$scope.lastName = "{{ Input::old('lastName') }}";
			@endif

			@if(Input::old('email'))
				$scope.email = "{{ Input::old('email') }}";
			@endif

			@if(Input::old('confirmEmail'))
				$scope.confirmEmail = "{{ Input::old('confirmEmail') }}";
			@endif

		    $scope.callMe = function() {
		        alert('You just called me!!!');
		    };
		}
	</script>

</div>
