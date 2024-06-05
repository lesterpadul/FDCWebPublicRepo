<?php
class DB { 
	private $host;
	private $username;
	private $password;
	private $dbname;
	public $sql;


	function __construct () {
		$this->host = 'db';
		$this->username = 'root';
		$this->password = 'cde3bgt5_root';
		$this->dbname = 'fdci';

		// - connect to database
		$this->connectToDB();
	}

	private function connectToDB () {
		// - connect to the database
		$this->sql = new mysqli(
			$this->host,
			$this->username,
			$this->password,
			$this->dbname
		);
	}

	public function getResponse() {
		$data = [];
		$query = "SELECT * FROM news";
		$result = $this->sql->query($query);
	
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$data[] = $row;
			}
		}
	
		return $data;
	}

	//$sql = "SELECT * FROM your_table";


	public function insertData () {
		
	}
}

$db = new DB();
$response = $db->getResponse();