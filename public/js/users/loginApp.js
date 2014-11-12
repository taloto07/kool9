(function(){
	var app = angular.module('loginApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
	});

	app.controller('FormController', function(){
		var myForm = this;
	});
})();
