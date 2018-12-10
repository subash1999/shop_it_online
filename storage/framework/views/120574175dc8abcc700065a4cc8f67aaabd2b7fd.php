
<style type="text/css">
#myBtn {
	display: none; /* Hidden by default */
	position: fixed; /* Fixed/sticky position */
	bottom: 3%; /* Place the button at the bottom of the page */
	right: 1%; /* Place the button 30px from the right */
	z-index: 99; /* Make sure it does not overlap */
	border: none; /* Remove borders */
	outline: none; /* Remove outline */
	background-color: #68A2D5;/*  Set a background color */
	color: white; /* Text color */
	cursor: pointer; /* Add a mouse pointer on hover */
	padding: 15px;  /*Some padding */
	border-radius: 50%; /* Rounded corners */
	font-size: 18px; /* Increase font size */
	width: 50px;
	height: 50px;
	padding: 10px 16px;
	font-size: 18px;
	line-height: 1.00;
	border-radius: 25px;
}

#myBtn:hover {

	background-color: #4679BD; /* Add a dark-grey background on hover */
}
</style>

<!--  -->
<!--  -->
<!--  -->
<!--  -->
<script language="JavaScript">
	window.onscroll = function() {scrollFunction()};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("myBtn").style.display = "block";
		} else {
			document.getElementById("myBtn").style.display = "none";
		}
	}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    scrollTo(document.body, 0, 500); // For Safari
    scrollTo(document.documentElement, 0, 500); // For Chrome, Firefox, IE and Opera
} 

function scrollTo(element, to, duration) {
	var start = element.scrollTop,
	change = to - start,
	currentTime = 0,
	increment = 20;
	
	var animateScroll = function(){        
		currentTime += increment;
		var val = Math.easeInOutQuad(currentTime, start, change, duration);
		element.scrollTop = val;
		if(currentTime < duration) {
			setTimeout(animateScroll, increment);
		}
	};

	animateScroll();
}

//t = current time
//b = start value
//c = change in value
//d = duration
Math.easeInOutQuad = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t + b;
	t--;
	return -c/2 * (t*(t-2) - 1) + b;
};

</script>
<!--  -->
<!--  -->
<!-- IT Requires the fontawesome 4 or greater -->
<!-- Bootstrap 3 or 4 bootstrap.min.js and bootstrap.min.css in both  -->
<!-- Bootstrap Core JavaScript -->

<!-- Bootstrap Core CSS bootstrap 3 -->



<button class="btn btn-block " style="font-size: 25px;" onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up"></i></button>