window.onload = function() {
	//add listeners to nav...
	var menus = document.querySelectorAll('.nav-style');
	
	var i;

	for(i =0; i < menus.length; i++) {
		if(menus[i].innerHTML == 'Create Account') {
			menus[i].addEventListener('click', onCreateAccountClick);
		} else {
			menus[i].addEventListener('click', onMenuItemClick);
		}
	}
}

function onMenuItemClick(e) {
	var menuName = e.target.innerHTML.toLowerCase();

	window.location.href = menuName + ".php";
}

function onCreateAccountClick(e) {
	var createAcccountForm = document.getElementById('create-account-form');
	createAcccountForm.style.display = 'block';
}