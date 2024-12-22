<div class="card shadow mb-4">
  <div class="card-header py-3 forms">
    <div class="row">
      <div class="col-sm-6 d-flex">
      	<h6 class="title my-auto"><?php echo ($settings_info && $settings_info->id)?'Edit Settings':'Add Settings'?></h6>
      </div>
      <div class="col-sm-6 text-right">
        <button class="btn btn-sm btn-primary saveButton" type="button">Save</button>
        <button class="btn btn-sm btn-danger cancelButton" type="button">Cancel</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form class="user" id="manageForm">
    	<div class="row">
				<!-- <div class="col-md-6 col-lg-4 col-xl-3">
					<input type="hidden" name="logo" value="<?php echo ($settings_info && $settings_info->logo)?$settings_info->logo:''?>">
					<div class="profile-image img-square">
						<div class="img-container">
							<img src="<?php echo postFileExists( (($settings_info && $settings_info->logo)?$settings_info->logo:''),(($settings_info && $settings_info->logo)?$settings_info->logo:'') );?>" class="upic" alt=""/>
						</div>
						<input type="file" id="image" class="input-file" name="logo" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="image" id="upBtn2"><span class="fas fa-camera"></span></label>
					</div>
				</div> -->
				<div class="col-md-12 col-lg-8 col-xl-12">
					<input type="hidden" name="id" value="<?php echo ($settings_info && $settings_info->id)?$settings_info->id:''?>">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Title</label>
								<input type="text" class="form-control validate" autocomplete="off" name="title" data-validate-msg="Title field is required"  placeholder="Enter Title" value="<?php echo ($settings_info && $settings_info->title)?$settings_info->title:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Contact Email</label>
								<input type="text" class="form-control validate" autocomplete="off" name="contact_email" data-validate-msg="Contact Email field is required"  placeholder="Enter Contact Email" value="<?php echo ($settings_info && $settings_info->contact_email)?$settings_info->contact_email:''?>">
							</div> 
						</div>						
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Career Email</label>
								<input type="text" class="form-control validate" autocomplete="off" name="career_email" data-validate-msg="Career Email field is required"  placeholder="Enter Career Email" value="<?php echo ($settings_info && $settings_info->career_email)?$settings_info->career_email:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Business Email</label>
								<input type="text" class="form-control validate" autocomplete="off" name="business_email" data-validate-msg="Business Email field is required"  placeholder="Enter Business Email" value="<?php echo ($settings_info && $settings_info->business_email)?$settings_info->business_email:''?>">
							</div> 
						</div> -->
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Phone</label>
								<input type="text" class="form-control validate" autocomplete="off" name="phone" data-validate-msg="Phone field is required"  placeholder="Enter Phone" value="<?php echo ($settings_info && $settings_info->phone)?$settings_info->phone:''?>">
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Facebook Link</label>
								<input type="text" class="form-control validate" autocomplete="off" name="facebook_link" data-validate-msg="Facebook Link field is required"  placeholder="Enter Facebook Link" value="<?php echo ($settings_info && $settings_info->facebook_link)?$settings_info->facebook_link:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Twitter Link</label>
								<input type="text" class="form-control validate" autocomplete="off" name="twitter_link" data-validate-msg="Twitter Link field is required"  placeholder="Enter Twitter Link" value="<?php echo ($settings_info && $settings_info->twitter_link)?$settings_info->twitter_link:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Instagram Link</label>
								<input type="text" class="form-control validate" autocomplete="off" name="instagram_link" data-validate-msg="Instagram Link field is required"  placeholder="Enter Instagram Link" value="<?php echo ($settings_info && $settings_info->instagram_link)?$settings_info->instagram_link:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Youtube Link</label>
								<input type="text" class="form-control validate" autocomplete="off" name="youtube_link" data-validate-msg="Youtube Link field is required"  placeholder="Enter Youtube Link" value="<?php echo ($settings_info && $settings_info->youtube_link)?$settings_info->youtube_link:''?>">
							</div> 
						</div>
						<!-- <div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Behance Link</label>
								<input type="text" class="form-control validate" autocomplete="off" name="behance_link" data-validate-msg="Behance Link field is required"  placeholder="Enter Behance Link" value="<?php echo ($settings_info && $settings_info->behance_link)?$settings_info->behance_link:''?>">
							</div> 
						</div> -->
					</div>
                     <div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Copyright</label>
								<input type="text" class="form-control validate" autocomplete="off" name="copyright" data-validate-msg="Copyright field is required"  placeholder="Enter Copyright" value="<?php echo ($settings_info && $settings_info->copyright)?$settings_info->copyright:''?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Address</label>
								<input type="text" class="form-control validate" autocomplete="off" name="address" data-validate-msg="Address field is required"  placeholder="Enter Address" value="<?php echo ($settings_info && $settings_info->address)?$settings_info->address:''?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control tinymce" name="description" rows="3"><?php echo ($settings_info && $settings_info->description)?$settings_info->description:''?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col text-right">
						<button class="btn btn-primary saveButton" type="button">Save</button>
						<button class="btn btn-danger cancelButton" type="button">Cancel</button>
						</div>
					</div>
				</div>
			</div>
    </form>
  </div>
</div>