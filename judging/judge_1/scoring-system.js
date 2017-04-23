
	var app = angular.module('score-app', []);

	app.controller('score-ctrl', function($scope) {
		
		$scope.hasActive = false;
		$scope.teams = [];

		$.ajax({
	        url : '../../database/initial_data.php',
			type : 'GET',
			data : {
			  	judge_id: 2
			},
			dataType : 'json',
        }).done(function(data) {
         	$scope.teams = data;
        });

		console.log($scope.teams);

		$scope.updateScore = function(team) {
			team.total = 0;
			//console.log(teamcriteria.length);
			for (var i = 0; i < team.criteria.length; i++) {
				team.total += team.criteria[i].score;
			}
		}
		
		$scope.setScore = function(team) {
			team.isActive = true;
			$scope.hasActive = true;
		}
		
		$scope.closeTeam = function(team) {
			team.isActive = false;
			$scope.hasActive = false;
		}
});