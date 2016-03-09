<?php

require_once("config.php");
require_once("importFixtures.class.php");


$importFixtures = new importFixtures();
$importFixtures->truncateDB();
$importFixtures->testFunc();


echo "DONE!";

?>