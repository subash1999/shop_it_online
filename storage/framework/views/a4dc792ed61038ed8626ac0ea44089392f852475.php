<div class="form-inline">
	<div class="form-inline">
		<label class="form-control-label" for="phone">Phone : </label>	
		<div class="form-inline">
			<select class="form-control m-3" id="phone_country" name="phone_country">
				<?php echo $__env->make('reuseable_codes/select_country_calling_code_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</select>
			<input id="phone" type="number" maxlength="20" class="form-control" name="phone"  autocomplete="phone"  style="margin-right:15px; " placeholder="phone no..">
		</div>
	</div>
	<div class="form-inline">
		<label class="form-control-label" for="phone">Fax : </label>	
		<div class="form-row form-inline">
			<select class="form-control m-3" id="fax_country" name="fax_country">
				<?php echo $__env->make('reuseable_codes/select_country_calling_code_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</select>
			<input id="fax" type="number" maxlength="20" class="form-control" name="fax"  autocomplete="phone"  style="margin-right:15px; " placeholder="fax no..">
		</div>
	</div>
</div>

<div class="form-inline">
	<div class="form-inline">
		<label class="form-control-label" for="country">Country : </label>	
		<select class="form-control form-row m-3" id="country" name="country">
			<?php echo $__env->make('reuseable_codes/select_country_options', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</select>
	</div>

	<div class="form-inline" style="margin-left: 5px">
		<label class="form-control-label" for="city">City : </label>	
		<input id="city" type="text" maxlength="250" class="form-control m-3" name="city"  autocomplete="address"  style="margin-right:15px; " placeholder="">
	</div>
</div>

<div class="form-inline">
	<div class="form-inline">	
	<label class="form-control-label" for="address">Address : </label>	
	<input id="address" type="text" maxlength="300" class="form-control m-3" name="address"  autocomplete="address"  style="margin-right:15px; margin-top: 5px;" placeholder="">

</div>
	<div class="form-inline" style="margin-left: 5px">
		<label class="form-control-label" for="city">Postal Code : </label>	
		<input id="postal_code" type="text" maxlength="250" class="form-control m-3" name="postal_code"  autocomplete="address"  style="margin-right:15px; margin-top: 5px;" placeholder="">
	</div>
</div>
