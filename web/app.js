var myApp = angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

myApp.controller("myController", function ($scope) {
    $scope.users = [{"username":'def', 'age': "2"},{"username":'ijk', 'age': "3"}, {"username":'abc', 'age': "1"}];
});

/*myApp.controller('myController', function($scope, $http) {
    $http.get("http://localhost:8888/carnetAdress/web/app_dev.php/search")
        .then(function(response) {
            $scope.users = response.data.records;
        });
});*/