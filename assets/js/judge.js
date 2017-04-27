
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
				console.log(data);
				$scope.scores = data;
				$scope.$apply();
			});
		}

		init();

		var activeTable = 1;
		$scope.active = false;

		$scope.toggle_table = function(clickedJudge){

			// set every other table to active = false
			$scope.scores.forEach(function(judge) {
				judge.active = false;
			})

			clickedJudge.active = true;

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