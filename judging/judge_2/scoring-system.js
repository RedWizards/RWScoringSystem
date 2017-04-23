
	var app = angular.module('score-app', []);

	app.controller('score-ctrl', function($scope) {
		
		$scope.hasActive = false;
		
		var request = $.ajax({
		  url: '../../database/initial_data.php',
		  type: 'GET',
		  data: {
		  	judge_id: 2
		  },
		  dataType: 'json'
		});

		request.done(function(data) {
			$scope.teams = JSON.stringify(data, null, 4);
			console.log($scope.teams);
		});

		request.fail(function(jqXHR, textStatus) {
		   alert( "Request failed: " + textStatus );
		});

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