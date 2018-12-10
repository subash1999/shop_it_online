<!-- Currently you can use only one in a single page -->
<img id="" class="img-thumbnail upload_preview_image" src="<?php echo e(asset('img/system/user_photo_placeholder.jpg')); ?>" alt="profile picture placeholder" width="100px" height="100px" class="img-fluid rounded-circle m-3" style="cursor: pointer;" required="required">		
<div class="btn upload_btn" style="cursor: pointer;">
	<button class="btn btn-outline-secondary">Upload</button>
	<input type="file" class="photo_upload_input upload_image_input" name="file" id="" onchange="viewPhoto(this);" required="required">	
</div>	

<style type="text/css">
.upload_btn{
	position: relative;
	overflow: hidden;
	display: inline-block;
	cursor: pointer;
}
.photo_upload_input{
	position: absolute;
	left:0;
	top: 0;
	opacity: 0;
	cursor: pointer;
}
</style>
<script >
	// The code below is for the clicking of upload btn when the photo is clicked
	$('.upload_image_preview').on("click",function(){
		$('.upload_image_input').click();
	});

	/* *************************************************************************** */
	/* *************************************************************************** */
	/* *************************************************************************** */
	/* *************************************************************************** */
// For the change of image view when you upload the image
// Script for displaying the uploaded photo image
function viewPhoto(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			var width = $('upload_image_preview').width();
			var height = $('upload_image_preview').height();     
			$('.upload_image_preview')
			.attr('src', e.target.result)
			.width(100)
			.height(100);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

</script>