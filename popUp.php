<?php

require_once("config.php");
require_once("fixturesInfo.class.php");

$fi = new fixturesInfo();
$fi->setFixtureId($_POST['fixtureid']);
$info = $fi->getFixtureInfo();

require_once("teamHistoryTable.class.php");

$homeTeam = new teamHistoryTable();
$homeTeam->setTeam($info['hometeam']);
$h = $homeTeam->getHomeHistoryTable();
$ht = $homeTeam->getTotalHistoryTable();

$awayTeam = new teamHistoryTable();
$awayTeam->setTeam($info['awayteam']);
$a = $awayTeam->getAwayHistoryTable();
$at = $awayTeam->getTotalHistoryTable();

echo<<<EOHTML
<div class="row">
	<div class="col-xs-12 col-md-6">$h</div>
	<div class="col-xs-12 col-md-6">$a</div>
</div>
<br /><br />
<div class="row">
	<div class="col-xs-12 col-md-6">$ht</div>
	<div class="col-xs-12 col-md-6">$at</div>
</div>
EOHTML;
?>