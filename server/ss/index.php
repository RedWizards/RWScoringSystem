<!DOCTYPE html>
<html>

<head>

	<title>Scoring System</title>
	
	<!--
	<link rel="icon" href="images/icon.ico" type="image/png" sizes="32x32">
	-->
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/scoring-system.css">
	
	<style>
		<!-- 	INSERT INTERNAL STYLE	-->
	</style>	
  
</head>


<body>

	<header class="container">
		
		<div class="row text-center">
		
			<div class="col-md-3" id="head-name">
				EVENTS
			</div>
			
			<div class="col-md-3">
				<button class="btn btn-default" id="new-event-btn">NEW EVENT</button>
			</div>
			
		</div>
		
	</header>
	
	<section class="container">
	
		<div id="events-record" ng-app="score-app" ng-controller="score-ctrl" ng-init="init()">

			<div id="no-event-record" ng-hide="hasRecord">
				<i>No Events Recorded</i>
			</div>
			
			<div class="align-center" id="event-list" ng-show="hasRecord">
				<!--
				<i>LIST OF EVENT HERE</i>
				
				
				<div ng-repeat="record in records">
					<h1>{{record.name}}</h1>
					<h2>{{record.description}}</h2>
					<h3>{{record.date}}</h3>
				</div>
				-->
				
					<div class="panel panel-default" ng-repeat="record in records">
						  <div class="panel-heading">
							<h4 class="panel-title">
							  <a href="#"><b>{{record.name}}</b><small><i> by {{record.organizer}}</i></small></a>
							  <a data-toggle="collapse" data-parent="#accordion" href="#{{record.event_id}}" title="Event Description"><span class="glyphicon glyphicon-info-sign pull-right"></span></a>
							</h4>
						  </div>
						  <div id="{{record.event_id}}" class="panel-collapse collapse">
							<div class="panel-body">
								<h2>{{record.description}}</h2>
								<h3>{{record.date}}</h3>
							</div>
						  </div>
					</div>
				
			</div>
			
		</div>
		
	</section>

	<footer class="container text-center">
	
		<p><small>Powered by </small><strong>RED Wizard Events Management</strong> &copy; 2017</p>
		
	</footer>
	
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/angular.min.js"></script>
	<script src="js/scoring-system.js"></script>	
	
</body>

</html>