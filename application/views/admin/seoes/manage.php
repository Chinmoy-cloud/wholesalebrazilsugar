<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($seoes && $seoes->id)?'Edit Seo':'Add Seo'?><?php echo $breadcrumb;?></h6></div>
      <div class="col-sm-6 text-right">
        <button class="btn btn-sm btn-primary saveButton" type="button">Save</button>
      </div>
    </div>
  </div>
  <div class="card-body">
    <form class="user" id="manageForm">
    	<div class="row">
					<input type="hidden" name="id" value="<?php echo ($seoes && $seoes->id)?$seoes->id:''?>">
          <input type="hidden" name="type" value="<?php echo isset($type)?$type:''; ?>">
          <input type="hidden" name="type_id" value="<?php echo isset($type_id)?$type_id:''; ?>">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label required">Title</label>
								<input type="text" class="form-control validate" autocomplete="off" name="seo_title" data-validate-msg="Title field is required"  placeholder="Enter SEO Title" value="<?php echo ($seoes && $seoes->seo_title)?$seoes->seo_title:''?>">
							</div>
						</div>
					</div>
          <div class="row">
           	<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Tags</label>
								<input type="text" class="form-control validate" autocomplete="off" name="tags" data-validate-msg="Tag field is required"  placeholder="Enter Tags" value="<?php echo ($seoes && $seoes->tags)?$seoes->tags:''?>">
							</div> 
						</div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label required">Author</label>
                <input type="text" class="form-control validate" autocomplete="off" name="author" data-validate-msg="Author field is required"  placeholder="Enter Author" value="<?php echo ($seoes && $seoes->tags)?$seoes->tags:''?>">
              </div> 
            </div>
          </div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea class="form-control" name="description" rows="5"><?php echo ($seoes && $seoes->description)?$seoes->description:''?></textarea>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col text-right">
							<button class="btn btn-primary saveButton" type="button">Save</button>
						</div>
					</div>
				</div>
			</div>
    </form>
  </div>
</div>