<?php

class import
{
	const MAINURL = "http://www.football-data.co.uk/";
	
	private $link;
	
	public function getLink()
	{
		return $this->link;
	}
	
	public function setLink($val)
	{
		$this->link = $val;
	}
	
	protected function importLink()
	{	
		if ($this->getLink()) {
			$row = 0;
			if (($handle = fopen($this->getLink(), "r")) !== FALSE) {
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					$num = count($data);
					
					if ($row != 0) {
						for ($c=0; $c < $num; $c++) {
							$formattedArray[$row][$c] = $data[$c];
						}
					}
					
					$row++;
				}
				fclose($handle);
			}
			return $formattedArray;
		}
	}
}

?>