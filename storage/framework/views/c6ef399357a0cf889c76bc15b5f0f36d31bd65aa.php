<style>
table.product_form_table tbody tr td{
	margin-left: 10px;
	
}
table.product_form_table tbody tr td input[type="number"]{
	width: 30%;
}
</style>

<table class="product_form_table table"  >	
	<tbody>
		<tr>
			<td align="right">				
				<label class="control-label" for="product_name">
					<label class="label" style="color: red;">*</label>Product Name<br><label style="font-size: x-small;"> (Max 255 character)</label>
				</label>				
			</td>
			<td >
				<input type="text" name="product_name" id="product_name" class="form-control" style="margin-left: 5px;" maxlength="255"  value="<?php echo e(old('product_name')); ?>" required> 
				
			</td>
		</tr>
		<tr >
			<td align="right">
				<div >
					<label class="control-label form-group" for="description"><label class="label" style="color: red;" >*</label>					
					Description<br><label style="font-size: x-small;">(Max 2000 character)</label>				</label>
				</div>				
			</td>
			<td >
				<div >
					<textarea placeholder="Your Products Description Here ..." maxlength="2000" style="resize: both;" class="form-control" cols="50" rows="6" name="description" id="description" required></textarea>

				</div> 				
			</td>
		</tr>
		<tr >
			<td align="right">
				<div >
					<label class="control-label form-group" for="quantity"><label class="label" style="color: red;" >*</label>		
					Qunatity<br><label style="font-size: x-small;">(More than 0 and only whole numbers)</label>
				</label>
			</div>				
		</td>
		<td >
			<div class="form-inline" >
				<input type="number" class="form-control" name="quantity" id="quantity" min="0" required>
				
			</div> 				
		</td>

	</tr>
	<tr>
		<td align="right">
			<div >
				<label class="control-label form-group" for="unit_price"><label class="label" style="color: red;" >*</label>		
				Unit Price<br><label style="font-size: x-small;">(More than 0 and only two digit decimal numbers e.g. 1.02,2.54, etc.)</label></label>
			</div>
		</td>
		<td >
			<div >
				<input type="number" class="form-control" name="unit_price" id="unit_price" step="0.01" min="0" required>
			</div> 		
		</td>	
	</tr>
	<tr>
		<td align="right">
			<div>
				<label class="control-label form-group" for="curr_id"><label class="label" style="color: red;" >*</label>		
				Currency<br><label style="font-size: x-small;">(Select the currency for unit price of product)</label></label>
			</div>
		</td>
		<td>
			<div>			
				<select name="curr_id" id="curr_id" class="custom-select form-control-lg mb-3" required>
					<option value="" selected disabled>-- Please Select Currency -- </option>
					<?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<option value="<?php echo e($currency->curr_id); ?>"><?php echo e($currency->currency_name); ?> (<?php echo e($currency->country); ?>)</option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</select>
			</div>

		</td>
	</tr>
	<tr>
		<td align="right">
			<label class="control-label form-group" for="product_name">
				<label class="label" style="color: red;" >*</label>		
				Photo<br><label style="font-size: x-small;"> (At Least 1 i.e Main Picture is required) and (Max size 1500 KB)</label>
			</label>				
		</td>
		<td >
			<div class="col-md-12">
				<label class="label label-danger" ">*</label>
				<label class="label label-default">Main Picture of Product</label>

				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new thumbnail" style="width: 250px; height: 180px;">
						<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" id="main_product_image" name="main_product_image">
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 180px; line-height: 20px;"></div>
					<div>
						<span class="btn btn-theme02 btn-file">
							<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select Main image</span>
							<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
							<input type="file" name="main_product_image_input" id="main_product_image_input" class="default" accept="image/*" required>
						</span>
						<a href="javascript:void(0)" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload" onclick="deleteMainProductImage()"><i class="fa fa-trash-o"></i> Remove</a>
					</div>
				</div>
			</div>
			<br>
			<?php for($i = 1; $i < 3; $i++): ?>
			<div class="col-md-4">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<div class="fileupload-new thumbnail" style="width: 150px; height: 100px;">
						<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" name="product_image[<?php echo e($i); ?>]" id="product_image_<?php echo e($i); ?>">
					</div>
					<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 20px;"></div>
					<div>
						<span class="btn btn-theme02 btn-file">
							<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
							<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
							<input type="file" class="default" accept="image/*" name="product_image_input[<?php echo e($i); ?>]" id="product_image_input_<?php echo e($i); ?>">
						</span>
						<a href="javascript:void(0)" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload" onclick="deleteProductImage('product_image_<?php echo e($i); ?>','product_image_input_<?php echo e($i); ?>')"><i class="fa fa-trash-o"></i> Remove</a>
					</div>
				</div>
			</div>	
			<?php endfor; ?>	

		</td>
	</tr>
</tbody>
</table>
<script >
	// Script for removing the product image
	function deleteProductImage(product_image_id,product_image_input_id) {
		$("img#"+product_image_id).attr('src','//:0');
		var product_image = $("input[type='file']#"+product_image_input_id);
		product_image.wrap('<form>').closest('form').get(0).reset();
		product_image.unwrap();
	}
	// script for removing the main product image
	function deleteMainProductImage() {
		$("img#main_product_image").attr('src','');
		var product_main_image = $("input#main_product_image_input");
		product_main_image.wrap('<form>').closest('form').get(0).reset();
		product_main_image.unwrap();
	}
</script>