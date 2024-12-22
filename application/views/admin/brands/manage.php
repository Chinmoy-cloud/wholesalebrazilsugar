<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($users && $users->id)?'Edit Department':'Add Department'?></h6></div>
      <div class="col-sm-6 text-right">
        <button class="btn btn-sm btn-primary saveButton" type="button">Save</button>
        <button class="btn btn-sm btn-danger cancelButton" type="button">Cancel</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form class="user" id="manageForm">
    	<div class="row">
				<div class="col-lg-4 col-xl-3">
					<input type="hidden" name="id" value="<?php echo ($users && $users->id)?$users->id:''?>">
					<input type="hidden" name="image" value="<?php echo ($users && $users->image)?$users->image:''?>">
					<div class="profile-image">
						<div class="img-container">
							<img src="<?php echo getBrandDetails( (($users && $users->id)?$users->id:''),'image');?>" class="upic" alt=""/>
						</div>
						<input type="file" id="image" class="input-file" name="image" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="image" id="upBtn2"><span class="fas fa-camera"></span></label>
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Name</label>
								<input type="text" class="form-control validate" autocomplete="off" id="name" name="name" data-validate-msg="Name field is required"  placeholder="Enter Name" value="<?php echo ($users && $users->name)?$users->name:''?>">
							</div>
						</div>
						
					</div>
					<!-- <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Icon</label>
								<input type="text" class="form-control validate" autocomplete="off" id="icon" name="icon" data-validate-msg="Icon field is required"  placeholder="Enter Icon" value="<?php echo ($users && $users->icon)?$users->icon:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Tab Icon</label>
								<input type="text" class="form-control validate" autocomplete="off" id="tab_icon" name="tab_icon" data-validate-msg="Tab icon field is required"  placeholder="Enter Tab Icon" value="<?php echo ($users && $users->tab_icon)?$users->tab_icon:''?>">
							</div>
						</div>											
					</div> -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control tinymce" autocomplete="off" name="description" data-validate-msg="Description field is required"  placeholder="Enter Description"><?php echo ($users && $users->description)?$users->description:''?></textarea>
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