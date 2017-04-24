<!DOCTYPE html>
<html>
<head>
	<title>Judge Score Sheet</title>
		<!--
		<link rel="icon" href="images/icon.ico" type="image/png" sizes="32x32">
		-->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Bootstrap -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

		<!-- Jquery -->
		<script src="../assets/js/jquery.min.js"></script>
		<!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
		
		<!-- Tether JS -->
		<script src="../assets/js/tether.min.js"></script>
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->

		<!-- Bootstrap JS -->
		<script src="../assets/js/bootstrap.min.js"></script>
		<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

		<!-- Font Awesome -->
		<link rel="stylesheet" href="../assets/css/font-awesome.min.css">
		<!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

		<link rel="stylesheet" href="../assets/css/judge.css">

		

		<script src="../assets/js/angular.min.js"></script>
	
</head>

<body>

	<header class="container-fluid">
		
		<div class="row">
		
			<div class="col-md-12 text-center" id="head-name">
				JUDGES
			</div>

		</div>

	</header>

	<div class="container-fluid" id="section">
		<div class="row" id="judge-panel">
			<div class="col-md-3">
				<h2 id="choose-judge-text">CHOOSE A JUDGE:</h2>
				<ul class="nav nav-pills nav-stacked" id="">
				    <li class="active"><a data-toggle="pill" href="#judge1">Judge 1</a></li>
				    <li><a data-toggle="pill" href="#judge2">Judge 2</a></li>
				    <li><a data-toggle="pill" href="#judge3">Judge 3</a></li>
	    			<li><a data-toggle="pill" href="#judge4">Judge 4</a></li>
 				 </ul>
			</div>
			<div class="col-md-9" id="col"> 
				<div class="tab-content row text-center"  id="content">
	    			<div id="judge1" class="tab-pane fade in active judge-style">
	      				<p class="judge-name">JUDGE REDENTOR</p>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	    			</div>
	    			<div id="judge2" class="tab-pane fade judge-style">
	      				<p class="judge-name">JUDGE ARIEL</p>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	    			</div>
	    			<div id="judge3" class="tab-pane fade judge-style">
	      				<p class="judge-name">JUDGE TIAN</p>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	    			</div>
	    			<div id="judge4" class="tab-pane fade judge-style">
	      				<p class="judge-name">JUDGE PRINCE</p>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	      				<div class="h2 panel panel-default">
	      				<div class="panel-body">Team RED</div>
	      				</div>
	    			</div>
	    			</div>
	    		</div>
			</div>
		</div>
		
	</div>

</body>

</html>