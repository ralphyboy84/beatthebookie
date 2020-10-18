<?php

require_once "import.class.php";
require_once "dateFormat.class.php";
require_once "fixturesDB.class.php";

class importFixtures extends import
{
    const FIXTUREURL = "fixtures.csv";

    public function testFunc()
    {
        $this->setLink(self::MAINURL.self::FIXTUREURL);
        $fixtureArray = $this->importLink();

        if ($fixtureArray) {
            foreach ($fixtureArray as $fix) {
                $dateFormat = new dateFormat();
                $dateFormat->setDate($fix[1]);
                $date = $dateFormat->dateToMysql();

                $insertArray = array(
                    'league' => $fix[0],
                    'date' => $date,
                    'hometeam' => $fix[3],
                    'awayteam' => $fix[4],
                );

                $fixturesDB = new fixturesDB();
                $fixturesDB->insertFixture($insertArray);
            }
        }
    }

    public function truncateDB()
    {
        $fixturesDB = new fixturesDB();
        $fixturesDB->truncateDB();
    }
}
