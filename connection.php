<?php
class Connection
{
	public function connectionFunction()
	{ 
		$servername = "localhost";
		$username = "root";
		$password = "";
		$databasename="cruddemo";
		$conn = new mysqli($servername, $username, $password ,$databasename); 
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}
}

