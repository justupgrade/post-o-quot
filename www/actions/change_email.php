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

		$email1 = $_POST['newEmailName'];
		$email2 = $_POST['newEmailRepeatName'];

		//USERNAME HAS TO BE VALID! 
		$validator = new InputValidator();
		$validator->checkEmail($email1);

		//validate first email
		if($validator->getStatus()) { //error occurred
			echo $validator->response();
			die();
		}
		//validate second email
		$validator->checkEmail($email2);
		if($validator->getStatus()) { //error occurred
			echo $validator->response();
			die();
		}
		//equal?
		if($email1 !== $email2) {
			echo InputValidator::StaticResponse(array("status"=>"Error", "problemMsg"=>"Emails differ!"));
			die();
		}

		//update username
		$result = DatabaseManager::getInstance()->updateUserEmail($user->getID(),$email1);
		
		if($result >= 0){
			$user->setEmail($email1);
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