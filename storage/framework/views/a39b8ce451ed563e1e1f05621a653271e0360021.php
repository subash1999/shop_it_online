
<div>
	<h3 class="h3">Options Available for Your Product </h3>
	<label class="label label-primary" >If your product has the options/variations available please enter them</label>
</div>
<div class="alert-warning m-5">
	<div class="alert-heading"><u>
		Waring for adding Option Group and Options in those groups</u>
	</div>
	<div>
		<ol type="1">
			<li>If a option group name is not empty
				<ol type="i">
					<li>You have to put all the values in option rows of that option group</li>
					<li>You cannot leave any field empty in that option group</li>
					<li>if there is no option row present then option group won't be saved</li>
					
				</ol>

			</li>
			<li>If a empty option row is present
				<ol type="i">
				    <li>Delete a option row if not required you cannot leave one empty</li>
				</ol>
			</li>
		</ol>
	</div>
</div>
<hr>
<div class="m-lg-5">
	<button type="button" class="btn btn-block btn-theme02" onclick="addOptionGroup()">Add Option Group</button>
</div>
<hr>
<?php
$option_group = 1;
$option =1;
?>
<div id="option_groups_collection">
	<div class="option_group" id="option_group_<?php echo e($option_group); ?>" name="option_group[<?php echo e($option_group); ?>]">
		<h4 class="h4">Option Group <?php echo e($option_group); ?> <button type="button" class="btn btn-theme04 float-right" onclick="deleteOptionGroup('option_group_<?php echo e($option_group); ?>')">Delete Option Group</button></h4>
		<div class="form-inline">
			<label class="control-label">Option Group Name<label style="font-size: x-small;"> (Max 255 character)</label></label>
			<input type="text" name="option_group[<?php echo e($option_group); ?>][option_group_name]" id="option_group_<?php echo e($option_group); ?>" class=" form-control m-3" placeholder="i.e. color,size,color and size,etc" maxlength="255">
		</div>
		<div class="from-group">
			<label class="control-label"><u>Option Available or the Option Group</u></label>
			<button type="button" class="btn btn-primary m-4" id="add_option_btn" name="add_option_btn" onclick="addOption('option_group_<?php echo e($option_group); ?>',<?php echo e($option_group); ?>)">Add Option</button>
			<table class="table table-bordered option_group_table" id="option_group_table_<?php echo e($option_group); ?>">
				<thead>
					<th>Option</th>
					<th>Product Photo</th>
					<th>Number of Items</th>
					<th>Delete Action</th>
				</thead>
				<tbody>					
					<tr class="option_row" id="option_row_<?php echo e($option); ?>">
						<td><input class="option form-control" type="text" name="option_group[<?php echo e($option_group); ?>][<?php echo e($option); ?>][option_name]" id="option_group_<?php echo e($option_group); ?>_option_<?php echo e($option); ?>" maxlength="255">								
						</td>
						<td>
							<div class="col-md-4">
								<div class="fileupload fileupload-new" data-provides="fileupload">
									<div class="fileupload-new thumbnail" style="width: 150px; height: 100px;">
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" name="option_group_<?php echo e($option_group); ?>_option_<?php echo e($option); ?>_img" id="option_group_<?php echo e($option_group); ?>_option_<?php echo e($option); ?>_img">
									</div>
									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 20px;"></div>
									<div>
										<span class="btn btn-theme02 btn-file">
											<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>
											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
											<input type="file" class="default" accept="image/*" name="option_group[<?php echo e($option_group); ?>][<?php echo e($option); ?>][option_image]" class="option_group_<?php echo e($option_group); ?>_option_<?php echo e($option); ?>_input">
										</span>
										<a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
									</div>
								</div>
							</div>									
						</td>
						<td>
							<input class="option form-control" type="number" name="option_group[<?php echo e($option_group); ?>][<?php echo e($option); ?>][number_of_items]" id="option_group_<?php echo e($option_group); ?>_option_<?php echo e($option); ?>_qty" min="0">
						</td>
						<td>
							<button type="button" class="btn btn-danger" id="delete_option_btn" name="delete_option_btn" onclick="deleteOptionRow('option_row_<?php echo e($option); ?>')">Delete Option</button>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	var option_group_count = <?php echo e(++$option_group); ?>;
	var option_count = <?php echo e(++$option); ?>;
	
	function addOptionGroup() {
		var option_group = '<div class="option_group" id="option_group_'+option_group_count+'" name="option_group['+option_group_count+']">		<h4 class="h4">Option Group '+option_group_count+' <button type="button" class="btn btn-theme04 float-right" onclick="deleteOptionGroup(\'option_group_'+option_group_count+'\')">Delete Option Group</button></h4>		<div class="form-inline">			<label class="control-label">Option Group Name<label style="font-size: x-small;"> (Max 255 character)</label> </label>			<input type="text" name="option_group['+option_group_count+'][option_group_name]" id="option_group_'+option_group_count+'" class=" form-control m-3" placeholder="i.e. color,size,color and size,etc">		</div>		<div class="from-group">			<label class="control-label"><u>Option Available or the Option Group</u></label>			<button type="button" class="btn btn-primary m-4" id="add_option_btn" name="add_option_btn" onclick="addOption(\'option_group_'+option_group_count+'\','+option_group_count+')">Add Option</button>			<table class="table table-bordered option_group_table" id="option_group_table_'+option_group_count+'">				<thead>					<th>Option</th>					<th>Product Photo</th><th>Number of Items</th>					<th>Delete Action</th>				</thead>				<tbody>										<tr class="option_row" id="option_row_'+option_count+'">						<td><input class="option form-control" type="text" name="option_group['+option_group_count+']['+option_count+'][option_name]" id="option_group_'+option_group_count+'_option_'+option_count+'" >						</td>			<td>							<div class="col-md-4">								<div class="fileupload fileupload-new" data-provides="fileupload">									<div class="fileupload-new thumbnail" style="width: 150px; height: 100px;">										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" name="option_group_'+option_group_count+'_option_'+option_count+'_img" id="option_group_'+option_group_count+'_option_'+option_count+'_img">									</div>									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 20px;"></div>									<div>										<span class="btn btn-theme02 btn-file">											<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>											<input type="file" class="default" accept="image/*" name="option_group['+option_group_count+']['+option_count+'][option_image]" class="option_group_'+option_group_count+'_option_'+option_count+'_input">										</span>										<a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>									</div>								</div>							</div>															</td><td>	<input class="option form-control" type="number" name="option_group['+option_group_count+']['+option_count+'][number_of_items]" id="option_group_'+option_group_count+'_option_'+option_count+'_qty" min="0">	</td>						<td>							<button type="button" class="btn btn-danger" id="delete_option_btn" name="delete_option_btn" onclick="deleteOptionRow(\'option_row_'+option_count+'\')">Delete Option</button>						</td>					</tr>				</tbody>			</table>		</div>	</div>';
		$("div#option_groups_collection").append(option_group);
		option_group_count++;
		option_count++;
	}
	function deleteOptionGroup(option_group_id) {
		var option_group_location = "div#option_groups_collection div#"+option_group_id;
		$(option_group_location).remove();
	}	
	function addOption(option_group_id,current_option_group_count) {
		var new_option = '<tr class="option_row" id="option_row_'+option_count+'">						<td><input class="option form-control" type="text" name="option_group['+current_option_group_count+']['+option_count+'][option_name]" id="option_group_'+current_option_group_count+'_option_'+option_count+'" >						</td>			<td>							<div class="col-md-4">								<div class="fileupload fileupload-new" data-provides="fileupload">									<div class="fileupload-new thumbnail" style="width: 150px; height: 100px;">										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" name="option_group_'+current_option_group_count+'_option_'+option_count+'_img" id="option_group_'+current_option_group_count+'_option_'+option_count+'_img">									</div>									<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 20px;"></div>									<div>										<span class="btn btn-theme02 btn-file">											<span class="fileupload-new"><i class="fa fa-paperclip"></i> Select image</span>											<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>											<input type="file" class="default" accept="image/*" name="option_group['+current_option_group_count+']['+option_count+'][option_image]" class="option_group_'+current_option_group_count+'_option_'+option_count+'_input">										</span>										<a href="advanced_form_components.html#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>									</div>								</div>							</div>															</td><td>	<input class="option form-control" type="number" name="option_group['+current_option_group_count+']['+option_count+'][number_of_items]" id="option_group_'+current_option_group_count+'_option_'+option_count+'_qty" min="0">	</td>						<td>							<button type="button" class="btn btn-danger" id="delete_option_btn" name="delete_option_btn" onclick="deleteOptionRow(\'option_row_'+option_count+'\')">Delete Option</button>						</td>					</tr>';
		$('div#option_groups_collection div.option_group#'+option_group_id+' div table tbody').append(new_option);
		option_count++;
	}
	function deleteOptionRow(option_row_id) {
		var option_row_location = "div#option_groups_collection div div table.option_group_table tr.option_row#"+option_row_id;
		$(option_row_location).remove();
	}

</script>