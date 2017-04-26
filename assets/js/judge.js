	var app = angular.module('view', []);

	app.controller('judges-score', function($scope){

		var url = "../../database/judge_scores.php";

		$scope.judges = [
			{
				"judge_id" : 1,
				"judge_name" : "Christian Cimbracruz",
				"teams" :
					[
						{
							"team_id" : 1,
							"team_name" : "Laurel Eye",
							"total": 100,
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 2,
							"team_name" : "Chibot",
							"total": 100,
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 3,
							"team_name" : "Intern",
							"total": 100,
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						}
					]
			},
			{
				"judge_id" : 2,
				"judge_name" : "Chen Dela Cruz",
				"teams" :
					[
						{
							"team_id" : 1,
							"team_name" : "Laurel Eye",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 2,
							"team_name" : "Chibot",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 3,
							"team_name" : "Intern",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						}
					]
			},
			{
				"judge_id" : 3,
				"judge_name" : "Prince Hari",
				"teams" :
					[
						{
							"team_id" : 1,
							"team_name" : "Laurel Eye",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 2,
							"team_name" : "Chibot",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 3,
							"team_name" : "Intern",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						}
					]
			},
			{
				"judge_id" : 4,
				"judge_name" : "Red Periabras",
				"teams" :
					[
						{
							"team_id" : 1,
							"team_name" : "Laurel Eye",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 2,
							"team_name" : "Chibot",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						},
						{
							"team_id" : 3,
							"team_name" : "Intern",
							"criteria" :
								[
									{
										"criteria_id": 1,
										"criteria_name" : "Scalability and Impact",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 2,
										"criteria_name" : "Excution and Design",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Business Model",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									},
									{
										"criteria_id": 1,
										"criteria_name" : "Project Validation",
										"score": {
											"score_id" : 1,
											"score" : 25
										}
									}
								]
							
						}
					]
			}
		];

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