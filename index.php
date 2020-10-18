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
				<div class="col-md-1"></div>
				<div class="col-md-10">
				<span class='mainHead'>BEAT</span><br />
				<span class='subHead'>THE BOOKIE</span><br /><br />
				<!-- <span class='fixtureLabel'>Select Fixtures to Show: <select id='showAllFixtures'><option value='no'>PREDICTED</option><option value='yes'>ALL</option></select></span><br /><br />-->
                    <span class='fixtureLabel'>Select League to Show:
                        <select id='showLeague'>
                            <option value=''>ALL</option>
                            <option value='E0'>EPL</option>
                            <option value='E1'>CHAMPIONSHIP</option>
                            <option value='E2'>LEAGUE 1</option>
                            <option value='E3'>LEAGUE 2</option>
                            <option value='EC'>CONFERENCE</option>
                            <option value='SC0'>SPL</option>
                            <option value='SC1'>SCOTTISH CHAMPIONSHIP</option>
                            <option value='SC2'>SCOTTISH LEAGUE 1</option>
                            <option value='SC3'>SCOTTISH LEAGUE 2</option>
                            <option value='D1'>BUNDESLIGA</option>
                            <option value='D2'>BUNDESLIGA 1</option>
                            <option value='I1'>SERIE A</option>
                            <option value='I2'>SERIA B</option>
                            <option value='SP1'>LA LIGA</option>
                            <option value='SP2'>LA SEGUNDA</option>
                            <option value='F1'>LIGUE UN</option>
                            <option value='F2'>LIGUE DEUX</option>
                            <option value='N1'>EREDIVISIE</option>
                            <option value='B1'>JUPILER</option>
                            <option value='T1'>TURKEY</option>
                            <option value='G1'>GREECE</option>
                            <option value='P1'>PORTUGAL</option>
                        </select>
                    </span><br /><br />

<?php

    if ($_GET['mode']) {
        $option = "selected='selected'";
    }

    echo "
    <span class='fixtureLabel'>Select Mode:
        <select id='showMode'>
            <option value=''>To Win</option>
            <option value='gr' $option>Goals</option>
        </select>
    </span><br /><br />
    ";

    require_once "config.php";
    require_once "fixturesTable.class.php";

    $fixtureList = new fixturesTable();
    $table = $fixtureList->getFixturesTable();
    echo $table;

?>
								</div>
  <div class="col-md-1"></div>

  <div id="dialog" title="Preview Information">
</div>
</div>



	</body>
</html>