<!DOCTYPE html>
<html>
	<head>
		<title>Scoring System</title>	
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

		<!-- Jquery -->
		<script src="../../assets/js/jquery.min.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
		
		<!-- Tether JS -->
		<script src="../../assets/js/tether.min.js"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->

		<!-- Bootstrap JS -->
		<script src="../../assets/js/bootstrap.min.js"></script>
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

		<!-- Font Awesome -->
		<link rel="stylesheet" href="../../assets/css/font-awesome.min.css">
		<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

		<link rel="stylesheet" href="../../assets/css/scoring-system.css">

		<link rel="stylesheet" href="../../assets/css/style.css">

		<script src="../../assets/js/angular.min.js"></script>

		<script src="./scoring-system.js"></script>	
	  
	</head>

	<body class="container" ng-app="score-app" ng-controller="score-ctrl" ng-init="score = 0">


		<br/><br /><br />
		
		<h1 id="unionbank">Unionbank Ultimate Pitch</h1>

		
		<div ng-repeat="team in teams">
		
			<div class="team row" ng-hide="hasActive">
				<div class="col-md-2">
					<img src="../../assets/images/REDLOGO.png" class="team-logo" />
				</div>
				<div class="col-md-6">
					<h1> {{ team.team_name }} {{team.total}}</h1>
				</div>
				<div class="col-md-4 text-center">
					<button class="btn btn-lg btnSet" ng-click="setScore(team)">Set Score</button>
				</div>
			</div>

			
			<div class="setscore row" ng-show="team.isActive">
				<div class="col-md-12">
					<button class="btn btn-lg" ng-click="closeTeam(team)">x</button>
				</div>
				
				<br /><br /><br /><br />
				
				<div class="col-md-2">
					<img src="../../assets/images/REDLOGO.png" class="team-logo" />
				</div>
				
				<div class="col-md-10">
					<h1>Super App<h1>
					<h3>The best app in existence</h3>
					<br /><br /><br />
				</div>
				
				<hr />
					
				<div class="criteria row" ng-repeat="criteria in team.criteria">
					<div class="criteria-name col-md-offset-2 col-md-4">
						<h1>{{criteria.name}}</h1>
					</div>
					
					<div class="criteria-score col-md-6">
						<input type="number" max="{{criteria.max}}" ng-model="criteria.score" ng-change="updateScore(team)"/>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>