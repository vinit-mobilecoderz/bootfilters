var app = angular.module('angularTable', ['angularUtils.directives.dirPagination']);

app.controller('listdata',function($scope, $http){
	$scope.users = []; //declare an empty array
	$scope.loading=true;

	$scope.getData=function()
	{
			$http.get("mockJson/mock.php").success(function(response){ 
		console.log(response,'fadf');
		$scope.users = response;  //ajax request to fetch data into $scope.data
		$scope.loading=false;
	});

	// $http.get("mockJson/mock.json").success(function(response){ 
	// 	$scope.users = response;  //ajax request to fetch data into $scope.data
	// });
	
	$scope.sort = function(keyname){
		$scope.sortKey = keyname;   //set the sortKey to the param passed
		$scope.reverse = !$scope.reverse; //if true make it false and vice versa
	}
	}

});