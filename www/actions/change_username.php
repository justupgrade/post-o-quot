<?php
	session_start();

	function __autoload($name) {
		include_once "./../classes/" . $name . ".php";
	}

	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_SESSION['user'])) $user = $_SESSION['user'];
		else {
			echo InputValidator::StaticResponse(array("status"=>"Error", "problemMsg"=>"Unknown error. Try again."));
			die();
		}

		$username = $_POST['new_name'];
		$id = $_POST['id'];

		//USERNAME HAS TO BE VALID! 
		$validator = new InputValidator();
		$validator->checkUsername($username);

		if($validator->getStatus()) { //error occurred
			echo $validator->response();
			die();
		}  
		//update username
		$result = DatabaseManager::getInstance()->updateUserName($id,$username);
		
		if($result >= 0){
			$user->setName($username);
			$_SESSION['user'] = $user;
			echo InputValidator::StaticResponse(array("status"=>"Success"));
		} 
		else{
			echo InputValidator::StaticResponse(array("status"=>"Error", "problemMsg"=>"Unknown error. Try again."));
		} 
	} else {
		echo "Not from post! redirect!";
		die();
	}
?>