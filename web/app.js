var myApp = angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

myApp.controller("myController", function ($scope) {
    $scope.users = ['abc', 'def', "ijk"];
});