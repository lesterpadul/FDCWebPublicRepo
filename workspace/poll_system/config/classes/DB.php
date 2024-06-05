<?php
class DB
{
	private $host;
	private $username;
	private $password;
	private $dbname;
	public $sql;


	function __construct()
	{
		$this->host = 'db';
		$this->username = 'root';
		$this->password = 'cde3bgt5_root';
		$this->dbname = 'poll';

		// - connect to database
		$this->connectToDB();
	}

	private function connectToDB()
	{
		// - connect to the database
		$this->sql = new mysqli(
			$this->host,
			$this->username,
			$this->password,
			$this->dbname
		);
	}


	 public function insertData($table, $data){
        // Check if the database connection is available
        if ($this->sql) {
            // Construct the query
            $columns = implode(', ', array_keys($data));
            $values = "'" . implode("', '", $data) . "'";
            $query = "INSERT INTO $table ($columns) VALUES ($values)";

            // Execute the query
            if ($this->sql->query($query)) {
                return true; // Insertion successful
            } else {
                return false; // Insertion failed
            }
        } else {
            return false; // Database connection not available
        }
    }

	public function selectData($table, $columns = "*", $where = null){
		// Check if the database connection is available
		if ($this->sql) {
			// Construct the query
			$query = "SELECT $columns FROM $table";
			if ($where) {
				$query .= " WHERE $where";
			}

			// Execute the query
			$result = $this->sql->query($query);
			
		} else {
			return false; // Database connection not available
		}
	}

}

	