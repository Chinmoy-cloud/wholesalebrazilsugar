<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($products && $products->id)?'Edit Product':'Add Product'?></h6></div>
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
					<input type="hidden" name="id" value="<?php echo ($products && $products->id)?$products->id:''?>">
					<input type="hidden" name="logo" value="<?php echo ($products && $products->logo)?$products->logo:''?>">
					<div class="profile-image img-square">
						<div class="img-container">
							<img src="<?php echo getProductImage( (($products && $products->id)?$products->id:''),'logo');?>" class="upic" alt=""/>
						</div>
						<input type="file" id="image" class="input-file" name="image" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="image" id="upBtn"><span class="fas fa-camera"></span></label>
						<div class="note text-center">Minimum Dimension (350 x 250)</div>
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Title</label>
								<input type="text" class="form-control validate" autocomplete="off" id="title" name="title" data-validate-msg="Title field is required"  placeholder="Enter Title" value="<?php echo ($products && $products->title)?$products->title:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Alias</label>
								<input type="text" id="slug" class="form-control validate" id="alias" autocomplete="off" name="alias" data-validate-msg="Alias field is required"  placeholder="Enter Alias" value="<?php echo ($products && $products->alias)?$products->alias:''?>">
							</div> 
						</div>
					</div>
					<!-- <div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Brand</label>
								<select class="form-control select2" id="brand_id" name="brand_id">
									<option value="">Select Brand</option>
									<?php 
						    		if($brands && count($brands)>0){
						    			foreach ($brands as $key => $val) {
						    		?>
						    		<option value="<?php echo $val->id; ?>" <?php if(isset($products->brand_id) && $products->brand_id == $val->id){?> selected="selected" <?php }?> ><?php echo $val->name; ?></option>
						    		<?php } } ?>
								</select>								
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Price</label>
								<input type="text" class="form-control validate number" autocomplete="off" id="price" name="price" data-validate-msg="Price field is required"  placeholder="Enter Price" value="<?php echo ($products && $products->price)?$products->price:''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Sale Price</label>
								<input type="text" class="form-control validate number" autocomplete="off" id="sale_price" name="sale_price" data-validate-msg="Sale Price field is required"  placeholder="Enter Sale Price" value="<?php echo ($products && $products->sale_price)?$products->sale_price:''?>">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Horspower</label>
								<input type="text" class="form-control validate" autocomplete="off" id="horspower" name="horspower" data-validate-msg="Horspower field is required"  placeholder="Enter Horspower" value="<?php echo ($products && $products->horspower)?$products->horspower:''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Weight</label>
								<input type="text" class="form-control validate" autocomplete="off" id="weight" name="weight" data-validate-msg="Weight field is required"  placeholder="Enter Weight" value="<?php echo ($products && $products->weight)?$products->weight:''?>">
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label required">Shaft Length</label>
								<input type="text" class="form-control validate" autocomplete="off" id="shaft_length" name="shaft_length" data-validate-msg="Shaft Length field is required"  placeholder="Enter Shaft Length" value="<?php echo ($products && $products->shaft_length)?$products->shaft_length:''?>">
							</div>
						</div>
					</div> -->
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Short Description</label>
								<textarea class="form-control" id="short_description" name="short_description" rows="5" placeholder="Enter Short Description"><?php echo ($products && $products->short_description)?$products->short_description:''?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Description</label>
								<textarea class="form-control tinymce" id="description" name="description" rows="5" ><?php echo ($products && $products->description)?$products->description:''?></textarea>
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