<?php 
	require_once "./classes/User.php";
	require_once "./classes/Message.php";
	require_once "./includes/connection.php";
	
	Message::SetUpConnection($conn);

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;
	
	$receiver_email = "";
	if($_SERVER['REQUEST_METHOD'] === 'POST') {
		if(isset($_POST['sendMsgBtn'])) { //get user data from post request
			$id = $_POST['receiverID'];
			$receiver = User::load($conn, $id);
			$receiver_email = $receiver->getEmail();
			$_SESSION['receiver'] = $receiver;
		} elseif(isset($_POST['sendMessage'])) { //form submited
			if(isset($_SESSION['receiver'])) {
				$content = $_POST['content'];
				$title = $_POST['titleText'];
				$receiver = $_SESSION['receiver'];
				$feedback = Message::SendMessage($user,$receiver,$title,$content);
				unset($_SESSION['receiver']);
			}
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Messages</title>
	<style> @import url('./styles/main.css'); </style>
	<style> @import url('styles/user.css'); </style>
</head>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';
		include_once './general/msg_box.php';
		include_once './general/sidebar.php';
		include_once './general/footer.php';
	?>
</body>
</html>