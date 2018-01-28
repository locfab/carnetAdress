var myApp = angular.module("myApp", [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('[[').endSymbol(']]');

});

var root = 'http://localhost:8888/carnetAdress/web/app_dev.php';




myApp.controller("myController", function ($scope) {
    $.ajax({
        url: root + '/persos',
        method: 'GET'
    }).then(function(data) {
        $scope.users = data;
        //console.log(data)
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
