<?php 
	require_once "./classes/User.php";

	session_start(); 
	if(isset($_SESSION['user'])) $user = $_SESSION['user'];
	else $user = null;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Friends</title>
	<style> @import url('./styles/main.css'); </style>
</haed>
<body>
	<?php 
		include_once './general/hello_section.php'; 
		include_once './general/nav.php';
		include_once './general/friend_list.php';
		include_once './general/sidebar.php';
		include_once './general/footer.php';
	?>
</body>
</html>