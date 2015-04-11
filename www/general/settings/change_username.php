<section class='default-style' id='change-username-form'>
	<form action='./actions/change_username.php' method='post'>
		<p><strong>Change Username</strong></p>
		<div class='form-feedback' id='change-username-form-feedback'></div>
		<div class='login-input'>
			<div>New Username:</div>
			<input type='hidden' id='changeUsernameFormUserId' value='<?php echo $user->getID(); ?>'>
			<input type='text' name='newUsernameName' id='newUsernameId' placeholder='<?php echo $user->getUsername(); ?>' required>
			<div class='field-info' id='new-username-info'></div>
		</div>
		<input class='blue-blue-style' type='submit' name='changeUsernameBtnName' id='changeUsernameFormBtn' value='Change'>
	</form>
</section>

<script>
	var feedbackManager = new FeedbackManager('new-username-info', 'change-username-form-feedback');
	var user = new User(document.getElementById('changeUsernameFormUserId').value);

	document.getElementById('changeUsernameFormBtn').addEventListener('click', onChangeUsernameBtnClick);
	document.getElementById('newUsernameId').addEventListener('input', onUsernameInputHandler);

	function onChangeUsernameBtnClick(e) {
		e.preventDefault();
		
		if(user.getName()) {
			new AjaxCall().updateUserName(user, changeUsernameCompleted);
		} else {
			feedbackManager.sendInfo('Invalid name.');
		}
	}

	function changeUsernameCompleted(success, msg) {
		if(success) {
			feedbackManager.sendFeedback('Username changed successfully!');
			document.getElementById('userPreferedNameId').innerHTML = user.getName();
			document.getElementById('newUsernameId').value = "";
			document.getElementById('newUsernameId').placeholder = user.getName();
			user.setName(null);
		} else {
			feedbackManager.sendFeedback(msg);
		}
	}

	function onUsernameInputHandler(e) {
		var str = e.target.value;
		if(new Validator().validateString(str)) {

			if(new AjaxCall().isUniqueUsername(str).value) {
				user.setName(str);
				feedbackManager.sendInfo('Valid name.');
			} else {
				feedbackManager.sendInfo('This name is chosen by someone else.');
				user.setName(null);
			}
		} else {
			feedbackManager.sendInfo('Invalid name.');
			user.setName(null);
		}
		
	}
</script>
