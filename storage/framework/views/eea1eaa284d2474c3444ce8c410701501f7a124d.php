<?php $__env->startSection('center_content'); ?>

<style type="text/css">
form label{
	/*font-weight: normal;*/
}
</style>

<div class="" style="margin: 10px; padding: 10px; width:100%">
	<div class="">
		<h1 class="h2">Add New Product</h1>
		<div class="alert-info" style="padding: 10px;">
			<div class="alert-heading"><u>Note : </u></div>
			<ul>
				<li>
					<label class="text-warning">Field with star(<span class="text-danger" style="font-size: larger;">*</span>) are required !!</label>
				</li>
				<li>
					<label>All the image input must be of size less than 1500 KB</label>
				</li>
				<li>
					<label>All the text input(name,keywords,option group name,option name, etc) must not be more than 255 characters, if otherwise mentioned so.</label>
				</li>

			</ul>
		</div>
		<div class="alert alert-success" id="product_add">
			<li>Product Addition is a successful</li>
		</div>
		
		<br>
		 
		
		<div id="server_error_alert" class="alert-danger" style="display: none;padding: 10px;">
			
		</div>
		<hr>
	</div>

	<div class="card-body">		
		
		<form id="product_add_form" method="post" style="width:100%;" enctype="multipart/form-data">	
			<?php echo csrf_field(); ?>
			<?php echo method_field('post'); ?>
			
			<div >
				
				<style type="text/css">
				a.nav-item.nav-link {
					cursor: pointer;
				}
			</style>	
			<div class="alert-danger" id="js_error_alert" style="display: none;">
				<div class="alert-heading">Lists of Errors on Form</div>
				<div class="">
					<ol>
						<li>All the required fields are not filled before submission !!!</li>
						<li>Please Fill Required fieds in the form below</li>
					</ol>
				</div>
				
			</div>
			<ul class="nav nav-tabs" id="#new_product_nav">
				<li class="active"><a href="#category" class="nav-item nav-link"  id="nav-category-tab"><span style="color: red;font-style: inherit;">*</span>Category</a></li>
				<li ><a href="#product"  class="nav-item nav-link" id="nav-product-tab"><span style="color: red;font-style: inherit;">*</span>Product</a></li>
				<li ><a href="#options"  class="nav-item nav-link"  id="nav-options-tab"><span></span>Options</a></li>
				<li ><a href="#features"  class="nav-item nav-link"  id="nav-features-tab"><span></span>Features</a></li>
				<li ><a href="#keywords"  class="nav-item nav-link"  id="nav-keywords-tab"><span></span>Keywords</a></li>
			</ul>			

			<br>
			<div class="form-group">
				<label class="form-control-label label-danger text-light" id="input_required_label">All the required fields are  not filled in the current tab. Please fill all the fields required !!!</label>
			</div>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade in active" id="category">
					<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/new_product_category_tab', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="tab-pane fade " id="product">
					<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/new_product_product_tab', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="tab-pane fade" id="options">
					<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/new_product_options_tab', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="tab-pane fade " id="features">
					<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/new_product_features_tab', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>	
				<div class="tab-pane fade " id="keywords">
					<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_pages/seller_dashboard_product/new_product_keywords_tab', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>					
			</div>
		</div>
		<hr>
		<div align="middle">
			
			<input type="button" class="btn btn-theme03 btn-lg" value="Save and Finish" id="product_submit_btn" name="product_submit_btn">
		</div>
	</form>

</div>		
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('pagewise_assets'); ?>

<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-fileupload/bootstrap-fileupload.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-datepicker/css/datepicker.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-daterangepicker/daterangepicker.css')); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-timepicker/compiled/timepicker.css')); ?>" />


<!-- Datatable scripts -->
<script src="<?php echo e(asset('api/datatables/datatables.min.js')); ?>"></script>
<script src="<?php echo e(asset('api/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js')); ?>"></script>


<script src="<?php echo e(asset('page_assets/seller/dashio/lib/jquery-ui-1.9.2.custom.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-fileupload/bootstrap-fileupload.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-datepicker/js/bootstrap-datepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-daterangepicker/date.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-daterangepicker/moment.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('page_assets/seller/dashio/lib/bootstrap-timepicker/js/bootstrap-timepicker.js')); ?>"></script>

<script src="<?php echo e(asset('page_assets/seller/dashio/lib/advanced-form-components.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('api/shieldui/css/light-bootstrap/all.min.css')); ?>">



<script src="<?php echo e(asset('api/shieldui/js/shieldui-all.min.js')); ?>"></script>

<script type="text/javascript">
	$(".tree_view").shieldTreeView();
	
</script>


