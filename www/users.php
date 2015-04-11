<?php 
	require_once "./classes/User.php";

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<style> @import url('./styles/main.css'); </style>
</head>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';

		if($user === null) {
			include_once './includes/login.php';
			include_once './includes/create_account.php';
		}


		include_once './general/user_list.php';
		include_once './general/sidebar.php';
		include_once './general/footer.php';
	?>
</body>
</html>