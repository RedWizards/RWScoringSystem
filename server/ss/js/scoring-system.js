
	var app = angular.module('score-app', []);

	app.controller('score-ctrl', function($scope) {
		
		/* INSERT FUNCTION TO CHECK IF THEIR IS A RECORD
		$scope.hasRecord = false;
		
		if(checkRrecord()){
			
		}	
		*/
		
		$scope.hasRecord = false;
		$scope.records = [];
		
		console.log($scope.temp);
		
		var records_url = 'http://localhost/redwizards/ss/api/dummyAPI.php';
		
		
		function init() {
			$.ajax({
				url: records_url
			}).done(function(data) {
				if (data.length > 0)
					$scope.hasRecord = true;
				$scope.records = data;
				$scope.$apply();
			});
		}
		
		
		init();
	});