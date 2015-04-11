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

		$pass1 = $_POST['new-password-name'];
		$pass2 = $_POST['new-password-repeat-name'];
		$oldPass = $_POST['old-password-name'];

		$validator = new InputValidator();
		if(!$validator->checkPasswords($pass1, $pass2)){
			echo $validator->response();
			die();
		} else {
			$valid = DatabaseManager::getInstance()->isValidPassword($user->getID(),$oldPass);
			if($valid){
				//try to change passwords:
				if(DatabaseManager::getInstance()->changePassword($user->getID(), $pass1)) {
					echo InputValidator::StaticResponse(array("status"=>"Success"));
					die();
				} else {
					echo InputValidator::StaticResponse(array("status"=>"Error", "problemMsg"=>"Password update failed."));
					die();
				}

			} else {
				echo InputValidator::StaticResponse(array("status"=>"Error", "problemMsg"=>"Old password is invalid!"));
				die();
			}
		}


	} else {
		//redirect...
	}
?>