<script type="text/javascript">	
	$('#input_required_label').hide(0);
	jQuery(document).ready(function($) {
		$('.nav-tabs a').click(function (event) {
			event.preventDefault();			
			var href = $('ul.nav-tabs li.active a').attr('href');
			var is_filled = isRequiredFilled(href);
			// var is_filled=true;
			if(!is_filled){
				console.log("All fields are not filled, so for is all field filled : " + is_filled);
				$('#input_required_label').show('slow');
			}	
			else{
				$('#input_required_label').hide('slow');
				$(this).tab('show');
			}		
		})
	});
	// if you want to find the required fields filled for a particular tab's content then give the id as the href of the navigation tab
	// if the href value is null it will simply check if all the required fields are filled in the given multi-tab form
	function isRequiredFilled(href=null) {
		var is_filled =true;
		// previous_tab hre if #category here # is for id so using it like this
		if (href==null) {
			var all_required = $('div#nav-tabContent :input[required]');
		}
		else{
			var all_required = $('div#nav-tabContent div'+href+' :input[required]');
		}
		console.log('div#nav-tabContent div'+href+' :input[required]');
		for (var i = 0; i < all_required.length; i++) {
			var current_element = all_required.eq(i);
			var has_valid_control = current_element.hasClass('is-valid');
			var has_invalid_control = current_element.hasClass('is-invalid');
			if(has_valid_control || has_invalid_control){
				current_element.removeClass('is-valid');
				current_element.removeClass('is-invalid');
			}
			if(current_element.val() == "" || current_element.val() == null){				
				is_filled = false;
				if(has_valid_control || has_invalid_control){
					current_element.removeClass('is-valid');
					current_element.removeClass('is-invalid');					
				}
				current_element.addClass('is-invalid');
			}	
			else{
				if(has_valid_control || has_invalid_control){
					current_element.removeClass('is-valid');
					current_element.removeClass('is-invalid');
				}
				current_element.addClass('is-valid');
			}

		}
		return is_filled;	
	}
</script>

<script>	
	$(document).ready(function() {
		$("#product_submit_btn").click(function(event) {
			event.preventDefault();
			var all_required_filled = isRequiredFilled();
			// var all_required_filled = true;			
			var form = $("#product_add_form");
			var js_error_div = $("div#js_error_alert");
			if(all_required_filled){
				$('#input_required_label').hide('slow');
				js_error_div.hide('slow');
				form_submit(this);

			}
			else{
				// Here we call the function of go to top button to scroll to positon
				scrollTo(document.body, js_error_div.offset(), 500); // For Safari
    			scrollTo(document.documentElement, js_error_div.offset(), 500); // For Chrome, Firefox, IE and Opera
    			js_error_div.show('slow');
    		}
    	});
		function form_submit(this_form) {
			var server_error_div = $('div#server_error_alert.alert-danger'); 
			var form_data = new FormData($("#product_add_form")[0]);
			$.ajax({
				url: '<?php echo e(url('seller/dashboard/new_product_store')); ?>',
				type: 'post',
				dataType: "json",
				processData: false,
				contentType : false,
				data: form_data,
			})
			.done(function(data) {
				server_error_div.hide(0);
				if(data.errors.length>0){
					server_error_div.empty();
					// Here we call the function of go to top button to scroll to positon
					scrollTo(document.body, server_error_div.offset().top, 700); // For Safari
    				scrollTo(document.documentElement, server_error_div.offset().top, 700); // For Chrome, Firefox, IE and Opera
    				server_error_div.append('<div class="alert-heading"><u><h4>Lists of Errors on Form</h4></u></div><div>');
    				server_error_div.append("<ol type='1'>");
    				$.each(data.errors,function(key,value) {
    					server_error_div.show('slow');
    					server_error_div.append('<li>'+value+'</li>');

    				});
    				server_error_div.append('</ol></div>')
    			}
    			$.each(data.success,function() {
    				server_error_div.hide(0);	
    				bootbox.alert({
    					title: "New Product Added Successfully ",
    					message: `The new product added is in link 
    					<a href="<?php echo e(url('product/')); ?>/${data.sp_id}">New Product Link</a>`,
    				});	
    				$("#product_add_form").reset();		
    			})
    		}).fail(function(jqXHR, textStatus, errorThrown) {
    			server_error_div.empty();
    			// Here we call the function of go to top button to scroll to positon
				scrollTo(document.body, server_error_div.offset().top, 500); // For Safari
    			scrollTo(document.documentElement, server_error_div.offset().top, 500); // For Chrome, Firefox, IE and Opera
    			server_error_div.append('<div class="alert-heading"><u><h4>Lists of Ajax Errors on Form</u><label style="font-size:x-small;">(You are recommended to report it to the website)</label></h4></div>');
    			server_error_div.append("<ul>");
    			server_error_div.show('slow');
    			server_error_div.append('<li>Ajax Error Thrown : '+errorThrown+'</li>');
    			server_error_div.append('<li>Ajax Error Text Status : '+textStatus+'</li>');
    			server_error_div.append('</ul>')					

    		})
    		.always(function() {

    		});
    	}
    });

</script>


<script src="<?php echo e(asset('api/bootbox/bootbox.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('seller/seller_dashboard/seller_dashboard_layout/seller_dashboard_layout', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>