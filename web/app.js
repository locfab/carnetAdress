var myApp = angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
});

var root = 'https://jsonplaceholder.typicode.com';




myApp.controller("myController", function ($scope) {
    $.ajax({
        url: root + '/users',
        method: 'GET'
    }).then(function(data) {
        $scope.users = data;
    });
});

/*myApp.controller("myController", function ($scope) {
 $scope.users = [{"username":'def', 'age': "2"},{"username":'ijk', 'age': "3"}, {"username":'abc', 'age': "1"}];
 });
*/
angular.module('coursExoApp')
    .factory('serviceAjax', function serviceAjax($http) {
        return{
            popular: function(page){
                return $http.get("http://localhost:3000/popular?page=" + page);
            }
        }
    });
