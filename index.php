<!DOCTYPE html>
<html>
	<head>
		<title>Beat the Bookie! v2.0</title>

		<meta name="viewport" content="width=device-width, initial-scale=1">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">

		<link rel="stylesheet" href="styles.css">
		<script src="js.js"></script>
	</head>
	
	<body>
		<div class="wrapper">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<span class='mainHead'>BEAT</span><br />
				<span class='subHead'>THE BOOKIE</span><br /><br />
				<span class='fixtureLabel'>Select Fixtures to Show: <select id='showAllFixtures'><option value='no'>PREDICTED</option><option value='yes'>ALL</option></select></span><br /><br />
<?php

require_once("config.php");
require_once ("fixturesTable.class.php");

$fixtureList = new fixturesTable();
$table = $fixtureList->getFixturesTable();
echo $table;
?>
								</div>
  <div class="col-md-2"></div>
  
  <div id="dialog" title="Preview Information">
</div>
</div>



	</body>
</html>