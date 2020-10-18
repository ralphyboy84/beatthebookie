<?php

//mysql class
class mysqlExecutor
{
    private $_conn;

    //connect to the database
    public function db_connect()
    {
        global $SERVERNAME;
        global $USERNAME;
        global $PASSWORD;

        // If there is no connection, try to connect
        if ($this->_conn === null) {
            $conn = @mysqli_connect($SERVERNAME, $USERNAME, $PASSWORD, $this->select_db());

            if ($conn) {
                $this->_conn = $conn;
            }
        }

        // If there is still no connection, trigger an error
        if ($this->_conn === null) {
            trigger_error(ERROR_DB_CONNECT_FAIL.$USERNAME.'@'.$SERVERNAME.' - database: '.$this->select_db(), E_USER_ERROR);
        }

        return $this->_conn;
    }

    //get connection error
    public function getConnectionError()
    {
        return 'I cannot connect to the database because: '.mysqli_error();
    }

    //select the database
    public function select_db()
    {
        global $DATABASE;

        return $DATABASE;
    }

    //execute the query
    public function executeQuery($sql)
    {
        $val = mysqli_query($this->db_connect(), $sql);
        return $val;
    }

    //format the results
    public function formatResults($result)
    {
        $i = 0;
        $ret = array();

        while ($row = mysqli_fetch_assoc($result)) {
            $ret[$i]['key'] = $i;
            foreach ($row as $key => $value) {
                $ret[$i][$key] = $value;
            }

            $i++;
        }

        return array(
            'res' => $ret,
            'rows' => $i,
            'insertid' => mysqli_insert_id($this->db_connect()),
        );
    }

    //get the error
    public function getError()
    {
        return mysqli_error($this->db_connect());
    }

    //prepare the query
    public function prepareQuery($sql)
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
    public function updateQuery($sql)
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
    public function insertQuery($sql)
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
        $info['insertid'] = mysqli_insert_id($this->db_connect());

        return $info;
    }

    //function to perform a delete query
    public function deleteQuery($sql)
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
