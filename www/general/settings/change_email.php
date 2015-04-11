<section class='default-style change-form' id='change-email-form'>
	<form action='./actions/change_email.php' method='post'>
		<p><strong>Change Email</strong></p>
		<div class='form-feedback' id='change-email-form-feedback'></div>
		<div class='login-input'>
			<div>New Email:</div>
			<input type='text' name='newEmailName' id='newEmailID' placeholder='<?php echo $user->getEmail(); ?>' required>
			<div class='field-info' id='new-email-info'></div>
		</div>
		<div class='login-input'>
			<div>Repeat New Email</div>
			<input type='text' name='newEmailRepeatName' id='newEmailRepeatId' placeholder='<?php echo $user->getEmail(); ?>' required>
			<div class='field-info' id='new-email-repeat-info'></div>
		</div>
		<input class='blue-blue-style input-button' type='submit' name='changeEmailBtnName' id='changeEmailBtnId' value='Change'>
	</form>
</section>

<script type="text/javascript">
	var changeEmailFeedbackManager = new FeedbackManager('new-email-info','change-email-form-feedback');
	var newEmail = null;
	var newEmailRepeat = null;

	document.getElementById('changeEmailBtnId').addEventListener('click', onChangeEmailBtn);
	document.getElementById('newEmailID').addEventListener('input', onNewEmailInput);
	document.getElementById('newEmailRepeatId').addEventListener('input', onNewEmailRepeatInput);

	function onChangeEmailBtn(e){
		e.preventDefault();

		if(newEmail === true && newEmailRepeat === true) {
			new AjaxCall().updateUserEmail(document.getElementById('newEmailID').value, document.getElementById('newEmailRepeatId').value, changeEmailCompleted);
		} else {
			changeEmailFeedbackManager.sendFeedback('Invalid input.');
		}

	}

	function changeEmailCompleted(success, msg) {
		if(success) {
			changeEmailFeedbackManager.sendFeedback('Email changed successfully!');
			document.getElementById('newEmailID').placeholder = document.getElementById('newEmailID').value;
			document.getElementById('newEmailID').value = "";
			document.getElementById('newEmailRepeatId').placeholder = document.getElementById('newEmailRepeatId').value;
			document.getElementById('newEmailRepeatId').value = "";
		} else {
			changeEmailFeedbackManager.sendFeedback(msg);
		}

		newEmail = null;
		newEmailRepeat = null;
		changeEmailFeedbackManager.sendInfo('', 'new-email-repeat-info');
		changeEmailFeedbackManager.sendInfo('');
	}

	function onNewEmailInput(e) {
		validateFirstEmail(e.target.value);
	}

	function validateFirstEmail(str) {
		newEmail = null;
		if(new Validator().validateEmail(str)) { 
			if(new AjaxCall().isUniqueEmail(str).value) {
				changeEmailFeedbackManager.sendInfo('Valid email.');
				newEmail = true;
			} else {
				changeEmailFeedbackManager.sendInfo('This email is used by someone else.');
			}
		} else { //display error message to the 'email-info' container
			changeEmailFeedbackManager.sendInfo('Invalid email.');
		}

		if(newEmail) onNewEmailRepeatInput(null);
	}

	function onNewEmailRepeatInput(e) {
		newEmailRepeat = null;
		var str = null;
		if(e !== null) str = e.target.value;
		else str = document.getElementById('newEmailRepeatId').value

		if(new Validator().validateEmail(str)) { 
			if(str === document.getElementById('newEmailID').value) {
				if(newEmail){
					changeEmailFeedbackManager.sendInfo('OK.', 'new-email-repeat-info');
					newEmailRepeat = true;
				}
			} else {
				changeEmailFeedbackManager.sendInfo('X', 'new-email-repeat-info');
			}
		} else { //display error message to the 'email-info' container
			changeEmailFeedbackManager.sendInfo('Invalid email.', 'new-email-repeat-info');
		}
	}

</script>