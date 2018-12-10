<div class="form-group">
	<label class="form-control-label" for="name">Your Company Name : </label>	
	<input id="company_name" type="text" maxlength="500" class="form-control" name="company_name"  autocomplete="name"  style="margin-right:15px; margin-top: 5px;" placeholder="eg: microsoft, amazon, etc">
</div>
<div class="form-group">
	<label class="form-control-label">Cover Photo Of Company : </label>
	<img id="your_cover_view" name="your_cover_view" class="img-thumbnail form-control rounded" src="{{ asset('img/system/upload_cover_pic.png') }}" alt="profile picture placeholder"  class="img-fluid rounded-circle m-3" style="cursor: pointer; height: 300px;" required="required" width="100%" >
	<div class="btn upload_btn" style="cursor: pointer;">
		<button class="btn btn-info">Upload Cover Pic</button>
		<input type="file" class="photo_upload_input" name="your_cover_input" id="your_cover_input" onchange="viewCover(this);" accept="image/*">	
	</div>	
</div>
<div class="form-group">
	<label class="form-control-label">Your Goverment's Certificate of Verification of Company : </label>
	<div class="form-group form-">
	<img id="your_certificate_view" name="your_certificate_view" class="img-thumbnail form-control rounded" src="{{ asset('img/system/upload_cover_pic.png') }}" alt="profile picture placeholder"  class="img-fluid rounded-circle m-3" style="cursor: pointer; height: 200px; width: 80%;" required="required"  >
	<div class="btn upload_btn" style="cursor: pointer;">
		<button class="btn btn-info">Upload Certificate</button>
		<input type="file" class="photo_upload_input" id="your_certificate_input" name="your_certificate_input" onchange="viewCertificate(this);" accept="image/*">	
	</div>
	</div>	
</div>

<div class="form-group">
	<label class="form-control-label">Location Of Company : </label>	
	<div id="google_map" name="google_map"></div>
</div>