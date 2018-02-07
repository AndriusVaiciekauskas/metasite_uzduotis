// delete mygtukas su jQuery
$(document).ready(function() {
	// patvirtinimas pries istrinant subscriberi
	 $( '.delete_subscriber' ).on( 'click', function () {
	 	if (!confirm("Ar tikrai norite ištrinti šį vartotoją?")){
	 		return false;
	 	}
	 });
});

// prenumerata
if (document.getElementById("subscribe_form")) {
	document.getElementById("subscribe_form").addEventListener("submit", function(event){
		// nuresetinami laukai
	 	document.getElementById("message").innerHTML = "";
	 	
	 	// tikrinama ar yra neivestu lauku
	 	check_if_name_is_empty(document.getElementById("name"));
	 	check_if_email_is_empty_or_valid(document.getElementById("email"));
 		check_if_category_is_empty(document.getElementById("categories"));
	});
}

// registracija
if (document.getElementById("register_form")) {
	document.getElementById("register_form").addEventListener("submit", function(event){
		// nuresetinami laukai
	 	document.getElementById("message").innerHTML = "";
	 	
	 	// tikrinama ar yra neivestu lauku
	 	check_if_name_is_empty(document.getElementById("name"));
	 	check_if_password_is_empty(document.getElementById("password"));
	});
}

// login
if (document.getElementById("login_form")) {
	document.getElementById("login_form").addEventListener("submit", function(event){
		// nuresetinami laukai
	 	document.getElementById("message").innerHTML = "";
	 	
	 	// tikrinama ar yra neivestu lauku
	 	check_if_name_is_empty(document.getElementById("name"));
	 	check_if_password_is_empty(document.getElementById("password"));
	});
}

// edit
if (document.getElementById("edit_form")) {
	document.getElementById("edit_form").addEventListener("submit", function(event){
		// nuresetinami laukai
	 	document.getElementById("message").innerHTML = "";
	 	
	 	// tikrinama ar yra neivestu lauku
	 	check_if_name_is_empty(document.getElementById("name"));
	 	check_if_email_is_empty_or_valid(document.getElementById("email"));
	});
}


function check_if_name_is_empty(name) {
	 if (name.value == "") {
 		document.getElementById("message").innerHTML += '<p class="alert alert-danger">Neįvestas vardas.</p>';
 		event.preventDefault();
 	}
}

function check_if_password_is_empty(password) {
	if (password.value == "") {
		document.getElementById("message").innerHTML += '<p class="alert alert-danger">Neįvestas slaptažodis.</p>';
		event.preventDefault();
	}
}

function check_if_email_is_empty_or_valid(email) {
 	if (validate_email(email.value) === false && email.value != "") {
		document.getElementById("message").innerHTML += '<p class="alert alert-danger">El. paštas įvestas neteisingai.</p>';
		event.preventDefault();
	}

	if (email.value == "") {
		document.getElementById("message").innerHTML += '<p class="alert alert-danger">Neįvestas el. paštas.</p>';
		event.preventDefault();
	}
}

function check_if_category_is_empty(category) {
	if (category.value == "") {
		document.getElementById("message").innerHTML += '<p class="alert alert-danger">Turite pasirinkti bent vieną kategoriją.</p>';
		event.preventDefault();
	}
}

function validate_email(email) {
	reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	if (reg.test(email) == false) {
		return false;
	}
}
