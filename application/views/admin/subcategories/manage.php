<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($subcategories && $subcategories->id)?'Edit Sub Category':'Add Sub Category'?></h6></div>
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
					<input type="hidden" name="id" value="<?php echo ($subcategories && $subcategories->id)?$subcategories->id:''?>">
					<input type="hidden" name="category_type" value="<?php echo ($subcategories && $subcategories->category_type)?$subcategories->category_type:'sub'?>">
					<input type="hidden" name="logo" value="<?php echo ($subcategories && $subcategories->logo)?$subcategories->logo:''?>">
					<div class="profile-image img-square">
						<div class="img-container">
							<img src="<?php echo getCatImage((($subcategories && $subcategories->id)?$subcategories->id:''),'logo');?>" class="upic" alt=""/>
						</div>
						<input type="file" id="image" class="input-file" name="image" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="image" id="upBtn2"><span class="fas fa-camera"></span></label>
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Sub-Category Name</label>
								<input type="text" class="form-control validate" autocomplete="off" name="name" id="name" data-validate-msg="Sub Category Name field is required"  placeholder="Enter Sub Category Name" value="<?php echo ($subcategories && $subcategories->name)?$subcategories->name:''?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Alias</label>
								<input type="text" class="form-control validate" autocomplete="off" name="alias" id="alias" data-validate-msg="Alias field is required"  placeholder="Enter Alias" value="<?php echo ($subcategories && $subcategories->alias)?$subcategories->alias:''?>">
							</div> 
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Main Category</label>
								<select name="rootcategoryid" class="form-control select2 validate" data-validate-msg="Category field is required">
									<option value=""  selected> Select Main Category </option>
									<?php if($main_cat){ foreach ($main_cat as $value) { ?>
									<option value="<?php echo $value->id; ?>" <?php if(isset($subcategories->rootcategoryid) && $subcategories->rootcategoryid == $value->id){ echo "selected";} ?>><?php echo $value->name; ?></option>
									<?php } } ?>             
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label ">Description</label>
								<textarea class="form-control tinymce" id="description"  name="description" rows="5"><?php echo ($subcategories && $subcategories->description)?$subcategories->description:''?></textarea>
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