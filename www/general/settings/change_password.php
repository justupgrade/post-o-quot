<section class='default-style change-form' id='change-pass-account-form'>
	<form method='post' action='./actions/change_password.php'>
		<p><strong> Change Password</strong> </p>
		<div class='form-feedback' id='change-pass-form-feedback'></div>
		<div class='login-input'>
			<div>New Password</div>
			<input type='password' name='new-password-name' id='new-password-ID' placeholder='new-password' required>
			<div class='field-info' id='new-password-info'></div>
		</div>
		<div class='login-input'>
			<div>Repeat New Password</div>
			<input type='password' name='new-password-repeat-name' id='new-password-repeat-ID' placeholder='new-password' required>
			<div class='field-info' id='new-password-repeat-info'></div>
		</div>
		<div class='login-input'>
			<div>Confirm Old Password</div>
			<input type='password' name='old-password-name' id='old-password-ID' placeholder='old-password' required>
			<div class='field-info' id='old-password-info'></div>
		</div>
		<input class='blue-blue-style input-button' type='submit' name='change-password-btn-name' id='change-password-btn-id' value='Change Password'>
	</form>
</section>

<script type="text/javascript">
	//pass1 === pass2 && old-pass is ok
	document.getElementById('change-password-btn-id').addEventListener('click', onChangePasswordBtnClick);
	document.getElementById('new-password-ID').addEventListener('input', onNewPasswordInput);
	document.getElementById('new-password-repeat-ID').addEventListener('input', onNewPasswordRepeatInput);

	var pass1 = null;
	var pass2 = null;

	var changePasswordFeedback = new FeedbackManager('new-password-info','change-pass-form-feedback');

	function onChangePasswordBtnClick(e) {
		e.preventDefault();

		if(pass1 === true && pass2 === true) {
			var oldPass = document.getElementById('old-password-ID').value;
			if(new Validator().validatePassword(oldPass)) {
				if(new AjaxCall().isValidPassword(oldPass).value) {
					new AjaxCall().changePassword(
						document.getElementById('new-password-ID').value, 
						document.getElementById('new-password-repeat-ID').value, 
						oldPass, 
						onChangePasswordCompleted 
					);
				} else {
					changePasswordFeedback.sendFeedback('Old password is not valid.');
				}
			}
		} else {
			changePasswordFeedback.sendFeedback('Invalid input.');
		}

		document.getElementById('new-password-ID').value = '';
		document.getElementById('new-password-repeat-ID').value ='';
		document.getElementById('old-password-ID').value ='';

		pass1 = null;
		pass2 = null;
		changePasswordFeedback.sendInfo('', 'new-password-repeat-info');
		changePasswordFeedback.sendInfo('');
	}

	function onChangePasswordCompleted(success, msg) {
		if(success) {
			changePasswordFeedback.sendFeedback('Password changed successfully!');
		} else {
			changePasswordFeedback.sendFeedback(msg);
		}
	}

	function onNewPasswordInput(e) {
		pass1 = null;
		validateFirstPassword(e.target.value);
	}

	function validateFirstPassword(str) {
		if(new Validator().validatePassword(str)) { 
			changePasswordFeedback.sendInfo('Valid password.');
			pass1 = true;
		} else { //display error message to the 'pass-info' container
			changePasswordFeedback.sendInfo('Invalid pass.');
		}

		if(pass1) onNewPasswordRepeatInput(null);
	}

	function onNewPasswordRepeatInput(e) {
		var str = "";
		pass2 = null;
		if(e !== null) str = e.target.value;
		else str = document.getElementById('new-password-repeat-ID').value;

		if(new Validator().validatePassword(str)) { 
			if(str === document.getElementById('new-password-ID').value) {
				if(pass1){
					changePasswordFeedback.sendInfo('OK.', 'new-password-repeat-info');
					pass2 = true;
				}
			} else {
				changePasswordFeedback.sendInfo('X', 'new-password-repeat-info');
			}
		} else { //display error message to the 'email-info' container
			changePasswordFeedback.sendInfo('Invalid password.', 'new-password-repeat-info');
		}
	}
</script>