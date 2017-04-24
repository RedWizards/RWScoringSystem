<!DOCTYPE html>
<html>
	<head>
		<title>Scoring System</title>
		<!--
		<link rel="icon" href="images/icon.ico" type="image/png" sizes="32x32">
		-->
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

		<!-- <link rel="stylesheet" href="../assets/css/style.css"> -->

		<script src="../../assets/js/angular.min.js"></script>

		<script src="../../assets/js/sheet.js"></script>	
	</head>
	<body class="bgimg">
		<header class="container">
			<div class="row text-center">
				<!-- Name of Event -->
				<div class="row">
					<h4 id="event-name">NAME OF EVENT</h4>
				</div>
			</div>
		</header>
		
		<section class="container" ng-app="scoring-sheet" ng-controller="sheet-ctrl" ng-init="init()">
		
			<div id="events-record">
			
				<div class="text-center" ng-repeat="team in teams"">
					
					<div ng-hide="activeNow" style="padding: 2em;">
						<button class="btn team-btn" ng-click="setScore(team)">
							<div class="row">
								<div class="col-md-3 team-logo">
									<img src="../../assets/images/logo.gif"/>
								</div>
								<div class="col-md-6">
									<h3>{{team.name}}</h3>
								</div>
								<div class="col-md-3 team-score">
									<h1>{{team.total}} %</h1>
								</div>
							</div>
						</button>
					</div>
					
					<div ng-show="team.isActive">
					
						<div class="row">
							
							<div class="col-md-6 text-left">
								<button class="btn btn-nav" ng-click="closeTeam(team)">View All Teams</button>
							</div>
							
							<div class="col-md-6 text-right">
								<button class="btn btn-nav" ng-click="prevTeam(team)">Previous</button>
								<button class="btn btn-nav" ng-click="nextTeam(team)">Next</button>
							</div>
						
						</div>
					
						<div class="row">
						
							<div class="col-md-6 sheet-div">
							
								<div id="team-desc">
								
									<div class="row team-desc">
										<h3>{{team.name}}</h3>
									</div>
									
									<div class="row team-desc">
										<p>TEAM MEMBERS</p>
									</div>
									
									<div class="row team-desc">
										<h4>PROJECT NAME</h4>
									</div>
									
									<div class="row team-desc">
										<p>PROJECT DESCRIPTION</p>
									</div>
								
								</div>
								
							</div>
						
							<div class="col-md-6 sheet-div">
							
								<div class="row team-desc">
									<h3>SCORING SHEET</h3>
								</div>
								
								<!-- Criteria Header -->
								<div class="row">
								
									<div class="col-md-6">
										<h4>CRITERIA</h4>
									</div>
									
									<div class="col-md-2">
									
									</div>
									
									<div class="col-md-4">
										<h4>SCORE</h4>
									</div>
									
								</div>
								
								<hr/>
								
								
								<!-- Criteria and Score -->
								<div class="row" id="criteria" ng-repeat="criteria in team.criteria">
										
										<div class="col-md-1">
											<h5>{{criteria.criteria_id}}</h5>
										</div>
										
										<div class="col-md-7 text-left">
											<h4>{{criteria.name}}</h4>
											<small><i>{{criteria.description}}</i></small>
										</div>
												
										<div class="col-md-4">
											<h4><input type="number" class="text-right" name="criteria-{{criteria.criteria_id}}" style="width: 4em;" ng-model="criteria.score" ng-change="updateScore(team)"/><span> / {{criteria.weight}}</span></h4>
										</div>
										
										<hr>
									
								</div>
								
								<hr/>
								
								<!-- Total Score -->
								<div class="row">
								
									<div class="col-md-6">
										<h4>TOTAL</h4>
									</div>
									
									<div class="col-md-2">
									
									</div>
									
									<div class="col-md-4">
										<h4>{{team.total}} %</h4>
									</div>
									
								</div>
								
								<br/><br/>
								
								<div class="row text-center container">
								
									<div class="col-md-2">
									</div>
								
									<div class="col-md-6">
										<button class="btn btn-lg btn-primary submit-score">SUBMIT</button>
									</div>
									
									<div class="col-md-2">
									</div>
									
								</div>
								
								<br/>
								
							</div>
						
						</div>
					
					</div>
					
				</div>
				<!--
				<div id="done-style" class="text-center">
					<button class="btn btn-primary">DONE</button>
				</div>
				-->
			</div>
			
		</section>

		<footer class="container text-center">
		
			<p><small>Powered by </small><strong>RED Wizard Events Management</strong> &copy; 2017</p>
			
		</footer>
		
	</body>

</html>