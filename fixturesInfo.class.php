<?php

require_once("fixturesDB.class.php");

class fixturesInfo
{
	private $fixtureid;
	
	public function getFixtureId()
	{
		return $this->fixtureid;
	}
	
	public function setFixtureId($val)
	{
		$this->fixtureid = $val;
	}

	public function getFixtureInfo()
	{	
		$args = array (
			'fixtureid' => $this->getFixtureId()
		);
	
		$db = new fixturesDB();
		$res = $db->returnAFixture($args);
		
		return $res['res'][0];
	}
}

?>