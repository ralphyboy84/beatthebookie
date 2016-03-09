<?php

class dateFormat
{
	private $date;
	
	public function setDate($val)
	{
		$this->date = $val;
	}
	
	public function getDate()
	{
		return $this->date;
	}
	
	public function dateToMysql()
	{	
		$date = explode("/", $this->getDate());
		return $date[2].'-'.$date[1].'-'.$date[0];
	}
	
	public function mysqlToDate()
	{	
		$date = explode("-", $this->getDate());
		return $date[2].'/'.$date[1].'/'.$date[0];
	}
}

?>