<?php

/**
 * @title 	MySQL Utility
 * @author	Steve Shaddick
 * @version 2.0
 *
 * @description 	A class for interfacing MySQL with PHP
					
 * @tags database, mysql, security, utility 
 *
 *
 */
 
class MySQLUtility {
	
	public $error = '';
	public $dbIP = '';
	public $dbUsername = '';
	public $dbPassword = '';
	public $dbName = '';
	public $lastQuery = '';
	
	public $sqlConn = '';
	public $isConnected = false;
	
	
	/**********************
	 * @function	constructor
	 * @input	$dbUsername (string) : mySQL username
				$dbPassword (string) : mySQL password
				$dbIP (string) : mySQL location
				$dbName (string) : mySQL database name
				
	 */
	public function __construct($dbUsername, $dbPassword, $dbIP, $dbName)
	{
		$this->dbUsername = $dbUsername;
		$this->dbPassword = $dbPassword;
		$this->dbIP = $dbIP;
		$this->dbName = $dbName;
		
		$this->sqlConn = mysql_connect($this->dbIP, $this->dbUsername, $this->dbPassword);
		$this->isConnected = mysql_select_db ($this->dbName, $this->sqlConn);
	}
	
	/**********************
	 * @function	openConnection
	 * @input	$dbUsername (string) : mySQL username
				$dbPassword (string) : mySQL password
				$dbIP (string) : mySQL location
				$dbName (string) : mySQL database name
				
	 * @output	true on success, or false if not.
	 */
	public function openConnection($dbUsername, $dbPassword, $dbIP, $dbName)
	{
		$this->closeConnection();
		
		$this->dbUsername = $dbUsername;
		$this->dbPassword = $dbPassword;
		$this->dbIP = $dbIP;
		$this->dbName = $dbName;
		
		$this->sqlConn = mysql_connect($this->dbIP, $this->dbUsername, $this->dbPassword);
		$this->isConnected = mysql_select_db ($this->dbName, $this->sqlConn);
	}
	
	/**********************
	 * @function	getSingleRow
	 * @input	$query (string) : the mysql query
				
	 * @output	Returns a single row from the query
	 */
	public function getSingleRow($query) {
		
		$query .= " LIMIT 1";
		
		if ($this->initQuery($query) !== true) {
			return false;
		}
		
		$result = mysql_query($query, $this->sqlConn);
			
		$ret = array();
		if (($result === false) || ($result === true)){
			$ret = $result;
		} else {
			$ret = mysql_fetch_assoc($result);
			if (count($ret) === 0){
				$ret = false;
			}
		}
		
		return $ret;
	}
	
	/**********************
	 * @function	getSingleField
	 * @input	$field (string) : 
	 * @input	$table (string) : 
	 * @input	$where (string) : 
	 * @input	$orderby (string) : 
				
	 * @output	Returns a single field from the query
	 */
	public function getSingleField($field, $table, $where = '', $orderby = '') {
		
		$query = "SELECT $field FROM $table";
		if ($where != '') {
			$query .= " WHERE $where";	
		}
		if ($orderby != '') {
			$query .= " ORDER BY $orderby";
		}
		$query .= " LIMIT 1";
		
		if ($this->initQuery($query) !== true) {
			return false;
		}
		
		$result = mysql_query($query, $this->sqlConn);
			
		$ret = array();
		if (($result === false) || ($result === true)){
			$ret = $result;
		} else {
			$ret = mysql_fetch_assoc($result);
			if (count($ret) === 0){
				$ret = false;
			} else {
				$ret = $ret[$field];
			}
		}
		
		return $ret;
	}
	
	/**********************
	 * @function	sendQuery
	 * @input	$query (string) : the mysql query
				
	 * @output	Returns an array of rows and column names 
	 			or false if something fails 
				or true if the query returns === true
	 */
	public function sendQuery($query)
	{
		if ($this->initQuery($query) !== true) {
			return false;
		}
		
		//good to send the query
		$result = mysql_query($query, $this->sqlConn);
		
		$ret = array();
		if (($result === false) || ($result === true)){
			$ret = $result;
		} else {
			while($row = mysql_fetch_assoc($result))
			{
				//build the return array.  An empty result will return an array of count 0
				
				$ret[] = $row;
			}
		}
		
		return $ret;
	}
	
