
	var app = angular.module('scoring-sheet', []);

	app.controller('sheet-ctrl', function($scope) {
		
		$scope.activeNow =  false;
		$scope.isActive = false;
		
		var sheet_url= '../../database/initial_data.php';
		$scope.scoreSheet = [];
		
		function init() {
			$.ajax({
				url: sheet_url,
				data:{
					judge_id: 1,
					event_id:1
				}
			}).done(function(data) {
				$scope.teams = data;
				$scope.$apply();
			});
		}
		
		init();

		$scope.setScores = function(criterias){
			var sheet_url= '../../database/update_score.php';
			
			for(var i = 0; i < criterias.length; i++){
				$.ajax({
					url: sheet_url,
					data:{
						score_id: criterias[i].score_details.score_id,
						score: criterias[i].score_details.score
					}
				}).done(function(data){
					alert(data);
				});
			}
			
		}		
		
		$scope.updateScore = function(team) {
			team.total = 0;
			for (var i = 0; i < team.criteria.length; i++) {
				team.total += team.criteria[i].score;
			}
		}
		
		$scope.setScore = function(team) {
			team.isActive = true;
			$scope.activeNow = true;
		}
		
		$scope.closeTeam = function(team) {
			team.isActive = false;
			$scope.activeNow = false;
		}
		
	});