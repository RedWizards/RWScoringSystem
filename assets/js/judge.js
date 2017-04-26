	var app = angular.module('view', []);

	app.controller('judges-score', function($scope){

		function init() {
			var url = "../database/judge_scores.php";
			$.ajax({
				url: url,
				data:{
					event_id: 1
				}
			}).done(function(data) {
				$scope.scores = data;
				$scope.$apply();
			});
		}

		init();

		var activeTable = 1;
		$scope.active = false;

		$scope.toggle_table = function(table){
			console.log(table);
			console.log(activeTable);
			if(activeTable == table){
				$scope.active = true;
				activeTable = table; 
			}
		}

		// function init(){
		// 	$.ajax({
		// 		url: url,
		// 		method: 'GET'
		// 	}).done(function(data){
		// 		$scope.judges = data;
		// 		$scope.$apply();
		// 	});
		// }

		// init();
	});