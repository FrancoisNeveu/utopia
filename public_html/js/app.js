'use strict';

angular.module('utopia',['utopia.filters','utopia.services','utopia.directives','utopia.controllers']).
config(['$routeProvider', function ($routeProvider) {
	$routeProvider.when('/home', {templateUrl: 'views/home.html', controller: 'HomeCtrl'});
	$routeProvider.otherwise({redirectTo: '/home'});
}]);

