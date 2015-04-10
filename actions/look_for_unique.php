<?php
	require_once "./../classes/DatabaseManager.php";

	if($_SERVER['REQUEST_METHOD'] === 'GET') {
		$query = null;
		if(isset($_GET['username'])) {
			$username = $_GET['username'];
			$query = "SELECT * FROM users WHERE username='" . $username ."'";
			$column = "username";
			$login = $username;
			
		} else if(isset($_GET['email'])){
			$email = $_GET['email'];
			$query = "SELECT * FROM users WHERE email='" . $email . "'";
			$column = "email";
			$login = $email;

		} else echo 'username & email not set';

		if($query !== null) {
			/*
			require_once './../includes/connection.php';
			$result = $conn->query($query);

			if(!$result) {
				echo "Error " . $conn->error;
			} else {
				if($result->num_rows == 0) echo "Success";
				else echo "Error";
			}
			*/

			$result = DatabaseManager::getInstance()->isUnique($login,$column);

			if($result) echo "Success";
			else echo "Error";
		}
	}
?>