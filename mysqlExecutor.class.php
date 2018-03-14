<?php

//mysql class
class mysqlExecutor
{
	//connect to the database
	function db_connect()
	{
		global $SERVERNAME;
		global $USERNAME;
		global $PASSWORD;
		
		return mysqli_connect ($SERVERNAME, $USERNAME, $PASSWORD, $this->select_db());
	}
		
	//get connection error
	function getConnectionError()
	{
		return 'I cannot connect to the database because: ' . mysqli_error();
	}
		
	//select the database
	function select_db()
	{
		global $DATABASE;
		
		return $DATABASE;
	}
		
	//execute the query
	function executeQuery($sql)
	{
		$val = mysqli_query($this->db_connect(), $sql);	
		return $val;	
	}

	//format the results
	function formatResults($result)
	{
		$i=0;
		$ret = array();
	
		while ($row = mysqli_fetch_assoc($result)) {
			$ret[$i]['key'] = $i;
			foreach ($row as $key => $value) {
				$ret[$i][$key] = $value;
			}

			$i++;
		}
		
		return array ( 
			'res' => $ret, 
			'rows' => $i ,
			'insertid' => mysqli_insert_id($this->db_connect()) ,
		);			
	}

	//get the error
	function getError()
	{
		return mysqli_error($this->db_connect());
	}
		
	//prepare the query
	function prepareQuery($sql)
	{
		$connect = $this->db_connect();
		
		if ($connect) { 
			$this->select_db();
		} else { 
			return $this->getConnectionError(); 
		}
		
		$queryresult = $this->executeQuery($sql);
		
		if ($queryresult) {
			$info = $this->formatResults($queryresult); 
		} else { 
			$info['error'] = $this->getError();
		}
	 
		$info['sql'] = $sql;
			
		//return the array
		return $info;
	}
		
	//function to perform an update query	
	function updateQuery($sql)
	{
		$connect = $this->db_connect();
		
		if ($connect) { 
			$this->select_db();                 
		} else { 
			return $this->getConnectionError(); 
		}
		
		$queryresult = $this->executeQuery($sql);
		
		if (!$queryresult) { 
			$info['error'] = $this->getError(); 
		}
		
		$info['sql'] = $sql;
		
		return $info;	
	}
		
	//function to perform an insert query	
	function insertQuery($sql)
	{
		$connect = $this->db_connect();
			
		if ($connect) { 
			$this->select_db();                 
		} else { 
			return $this->getConnectionError(); 
		}
			
		$queryresult = $this->executeQuery($sql);
		
		if (!$queryresult) { 
			$info['error']    = $this->getError(); 
		}
		
		$info['sql'] = $sql;
		$info['insertid'] = mysqli_insert_id($this->db_connect());
		
		return $info;
	}
		
	//function to perform a delete query
	function deleteQuery ( $sql )
	{	
		$connect = $this->db_connect();
			
		if ($connect) { 
			$this->select_db();                 
		} else { 
			return $this->getConnectionError(); 
		}
			
		$queryresult = $this->executeQuery($sql);	
	}
}

?>