
// The code below is for the confirm password validation 
// i.e. to check if the password and retyped passwords match in add_admin field
var password = document.getElementById("password")
, retype_password = document.getElementById("retype_password");

function validatePassword(){
	if(password.value != retype_password.value) {
		retype_password.setCustomValidity("Passwords Don't Match");
	} else {
		retype_password.setCustomValidity('');
	}
}
password.onchange = validatePassword;
retype_password.onkeyup = validatePassword;
// The script for the custom datepicker of the dob of form
$(document).ready(function () {
	$('.datepicker').datepicker({
		uiLibrary: 'bootstrap'
	}); 
});
	// Script for displaying the uploaded photo image
	function viewPhoto(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#photo')
				.attr('src', e.target.result)
				.width(120)
				.height(150);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}
	// Script for displaying the uploaded ID image
	function viewId(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$('#id')
				.attr('src', e.target.result)
				.width(150)
				.height(150);
			};

			reader.readAsDataURL(input.files[0]);
		}
	}

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
    options={
    	verdicts: ["Weak", "Normal", "Medium", "Strong", "Very Strong"],
    }
    $('#password').pwstrength(options);
});
