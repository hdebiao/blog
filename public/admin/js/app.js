"use strict";
var adminApp = angular.module('adminApp', [
    'ngRoute',
    'adminControllers',
    'pagination'
]);
adminApp.config(['$routeProvider',function ($routeProvider) {
    var temPath = '/admin/html/';
    $routeProvider.
        when('/', {controller: 'home', templateUrl: temPath + 'home.html'}).
        when('/post', {controller: 'post', templateUrl: temPath + 'post.html'}).
        when('/post-add', {controller: 'post-add', templateUrl: temPath + 'post-add.html'});
    }])
.run(function ($rootScope) {
    $rootScope.adminConfig = {

    }
});