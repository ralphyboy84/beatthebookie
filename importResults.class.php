<?php

require_once "import.class.php";
require_once "dateFormat.class.php";
require_once "resultsDB.class.php";

class importResults extends import
{
    const RESULTURL = "mmz4281";

    public $season;

    public function getSeason()
    {
        return $this->season;
    }

    public function setSeason($val)
    {
        $this->season = $val;
    }

    public function testFunc()
    {
        $resultsArray = $this->importLink();

        if ($resultsArray) {
            foreach ($resultsArray as $res) {

                $dateFormat = new dateFormat();
                $dateFormat->setDate($res[1]);
                $date = $dateFormat->dateToMysql();

                $insertArray = array(
                    'league' => $res[0],
                    'date' => $date,
                    'hometeam' => $res[3],
                    'awayteam' => $res[4],
                    'homescore' => $res[5],
                    'awayscore' => $res[6],
                );

                $resultsDB = new resultsDB();
                $resultsDB->insertResult($insertArray, $this->getSeason());
            }
        }
    }
}
