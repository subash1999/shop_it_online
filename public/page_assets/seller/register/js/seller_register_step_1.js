// The code below is for the confirm password validation 
// i.e. to check if the password and retyped passwords match in add_admin field
var password = document.getElementById("password")
, password_again = document.getElementById("password_confirmation");

function validatePassword(){
	if(password.value != password_again.value) {
		password_again.setCustomValidity("Passwords Don't Match");
	} else {
		password_again.setCustomValidity('');
	}
}
password.onchange = validatePassword;
password_again.onkeyup = validatePassword;
// The following code is for the password strength checking
// 
jQuery(document).ready(function () {
    "use strict";
    var options = {};
    options.ui = {
        container: "#pwd-container",
        showVerdictsInsideProgressBar: true,
        viewports: {
            progress: "#pwstrength_viewport_progress"
        },
        progressBarExtraCssClasses: "progress-bar-striped active"
    };
    options.common = {
        debug: true,
        
    };
    
    $('#password').pwstrength(options);
});