	var app = angular.module('score-app', []);

	app.controller('score-ctrl', function($scope, $http) {
		
		$scope.hasActive = false;

		$scope.teams = function(){
        	return $http({
	            method: 'GET',
	            data: {"judge_id": 2},
	            url: '../../database/initial_data.php'
	        });
	    };

	    $scope.$apply();

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