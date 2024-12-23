<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($banners && $banners->id)?'Edit Banner':'Add Banner'?><?php echo $breadcrumb;?></h6></div>
      <div class="col-sm-6 text-right">
        <button class="btn btn-sm btn-primary saveButton" type="button">Save</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form class="user" id="manageForm">
    	<div class="row">
				<div class="col-lg-4 col-xl-3">
					<input type="hidden" name="id" value="<?php echo ($banners && $banners->id)?$banners->id:''?>">
					<input type="hidden" name="page_type" value="<?php echo isset($type)?$type:''; ?>">
          			<input type="hidden" name="page_type_id" value="<?php echo isset($type_id)?$type_id:''; ?>">
					<input type="hidden" name="image" value="<?php echo ($banners && $banners->image)?$banners->image:''?>">
					<div class="profile-image img-square">
						<div class="img-container">
							<img src="<?php echo getBannerImage( (($banners && $banners->id)?$banners->id:''),'image');?>" class="upic" alt=""/>
						</div>
						<input type="file" id="images" class="input-file" name="images" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="images" id="upBtn2"><span class="fas fa-camera"></span></label>
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					<div class="row">
						<div class="<?php if(isset($type) && $type == 'pages' && isset($type_id) && $type_id == 4){ echo "col-md-6"; }else{ echo "col-md-12";} ?>">
							<div class="form-group">
								<label class="control-label required">Banner Title</label>
								<input type="text" class="form-control validate" autocomplete="off" name="banner_title" data-validate-msg="Banner Title field is required"  placeholder="Enter Banner Title" value="<?php echo ($banners && $banners->banner_title)?$banners->banner_title:''?>">
							</div>
						</div>
						<?php if(isset($type) && $type == 'pages' && isset($type_id) && $type_id == 4){?>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Button Text</label>
								<input type="text" class="form-control validate" autocomplete="off" name="button_text" data-validate-msg="Button Text field is required"  placeholder="Enter Button Text" value="<?php echo ($banners && $banners->button_text)?$banners->button_text:''?>">
							</div> 
						</div>
					<?php } ?>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Description</label>
								<textarea class="form-control" name="description" rows="5"><?php echo ($banners && $banners->description)?$banners->description:''?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label m-0">Home Banner</label>
								<div class="custom-checkbox m-0">
									<input type="checkbox" class="custom-input singleCheck" id="home_banner" value="1" <?php echo ((isset($banners->home_banner) && $banners->home_banner ==1)?'checked':'');?>>
									<label class="custom-label" for="home_banner"> Set as Home Banner</label>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col text-right">
							<button class="btn btn-sm btn-primary saveButton" type="button">Save</button>
						</div>
					</div>
				</div>
			</div>
    </form>
  </div>
</div>