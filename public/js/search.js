
(function(){
    var app = angular.module('searchApp', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
    });

    app.controller('SearchController', function(){
        // this.videos = {};

        this.videos = "now it's not hello world";   

        // for (index = 0; index < this.videos.length; index++){
        //     this.videos[index].view = Number(this.videos[index].view);
        // }

        // this.filter = false;

        // this.predicates = [
        //                     {label: 'Name', field: 'name', order: false}, 
        //                     {label: 'Newest', field: "date", order: true},
        //                     {label: 'Oldest', field: "date", order: false},
        //                     {label: 'Most view', field: "view", order: true},
        //                     {label: 'Less view', field: "view", order: false}
        //                   ];
        // this.orderBy = this.predicates[0];

        // this.hidePHP = function(){
        // 	this.filter = true;
        // }

        // // console.log(this.videos);

        // this.hidePHP();
    });
})();
