<?php 
	require_once "./classes/User.php";

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
	<style> @import url('./styles/main.css'); </style>
	<script type="text/javascript" src="./js/AjaxCall.js"></script>
	<script type="text/javascript" src="./js/User.js"></script>
	<script type="text/javascript" src="./js/Validator.js"></script>
	<script type="text/javascript" src="./js/FeedbackManager.js"></script>
</head>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';
		//change username, change email, change password, add/change avatar
		include_once './general/settings/change_username.php';
		include_once './general/settings/change_email.php';
		include_once './general/settings/change_password.php';

		include_once './general/footer.php';
	?>
</body>
</html>