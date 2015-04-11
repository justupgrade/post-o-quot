<nav>
	<div class='nav-style orange-white-style'>Home</div>
	<div class='nav-style orange-white-style'>Users</div>
	<?php 
		if($user !== null) {
			echo "<div class='nav-style orange-white-style'>Messages</div>";
			echo "<div class='nav-style orange-white-style'>Friends</div>";
			echo "<div class='nav-style orange-white-style'>Settings</div>";
		} else {
			echo "<div id='create-account-id' class='nav-style green-green-style'>Create Account</div>";
		}
	?>
	
</nav>

<script src='./js/nav.js'></script>