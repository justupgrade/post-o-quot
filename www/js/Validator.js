function Validator() {

}

Validator.prototype.validateString = function(str) {
	var pattern = /[ ,.;'"?<>$&\\]/;

	return  str !== undefined && str !== null && str.trim().length >= 4 && !pattern.test(str) ? true : false;
}

Validator.prototype.validateEmail = function(email) {
	var exclude = /[ ,;?'"<>$&]/;
	var include = /[@.]/;

	return this.basicValidation(email) && !exclude.test(email) && include.test(email) ? true : false;
}

Validator.prototype.basicValidation = function(str) {
	return str !== undefined && str !== null && str.trim().length >= 4 ? true : false;
}

Validator.prototype.validatePassword = function(str) {
	return this.basicValidation(str);
}