
	var app = angular.module('scoring-sheet', []);

	
	app.controller('sheet-ctrl', function($scope) {
		
		/*
		
		var sheet_url= 'http://localhost/redwizards/ss/api/sheet.php';
		$scope.scoreSheet = [];
		
		function init() {
			$.ajax({
				url: sheet_url
			}).done(function(data) {
				$scope.scoreSheet = data;
				$scope.$apply();
			});
		}
		
		init();		
		
		*/
		
		$scope.activeNow =  false;
		$scope.isActive = false;
	
		$scope.teams = [
			{
				"name": "Harambeats",
				"criteria": [
					{"criteria_id": 1, "name": "Technical Difficulty", "weight": 25, "score": 0, "description": "Includes the technicality of the application"},
					{"criteria_id": 2, "name": "Innovation", "weight": 25, "score": 0, "description": "Inno innov inoova innvat innovation"},
					{"criteria_id": 3, "name": "Business Impact", "weight": 25, "score": 0, "description": "Business impact impact impact impact"},
					{"criteria_id": 4, "name": "Demo", "weight": 25, "score": 0, "description": "Demoooooooooooooooooooooooo"}
				],
				"total": 0,
				"isActive": false
			},
			{
				"name": "Team Mamba",
				"criteria": [
					{"criteria_id": 1, "name": "Technical Difficulty", "weight": 25, "score": 0, "description": "Includes the technicality of the application"},
					{"criteria_id": 2, "name": "Innovation", "weight": 25, "score": 0, "description": "Inno innov inoova innvat innovation"},
					{"criteria_id": 3, "name": "Business Impact", "weight": 25, "score": 0, "description": "Business impact impact impact impact"},
					{"criteria_id": 4, "name": "Demo", "weight": 25, "score": 0, "description": "Demoooooooooooooooooooooooo"}
				],
				"total": 0,
				"isActive": false
			},
			{
				"name": "Team Arandia",
				"criteria": [
					{"criteria_id": 1, "name": "Technical Difficulty", "weight": 25, "score": 0, "description": "Includes the technicality of the application"},
					{"criteria_id": 2, "name": "Innovation", "weight": 25, "score": 0, "description": "Inno innov inoova innvat innovation"},
					{"criteria_id": 3, "name": "Business Impact", "weight": 25, "score": 0, "description": "Business impact impact impact impact"},
					{"criteria_id": 4, "name": "Demo", "weight": 25, "score": 0, "description": "Demoooooooooooooooooooooooo"}
				],
				"total": 0,
				"isActive": false
			}
		];
		
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