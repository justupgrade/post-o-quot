//------------------ AJAX --------------------------
	function AjaxCall() {
		this.callback = null;
	}

	AjaxCall.prototype.updateUserName = function(user, callback) {
		this.callback = callback;

		var formdata = new FormData();
		formdata.append('id', user.getID());
		formdata.append('new_name', user.getName());

		var xhr = new XMLHttpRequest();
		xhr.instance = this;
		xhr.addEventListener('load', this.onUpdateUserNameCompleted);
		xhr.open('POST', './actions/change_username.php');
		xhr.send(formdata);
	}

	AjaxCall.prototype.updateUserEmail = function(email1, email2, callback) {
		this.callback = callback;

		var formdata = new FormData();
		formdata.append('newEmailRepeatName', email2);
		formdata.append('newEmailName', email1);

		var xhr = new XMLHttpRequest();
		xhr.instance = this;
		xhr.addEventListener('load', this.onUpdateEmailCompleted);
		xhr.open('POST', './actions/change_email.php');
		xhr.send(formdata);
	}

	AjaxCall.prototype.changePassword = function(pass1,pass2,oldPass,callback) {
		this.callback = callback;

		var formdata = new FormData();
		formdata.append('new-password-name', pass1);
		formdata.append('new-password-repeat-name', pass2);
		formdata.append('old-password-name', oldPass);

		var xhr = new XMLHttpRequest();
		xhr.instance = this;
		xhr.addEventListener('load', this.onChangePasswordCompleted);
		xhr.open('POST', './actions/change_password.php');
		xhr.send(formdata);
	}

	AjaxCall.prototype.onChangePasswordCompleted = function(e) {
		var response = JSON.parse(e.target.responseText);
		if(response.status.toLowerCase() === "success") {
			e.target.instance.callback(true);
		} else {
			e.target.instance.callback(false, response.problemMsg);
		}
	}

	AjaxCall.prototype.onUpdateUserNameCompleted = function(e) {
		var response = JSON.parse(e.target.responseText);
		if(response.status.toLowerCase() === "success") {
			e.target.instance.callback(true);
		} else {
			e.target.instance.callback(false, response.problemMsg);
		}
	}

	AjaxCall.prototype.onUpdateEmailCompleted = function(e) {
		var response = JSON.parse(e.target.responseText);
		if(response.status.toLowerCase() === "success") {
			e.target.instance.callback(true);
		} else {
			e.target.instance.callback(false, response.problemMsg);
		}
	}

	AjaxCall.prototype.isValidPassword = function(str) {
		var result = {"value": null};
		var xhr = new XMLHttpRequest();
		xhr.open('GET', './actions/is_valid_password.php?password='+str, false);
		xhr.send();
		xhr.onreadystatechange = function(res) {
			if(xhr.readyState == 4) {
				if(xhr.responseText == 'Success') {
					res.value = true;
				} 
				else {
					res.value = false;
				}
			}
		}(result);

		return result;
	}

	AjaxCall.prototype.isUniqueEmail = function(str) {
		var result = {"value": null};
		var xhr = new XMLHttpRequest();
		xhr.open('GET', './actions/look_for_unique.php?email='+str, false);
		xhr.send();
		xhr.onreadystatechange = function(res) {
			if(xhr.readyState == 4) {
				if(xhr.responseText == 'Success') {
					res.value = true;
				} 
				else {
					res.value = false;
				}
			}
		}(result);

		return result;
	}

	AjaxCall.prototype.isUniqueUsername = function(str) {
		var result = {"value": null};
		var xhr = new XMLHttpRequest();
		xhr.open('GET', './actions/look_for_unique.php?username='+str, false);
		xhr.send();
		xhr.onreadystatechange = function(res) {
			if(xhr.readyState == 4) {
				if(xhr.responseText == 'Success') {
					res.value = true;
				} 
				else {
					res.value = false;
				}
			}
		}(result);

		return result;
	}
	// ------------------ END of AJAX ------------------------