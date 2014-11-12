(function(){
	var app = angular.module('signupApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
	});



	app.controller('FormController', function(){
		var myForm = this;
		myForm.user = {};

		myForm.callMe = function(){
			alert('You just called me!!!');
		}
	});

})();
