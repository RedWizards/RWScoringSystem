<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Red Wizards - Scoring System</title>
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous"> -->

    <!-- Jquery -->
    <script src="./assets/js/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script> -->
    
    <!-- Tether JS -->
    <script src="./assets/js/tether.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script> -->

    <!-- Bootstrap JS -->
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script> -->

    <!-- Font Awesome -->
    <link rel="stylesheet" href="./assets/css/font-awesome.min.css">
    <!-- <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->

    <!-- Custom CSS -->
    <!-- <link href="./assets/css/hover.css" rel="stylesheet"> -->
    <link href="./assets/css/styles.css" rel="stylesheet">

    <style type="text/css" media="screen">
            
    </style>
</head>
<body>
    <header id="header" class="">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/RWScoringSystem/server/">RED WIZARDS</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li>
                            <a href="#">Rank Board</a>
                        </li>
                        <li>
                            <a href="#">Statistical Board</a>
                        </li>
                        <li>
                            <a href="#">Reset</a>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>
    </header><!-- /header -->

    <div class="container">
        <br/>
        <br/>
        <br/>
        <div class="row">
            <form action="" class="form-control form-group">
                <input type="text" name="eventName" value="" placeholder="Hackathon Name">
                 <input type="text" name="eventName" value="" placeholder="Number of Team Participants">
                <input type="textarea" name="eventDesc" value="" placeholder="Description">
                <input type="submit" name="submit" value="SUBMIT">
            </form>
        </div>
    </div>
    
    <footer>
        <div class="row">
            <div class="col-md-12 col-md-offset-4">
                <p>Copyright &copy; Red Wizards 2017</p>
            </div>
        </div>
    </footer><!-- /footer -->
</body>
</html>