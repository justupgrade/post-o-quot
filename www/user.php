<?php
	//show user profile: posts, friend posts, etc...
	//userID!!!

	require_once "./classes/User.php";
	require_once "classes/DatabaseManager.php";
	require_once "./includes/functions.php";
	require_once "./includes/connection.php";

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;


	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hiddenInputUserId'])) {
		$id = $_POST['hiddenInputUserId'];
		
		if($user->getID() == $id) {
			redirect();
		} else {
			//load profile!
			$currentUser = User::load($conn,$id);
		}
	} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addFriendBtn'])) {
		$id = $_POST['currentUserID'];
		$currentUser = User::load($conn,$id);
		DatabaseManager::getInstance()->addFriend($user->getID(), $currentUser->getID());
	} elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['removeFriendBtn'])) {
		$id = $_POST['currentUserID'];
		$currentUser = User::load($conn,$id);
		DatabaseManager::getInstance()->removeFriend($user->getID(), $currentUser->getID());
	}
	else {
		redirect();
	}

?>

<DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<style> @import url('./styles/main.css'); </style>
	<style> @import url('styles/user.css'); </style>
</head>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';

		if($user !== null) {
			
	if($user->getID() != $currentUser->getID()) {
		echo <<< END
		<form action='messages.php' method='post'>
			<input class='send-msg' type='submit' value='Send Message' name='sendMsgBtn'>
			<input type='hidden' value='{$currentUser->getID()}' name='receiverID'>
		</form>
END;
	}
	if(!alreadyAFriend($conn,$user->getID(),$currentUser->getID()) && $user->getID() != $currentUser->getID()) {
		echo <<< END
		<form action='' method='post'>
			<input class='add-friend' type='submit' value='Add Friend' name='addFriendBtn'>
			<input type='hidden' value='{$currentUser->getID()}' name='currentUserID'>
		</form>
END;
	} elseif(alreadyAFriend($conn,$user->getID(),$currentUser->getID())) {
		echo <<< END
		<form action='' method='post'>
			<input class='remove-friend' type='submit' value='Remove Friend' name='removeFriendBtn'>
			<input type='hidden' value='{$currentUser->getID()}' name='currentUserID'>
		</form>
END;
	}
			//current user...
			include_once './general/user_posts.php';
			include_once './general/friend_posts.php';
			include_once './general/sidebar.php';
		} else {
			echo "<pre>Log in to see full content... <br></pre>";
			include_once './includes/login.php';
			include_once './includes/create_account.php';
		}

		include_once './general/footer.php';
	?>
</body>
</html>

<?php 
	function alreadyAFriend($conn,$uID,$fID) {
		$query = "SELECT * FROM friends WHERE user_id=".$uID; 
		$result = $conn->query($query);

		if(!$result) echo "Error: " . $conn->error();
		else {
			if($result->num_rows > 0) {
				while($row = $result->fetch_array(MYSQLI_ASSOC)){
					if($row['friend_id'] == $fID) return true;
				}
			} else {
				return false;
			}
		}

		return false;
	}

?>