<script>
 // *****************************************************/**/********************** 
 /* *************************************************************************** */
 /* *************************************************************************** */
 /* *************************************************************************** */
// The below code is for multistep form
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the crurrent tab
function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= x.length) {
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "" ) {
      if( y[i].id !="middle_name" && y[i].id!="your_cover_input"  && y[i].id!="fax" ){
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
      //if the photo input is null make the image view border red
      if(y[i].id=='your_photo_input'){
        $('#your_photo_view').css({"background-color":"red"});
      }     
      if(y[i].id=='your_id_input'){
        $('#your_id_view').css({"background-color":"red"});
      }       
      if(y[i].id=='your_certificate_input'){
        $('#your_certificate_view').css({"background-color":"red"});
      }         
    }
    else{
      if(y[i].id=='your_photo_input'){
        $('#your_photo_view').css({"background-color":"inherit",});
        $('#your_photo_view').toggleClass("img-thumbnail");
        $('#your_photo_view').addClass("img-thumbnail");
      }
      else if(y[i].id=='your_id_input'){
        $('#your_id_view').css({"background-color":"inherit",});
        $('#your_id_view').toggleClass("img-thumbnail");
        $('#your_id_view').addClass("img-thumbnail");
      }
      else if(y[i].id=='your_certificate_input'){
        $('#your_certificate_view').css({"background-color":"inherit",});
        $('#your_certificate_view').toggleClass("img-thumbnail");
        $('#your_certificate_view').addClass("img-thumbnail");
      }
      else{
        y[i].style.backgroundColor = "inherit";
        y[i].style.border = "1px solid grey";
      }
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  // this is to be make true if testing so that we can escape js validation
  // valid = true;
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}
/* Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo  */
/* Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo  */
/* Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo  */
/* Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo Your Photo  */
// Photo Upload
// The code below is for the clicking of upload btn when the photo is clicked
$('#your_photo_view').on("click",function(){
  $('#your_photo_input').click();
});

/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
//For Photo Upload 
// For the change of image view when you upload the image
// Script for displaying the uploaded photo image
function viewPhoto(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var width = $('#your_photo_view').width();
      var height = $('#your_photo_view').height();
      $('#your_photo_view')
      .attr('src', e.target.result)
      .width(width)
      .height(height);
      var width = $('#user_photo_verify').width();
      var height = $('#user_photo_verify').height();
      $('#user_photo_verify')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
/* Identity Identity Identity  Identity Photo Identity Photo */
/* Identity Identity Identity  Identity Photo Identity Photo */
/* Identity Identity Identity  Identity Photo Identity Photo */
/* Identity Identity Identity  Identity Photo Identity Photo */
// For ID Upload
// The code below is for the clicking of upload btn when the photo is clicked
$('#your_id_view').on("click",function(){
  $('#your_id_input').click();
});

/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
// For ID Upload
// For the change of image view when you upload the image
// Script for displaying the uploaded photo image
function viewId(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var width = $('#your_id_view').width();
      var height = $('#your_id_view').height();
      $('#your_id_view')
      .attr('src', e.target.result)
      .width(width)
      .height(height);
      var width = $('#user_id_verify').width();
      var height = $('#user_id_verify').height();
      $('#user_identity_verify')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
/* Cover Picture of Company Cover Picture of Company Cover Picture of Company */
/* Cover Picture of Company Cover Picture of Company Cover Picture of Company */
/* Cover Picture of Company Cover Picture of Company Cover Picture of Company */
/* Cover Picture of Company Cover Picture of Company Cover Picture of Company */
// For Cover Picture Upload
// The code below is for the clicking of upload btn when the photo is clicked
$('#your_cover_view').on("click",function(){
  $('#your_cover_input').click();
});

/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
// For Cover Photo Upload
// For the change of image view when you upload the image
// Script for displaying the uploaded photo image
function viewCover(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var width = $('#your_cover_view').width();
      var height = $('#your_cover_view').height();
      $('#your_cover_view')
      .attr('src', e.target.result)
      .width(width)
      .height(height);
      var width = $('#company_cover_verify').width();
      var height = $('#company_cover_verify').height();
      $('#company_cover_verify')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
/* Certificate of Company Certificate of Company Certificate of Company */
/* Certificate of Company Certificate of Company Certificate of Company */
/* Certificate of Company Certificate of Company Certificate of Company */
/* Certificate of Company Certificate of Company Certificate of Company */
// For Certificate Picture Upload
// The code below is for the clicking of upload btn when the photo is clicked
$('#your_certificate_view').on("click",function(){
  $('#your_certificate_input').click();
});

/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
/* *************************************************************************** */
// For Certificate Upload
// For the change of image view when you upload the image
// Script for displaying the uploaded photo image
function viewCertificate(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      var width = $('#your_certificate_view').width();
      var height = $('#your_certificate_view').height();
      $('#your_certificate_view')
      .attr('src', e.target.result)
      .width(width)
      .height(height);
      var width = $('#company_certificate_verify').width();
      var height = $('#company_certificate_verify').height();
      $('#company_certificate_verify')
      .attr('src', e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}
/* Code for the verification page when the input changes */
/* Code for the verification page when the input changes */
/* Code for the verification page when the input changes */
/* Code for the verification page when the input changes */
// Code For the Verification Page
// Label on the verification page changes when the input changes
$(document).ready(function(){
  // Listener for the different input fields
  // Name Verify
  $('#first_name').add('#middle_name').add('#last_name').on('change',function(){    
   var value = $("#first_name").val() + " " + $("#middle_name").val() +" " + $("#last_name").val();
   $("#name_verify").text(" ");
   $("#name_verify").text(value);

 });
  // Dob Verify
  $('#dob').on('change',function(){
    $("#dob_verify").text($('#dob').val());
  });
  // Gender Verify
  $('#gender_verify').text($('input[name=gender]:checked').val());
  $('input[name=gender]').on('change',function(){
    $('#gender_verify').text($('input[name=gender]:checked').val());
  });
  // Company Name verify
  $('#company_name').on('change',function(){
    $("#company_name_verify").text($('#company_name').val());
  });
  // Phone verify
  $('#phone').add('#phone_country').on('change',function(){
    if($('#phone').val()!=""){
      $("#phone_verify").text($('#phone_country').val() + "-" + $('#phone').val());
    }
    else{
      $("#phone_verify").text(null);
    }
  });

  // fax verify
  $('#fax').add('#fax_country').on('change',function(){
    if($('#fax').val()!=""){
      $("#fax_verify").text($('#fax_country').val() + "-" + $('#fax').val());
    }
    else{
      $("#fax_verify").text(null);
    }
  }); 
  // Country verify
  var country_code = $('#country').val();    
  $("#country_verify").text($('option[value='+country_code+']').text());
  $('#country').on('change',function(){
    var country_code = $('#country').val();    
    $("#country_verify").text($('option[value='+country_code+']').text());
  });
  // City verify
  $('#city').on('change',function(){
    $("#city_verify").text($('#city').val());
  });
  // Address verify
  $('#address').on('change',function(){
    $("#address_verify").text($('#address').val());
  });
  // Postal Code verify
  $('#postal_code').on('change',function(){
    $("#postal_code_verify").text($('#postal_code').val());
  });
  /* ********************************************************************* */
  /* ********************************************************************* */
  /* ********************************************************************* */
  //assigining the old values if present and assiging values to the verify
   //name verify putting the old values in the form if present both in verify and input field
   $("#first_name").val("{{old('first_name')}}");  
   $("#middle_name").val("{{old('middle_name')}}");  
   $("#last_name").val("{{old('last_name')}}");
   var value = $("#first_name").val() + " " + $("#middle_name").val() +" " + $("#last_name").val();
   $("#name_verify").text(" ");
   $("#name_verify").text(value);

   //dob verify putting the old values in the form if present both in verify and input field
   $("#dob").val("{{old('dob')}}");
   $("#dob_verify").text($('#dob').val());
   // gender verify putting the old values in the form if present both in verify and input field 
   if('{{old('gender')}}'!=''){
    $("input[name=gender][value='{{old('gender')}}']").attr('checked',true);
    $('#gender_verify').text($('input[name=gender]:checked').val());
  }
   // company_name verify putting the old values in the form if present both in verify and input field 
   $("#company_name").val("{{old('company_name')}}");
   $("#company_name_verify").text($('#company_name').val());
   //phone verify putting the old values in the form if present both in verify and input field
   $('#phone').val("{{old('phone')}}");
   var phone_country = "{{old('phone_country')}}";
   if(phone_country!=""){
     $('#phone_country').val(phone_country);
   }
   else{
    $('#phone_country').select().first();
  }
  if($('#phone').val()!=""){
    $("#phone_verify").text($('#phone_country').val() + "-" + $('#phone').val());
  }
  else{
    $("#phone_verify").text(null);
  }
  //fax verify putting the old values in the form if present both in verify and input field
  $('#fax').val("{{old('fax')}}");
  var fax_country = "{{old('fax_country')}}";
  if(fax_country!=""){
    $('#fax_country').val(fax_country);
  }
  else{
    $('#fax_country').select().first();
  }

  if($('#fax').val()!=""){
    $("#fax_verify").text($('#fax_country').val() + "-" + $('#fax').val());
  }
  else{
    $("#fax_verify").text(null);
  }
  // country verify putting the old values in the form if present both in verify and input field
  var country = "{{old('country')}}";
  if(country!=null){
    $('#country').val();
    var country_code = $('#country').val();    
    $("#country_verify").text($('option[value='+country_code+']').text());    
  }
  // City verify putting the old values in the form if present both in verify and input field  
  $('#city').val("{{old('city')}}");
  $("#city_verify").text($('#city').val());
  // Address verify putting the old values in the form if present both in verify and input field
  $('#address').val("{{old('address')}}");
  $("#address_verify").text($('#address').val());
  // Postal Code verify putting the old values in the form if present both in verify and input field
  $('#postal_code').val("{{old('postal_code')}}");
  $("#postal_code_verify").text($('#postal_code').val());
  
  /* Photo upload with the old values*/
  /* Photo upload with the old values*/
  /* Photo upload with the old values*/
  // files cannot be repopulated in the form as the security measure
  // you need to store the file in the db or cache and repopulate it
  // i will do this later
  /* value for the user hidden field so that we can get value for email, user_id and username in the form automatically*/
  /* value for the user hidden field so that we can get value for email, user_id and username in the form automatically*/
  /* value for the user hidden field so that we can get value for email, user_id and username in the form automatically*/
// First Check if there is the old value present for user_id and user_name if not then assign the value passed if the value passed is present
var old_user = "{{old('user')}}";
var user = "{{$user}}";
if(user!=""){

  user = $.parseJSON(@php echo(json_encode($user)) @endphp);

}
var confirm_user;
// value for user
if(old_user==""&&user!=""){  
  confirm_user = user; 
  
}
else if(old_user!=""&&user==""){
  confirm_user = old_user;
  
}
else if(old_user!=""&&user!=""){
  confirm_user = user;
  
}
$('#user').val(JSON.stringify(confirm_user));
console.log("User ::: "+confirm_user['user_id']);
// assiging the value to the user_id, user_name and the email label

console.log("Confirm User : "+ JSON.stringify(confirm_user));
if(confirm_user!=null){
  if("user_id" in confirm_user){
    $('#user_id_verify').text(confirm_user['user_id']);
  }
  if("username" in confirm_user){
    $('#username_verify').text(confirm_user['username']);
  }
  if("email" in confirm_user){
    $('#email_verify').text(confirm_user['email']);
  }
}
});
</script> 