	/**********************
	 * @function	getInsertID
	 * @input	nothing
	 
	 * @output	returns the id of the last query
	 			or false if not connected
	 */
	public function getInsertID()
	{
		if (!$this->isConnected) {
			return false;
		} else {
			return mysql_insert_id($this->sqlConn);
		}
	}
	
	/**********************
	 * @function	insertRow
	 * @input	$query (string) : the mysql query, must be an INSERT statement
				
	 * @output	Returns the newly inserted id
	 * 			or false on error
	 */
	public function insertRow($query)
	{
		if (strpos(strtolower($query), 'insert') !== 0)	{
			return false;
		}
		
		if ($this->initQuery($query) !== true) {
			return false;
		}
		
		//good to send the query
		$result = mysql_query($query, $this->sqlConn);
		
		if ($result === false){
			$ret = $result;
		} else {
			$ret = mysql_insert_id($this->sqlConn);
		}
		
		return $ret;
	}
	
	/**********************
	 * @function	insertRows
	 * @input	$table (String) : the table in which to insert
	 * @input	$rows (array object) : the assoc array(row) to insert, or an array of assoc arrays(rows) to insert
	 * @input	$escape (boolean) : whether or not to escape the values
				
	 * @output	Returns the latest inserted id
	 * 			or false on error
	 */
	public function insertRows($rows, $table, $escape = true)
	{
		$isMultiple = false;	
		if (isset($rows[0])) {
			if (gettype($rows[0]) == 'array') {
				$isMultiple = true;
			}
		}
		
		if ($isMultiple) {
			
			$fields = array();
			foreach($rows[0] as $key=>$value) {
				$fields []= "`".$key."`";
			}
			
			$values = array();
			foreach($rows as $row) {
				$valueSet = array();
				foreach($row as $value) {
					if ($escape) {
						$valueSet []= "'".sprintf("%s", mysql_real_escape_string($value))."'";
					} else {
						$valueSet []= "'".$value."'";
					}
				}
				$values []= "(".implode(',', $valueSet).")";
			}
			
			$query = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES " . implode(',', $values);
			
		} else {
			
			$fields = array();
			$values = array();
			foreach($rows as $key=>$value) {
				$fields []= "`".$key."`";
				if ($escape) {
					$values []= "'".sprintf("%s", mysql_real_escape_string($value))."'";
				} else {
					$values []= "'".$value."'";
				}
				$query = "INSERT INTO $table (" . implode(',', $fields) . ") VALUES (" . implode(',', $values) . ")";
			}
		}

		if ($this->initQuery($query) !== true) {
			return false;
		}
		
		//good to send the query
		$result = mysql_query($query, $this->sqlConn);
		
		if ($result === false){
			$ret = $result;
		} else {
			$ret = mysql_insert_id($this->sqlConn);
		}
		
		return $ret;
	}
	
	/**********************
	 * @function	cleanMySQL
	 * @input	$value (string) : the string to clean
				
	 * @output	A cleaned string ready to include in a SQL query, 
	 			or false if not connected
	 */
	public function cleanString($value)
	{
		if (!$this->isConnected) {
			trigger_error("MySQLUtility is not connected.", E_USER_ERROR);
			return false;
		} else {
			return sprintf("%s", mysql_real_escape_string($value));
		}
	}
	
	/**********************
	 * @function	closeConnection
	 * @input	nothing			
	 
	 * @output	Closes the mySQL connection if open
	 */
	public function closeConnection()
	{
		if ($this->sqlConn != '') {
			mysql_close($this->sqlConn);
			$this->sqlConn = '';
			$this->isConnected = false;
		}
	}
	
	public function __destruct()
	{
		if ($this->sqlConn != '') {
			mysql_close($this->sqlConn);
			$this->sqlConn = '';
			$this->isConnected = false;
		}
	}
	
	private function initQuery($query) {
		$this->lastQuery = $query;
		
		if (!$this->isConnected) {
			$ret = false;
			trigger_error("MySQLUtility is not connected.", E_USER_ERROR);
		} else {
			$ret = true;
		}
		
		return $ret;
	}


}

?>