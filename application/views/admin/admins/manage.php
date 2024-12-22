<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($admins && $admins->id)?'Edit Admin':'Add Admin'?></h6></div>
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
					<input type="hidden" name="id" value="<?php echo ($admins && $admins->id)?$admins->id:''?>">
					<input type="hidden" name="usertype" value="<?php echo ($admins && $admins->usertype)?$admins->usertype:'admins'?>">
					<input type="hidden" name="profile" value="<?php echo ($admins && $admins->profile)?$admins->profile:''?>">
					<div class="profile-image">
						<div class="img-container">
							<img src="<?php echo getUserDetails( (($admins && $admins->id)?$admins->id:''),'profile');?>" class="upic" alt=""/>
						</div>
						<input type="file" id="image" class="input-file" name="image" data-multiple-caption="{count} files selected" onchange="readURL(this)" />
						<label class="btn-file" for="image" id="upBtn2"><span class="fas fa-camera"></span></label>
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">First Name</label>
								<input type="text" class="form-control validate" id="firstname" name="firstname" data-validate-msg="First Name field is required"  placeholder="Enter First Name" value="<?php echo ($admins && $admins->firstname)?$admins->firstname:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Last Name</label>
								<input type="text" class="form-control validate"  id="lastname" name="lastname" data-validate-msg="Last Name field is required"  placeholder="Enter Last Name" value="<?php echo ($admins && $admins->lastname)?$admins->lastname:''?>">
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Email Address</label>
								<input type="text" class="form-control validate" id="email" name="email" data-validate-msg="Email field is required"  placeholder="Enter Email Address" value="<?php echo ($admins && $admins->email)?$admins->email:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Password</label>
								<input type="password" class="form-control <?php echo ($admins && $admins->password)?'':'validate'?>" name="password" id="password" data-validate-msg="Password field is required"  placeholder="Enter Password" >
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" class="form-control validate number" autocomplete="off" name="phone" data-validate-msg="Phone field is required"  placeholder="Enter Phone" value="<?php echo ($admins && $admins->phone)?$admins->phone:''?>">
							</div>
						</div>
					</div>
					<!-- <div class="row">
						<div class="col">
							<div class="permission-management-title">Admin Type</div>
							<div class="permission-management">
								<div class="permission-item">
									<div class="item-header">
										<div class="custom-checkbox">
											<input name="demo_admin" type="checkbox" <?php echo ($admins && $admins->demo_admin == 1)?'checked':''?> class="custom-input" value="1">
											<label class="custom-label">Demo Admin</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div> -->
					
					<!-- <?php 
						$role_data = array();
						if(isset($admins->role_manage) && !empty($admins->role_manage)){
							$role_data = json_decode($admins->role_manage);
						}
					?>

					<div class="row">
						<div class="col">
							<div class="permission-management-title">Permissions Management</div>
							<div class="permission-management">
								<?php if($role_manage){ foreach ($role_manage as $value) { 
									if($value['parent_id'] == 0){
								?>
								<div class="permission-item">
									<div class="item-header">
										<?php if($value['codes'] == 'dashboard'){ ?>
											<div class="custom-checkbox">
											<input name="role_parent[]" type="checkbox" class="custom-input" checked disabled="" value="<?php echo $value['codes']; ?>">
											<label class="custom-label"><?php echo $value['name']; ?></label>
										</div>
										<?php }else{ ?>
										<div class="custom-checkbox">
											<input name="role_parent[]" type="checkbox" class="custom-input p_class parent_class_<?php echo $value['id']; ?>" value="<?php echo $value['codes']; ?>" <?php if(isset($admins->role_manage) && in_array($value['codes'], $role_data)){echo 'checked';}?> parent_value="<?php echo $value['id']; ?>">
											<label class="custom-label"><?php echo $value['name']; ?></label>
										</div>
										<?php if(count($value['sub']) > 0){?>
										<a href="javascript:void(0)" class="btn-trigger"><i class="far fa-fw fa-angle-down"></i></a>
									<?php } } ?>
									</div>
									<div class="item-body">
										<?php if(count($value['sub']) > 0){?>
										<ul class="permission-list">
											<?php foreach($value['sub'] as $subs){?>
											<li>
												<div class="custom-checkbox">
													<input name="role_sub[]" type="checkbox" class="custom-input sub_class" value="<?php echo $subs['codes']; ?>" <?php if(isset($admins->role_manage) && in_array($subs['codes'], $role_data)){echo 'checked';}?> parent_val="<?php echo $subs['parent_id']; ?>">
													<label class="custom-label"><?php echo $subs['name']; ?></label>
												</div>
											</li>
											<?php } ?>
										</ul>
									<?php } ?>
									</div>
								</div>
							<?php } } } ?>
							</div>
						</div>
					</div> -->
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