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
		$this->dbname = 'online_exam_db';

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

	public function insertData () {
		
	}
}

$conn = mysqli_connect("db", "root", "cde3bgt5_root", "online_exam_db");

// Check if connection was successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
