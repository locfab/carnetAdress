var myApp = angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');

});

var root = 'http://localhost:8888/carnetAdress/web/app_dev.php';
//var root = 'https://jsonplaceholder.typicode.com';


myApp.controller("myController", function ($scope) {
    $.ajax({
        url: root + '/persos',
        method: 'GET'
    }).then(function(data) {
        $scope.users = data;
        //console.log(data)
    });
});
