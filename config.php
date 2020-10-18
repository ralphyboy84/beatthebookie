<?php

$MAINURL = "http://http://www.football-data.co.uk/";

$FIXTURES = $MAINURL."fixtures.csv";

$GAMELIMITER = 5;
$GRGAMELIMITER = 5;
$STARTINGPOINT = 0;

$YEAR = "2021";

//an array containing the csv name for the results
//english leagues...
$pageArray['ENGLAND']['PL'] = "E0";
$pageArray['ENGLAND']['D1'] = "E1";
$pageArray['ENGLAND']['D2'] = "E2";
$pageArray['ENGLAND']['D3'] = "E3";
$pageArray['ENGLAND']['D4'] = "EC";

//scottish leagues...
$pageArray['SCOTLAND']['PL'] = "SC0";
$pageArray['SCOTLAND']['D1'] = "SC1";
$pageArray['SCOTLAND']['D2'] = "SC2";
$pageArray['SCOTLAND']['D3'] = "SC3";

//german leagues
$pageArray['GERMANY']['PL'] = "D1";
$pageArray['GERMANY']['D1'] = "D2";

//italian leagues
$pageArray['ITALY']['PL'] = "I1";
$pageArray['ITALY']['D1'] = "I2";

//spanish leagues
$pageArray['SPAIN']['PL'] = "SP1";
$pageArray['SPAIN']['D1'] = "SP2";

//french leagues
$pageArray['FRANCE']['PL'] = "F1";
$pageArray['FRANCE']['D1'] = "F2";

//dutch leagues
$pageArray['HOLLAND']['PL'] = "N1";

//belgian leagues
$pageArray['BELGIUM']['PL'] = "B1";

//turkish league
$pageArray['TURKEY']['PL'] = "T1";

//greek league
$pageArray['GREECE']['PL'] = "G1";

//portugese league
$pageArray['PORTUGAL']['PL'] = "P1";

$lookUpArray = array(
    'B1' => "Belgian Jupiler League",
    'D1' => "Bundesliga",
    'D2' => "Bundesliga 2",
    'E0' => "EPL",
    "E1" => "Championship",
    "E2" => "League 1",
    "E3" => "League 2",
    "EC" => "Conference",
    "F1" => "Ligue Un",
    "F2" => "Ligue Deux",
    "G1" => "Greek",
    "I1" => "Serie A",
    "I2" => "Serie B",
    "N1" => "Eredivisie",
    "P1" => "Portuguese",
    "SC0" => "SPL",
    "SC1" => "Scottish Championship",
    "SC2" => "Scottish League 1",
    "SC3" => "Scottish League 2",
    "SP1" => "La Liga",
    "SP2" => "La Segunda",
    "T1" => "Turkish",
);

if ($_SERVER['HTTP_HOST'] == "localhost") {
    //dev settings
    $SERVERNAME = "localhost";
    $USERNAME = "root";
    $PASSWORD = "";
    $DATABASE = "btbv2";
} else {
    $SERVERNAME = "localhost";
    $USERNAME = "ralphwar";
    $PASSWORD = "Rdubz1984";
    $DATABASE = "ralphwar_btbv2";
}
