<?php 
	require_once "./classes/User.php";

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;

	$currentUser = $user;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<style> @import url('./styles/main.css'); </style>
</head>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';

		if($user !== null) {
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