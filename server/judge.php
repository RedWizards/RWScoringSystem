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

	<header class="container">
		
		<div class="row">
		
			<div class="col-md-12 text-center" id="head-name">
					SCORES' SUMMARY
			</div>

		</div>

	</header>

	<div class="container">
	
		<div class="row" id="judge-panel">
		
			<div class="col-md-3">
				<h2 id="choose-judge-text">JUDGES</h2>
				<ul class="nav nav-pills nav-stacked">
				    <li class="active"><a data-toggle="pill" href="#judge1">Tonichi Dela Cruz</a></li>
				    <li><a data-toggle="pill" href="#judge2">Redentor Periabras</a></li>
				    <li><a data-toggle="pill" href="#judge3">Prince Julius</a></li>
				    <li><a data-toggle="pill" href="#judge4">Christian Erick</a></li>
 				 </ul>
			</div>
			
			<div class="col-md-9" id="col"> 
				<div class="tab-content row text-center"  id="content">
						
						<div id="judge1" class="tab-pane fade in active judge-style" style="padding: 0 2em;">
							<p class="judge-name">Tonichi Dela Cruz's Score Sheet</p>
							
							<div id="accordion" >
							
								<div class="panel panel-default">
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a id="" href="#" class="text-left"><b>LAUREL EYE</b><small><i> by LAUREL EYE</i></small></a><span class="pull-right">88 %</span>	 	
										  <a data-toggle="collapse" data-parent="#accordion" href="#laurel-scores" title="Event Description"></a>
										</h4>
									  </div>
									  <div id="laurel-scores" class="panel-collapse collapse in">
										<div class="panel-body">
											<div class="row" style="padding: 0 15em; font-size: 0.5em;">
												
												<div class="col-md-6 text-left">
													<div class="row">
														Scalability and impact
													</div>
													<div class="row">
														Execution and Design
													</div>
													<div class="row">
														Business Model
													</div>
													<div class="row">
														Project Validation
													</div>
												</div>
												
												<div class="col-md-6 text-right">
													<div class="row">
														23 %
													</div>
													<div class="row">
														18 %
													</div>
													<div class="row">
														22 %
													</div>
													<div class="row">
														23 %
													</div>
												</div>
												
											</div>
										</div>
									  </div>
								</div>
								
								<div class="panel panel-default">
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a id="" href="#" class="text-left"><b>CHIBOT</b><small><i> by CHIBOT</i></small></a><span class="pull-right">88 %</span>	 	
										  <a data-toggle="collapse" data-parent="#accordion" href="#laurel-scores" title="Event Description"></a>
										</h4>
									  </div>
									  <div id="laurel-scores" class="panel-collapse collapse">
										<div class="panel-body">
											CRITERIAS
										</div>
									  </div>
								</div>
								
								<div class="panel panel-default">
									  <div class="panel-heading">
										<h4 class="panel-title">
										  <a id="" href="#" class="text-left"><b>HOOLEH</b><small><i> by INTERN</i></small></a><span class="pull-right">91 %</span>	 	
										  <a data-toggle="collapse" data-parent="#accordion" href="#laurel-scores" title="Event Description"></a>
										</h4>
									  </div>
									  <div id="laurel-scores" class="panel-collapse collapse">
										<div class="panel-body">
											CRITERIAS
										</div>
									  </div>
								</div>
								
							</div>
							
						</div>
						
						<div id="judge2" class="tab-pane fade judge-style">
							<p class="judge-name">Redentor Periabras' Score Sheet</p>
							<div class="h4 panel panel-default">
								<div class="panel-body">LAUREL EYE</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">INTERN</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">CHIBOT</div>
							</div>
						</div>
						
						<div id="judge3" class="tab-pane fade judge-style">
							<p class="judge-name">Prince Julius' Score Sheet</p>
							<div class="h4 panel panel-default">
								<div class="panel-body">LAUREL EYE</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">INTERN</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">CHIBOT</div>
							</div>
						</div>
						
						
						<div id="judge4" class="tab-pane fade judge-style">
							<p class="judge-name">Christian Erick' Score Sheet</p>
							<div class="h4 panel panel-default">
								<div class="panel-body">LAUREL EYE</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">INTERN</div>
							</div>
							<div class="h4 panel panel-default">
								<div class="panel-body">CHIBOT</div>
							</div>
						</div>
						
	    		</div>
			</div>
			
		</div>
		
	</div>

</body>

</html>