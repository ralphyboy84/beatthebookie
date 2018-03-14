<?php

require_once("teamHistory.class.php");

class teamHistoryJSON extends teamHistory
{
	public function getHomeHistoryJSON()
	{	
		return $this->getHomeHistory();
	}
	
	public function getAwayHistoryJSON()
	{		
		return $this->getAwayHistory();
	}
	
	public function getTotalHistoryJSON()
	{	
		return $this->getTotalHistory();
	}
}

?>