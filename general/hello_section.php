<section id='hello-cont' class='default-style'>
	<div class='left-cont'> 
		<span>Hello 
			<?php if($user !== null) echo "<strong class='special-chars'>". $user->getPreferedName() ."</strong>"; ?>
		</span><br>
		<span id='random-quote'>Random Quote</span>
	</div>
	<?php 
		if($user!==null) {
			echo "<div id='logoutDiv' class='right-cont blue-blue-style'>";
			echo "Logout";
			echo "</div>";
		} else {
			echo "<div id='loginDiv' class='right-cont blue-blue-style'>";
			echo "Login";
			echo "</div>";
		}
	?>
</section>

<script>
	var loginBtn = document.getElementById('loginDiv');
	if(loginBtn) loginBtn.addEventListener('click', onLoginBtnClick);

	var logoutBtnEl = document.getElementById('logoutDiv');
	if(logoutBtnEl) logoutBtnEl.addEventListener('click', onLogoutClick);

	function onLoginBtnClick(e) {
		var loginForm = document.getElementById('login-form');
		loginForm.style.display = 'block';
	}

	function onLogoutClick(e) {
		window.location.href = "http://localhost/git/post-o-quot/includes/logout.php";
	}
</script>