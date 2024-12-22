<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="row">
      <div class="col-sm-6 d-flex"><h6 class="title my-auto"><?php echo ($users && $users->id)?'Edit Employee':'Add Employee'?></h6></div>
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
					<input type="hidden" name="usertype" value="<?php echo ($users && $users->usertype)?$users->usertype:'employee'?>">
					<input type="hidden" name="profile" value="<?php echo ($users && $users->profile)?$users->profile:''?>">
					<div class="profile-image">
						<div class="img-container">
							<img src="<?php echo getUserDetails( (($users && $users->id)?$users->id:''),'profile');?>" class="upic" alt=""/>
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
								<input type="text" class="form-control validate" autocomplete="off" id="firstname" name="firstname" data-validate-msg="First Name field is required"  placeholder="Enter First Name" value="<?php echo ($users && $users->firstname)?$users->firstname:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Last Name</label>
								<input type="text" class="form-control validate" autocomplete="off" id="lastname" name="lastname" data-validate-msg="Last Name field is required"  placeholder="Enter Last Name" value="<?php echo ($users && $users->lastname)?$users->lastname:''?>">
							</div> 
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Email Address</label>
								<input type="text" class="form-control validate" autocomplete="off" id="email" name="email" data-validate-msg="Email field is required"  placeholder="Enter Email Address" value="<?php echo ($users && $users->email)?$users->email:''?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label required">Password</label>
								<input type="password" class="form-control <?php echo ($users && $users->password)?'':'validate'?>" id="password" autocomplete="off" name="password" data-validate-msg="Password field is required"  placeholder="Enter Password" value="">
							</div> 
						</div>						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Phone</label>
								<input type="text" class="form-control validate number" autocomplete="off" name="phone" data-validate-msg="Phone field is required"  placeholder="Enter Phone" value="<?php echo ($users && $users->phone)?$users->phone:''?>">
							</div>
						</div>
					</div>
					<?php 
						$role_data = array();
						if(isset($users->role_manage) && !empty($users->role_manage)){
							$role_data = json_decode($users->role_manage);
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
											<input name="role_parent[]" type="checkbox" class="custom-input p_class parent_class_<?php echo $value['id']; ?>" value="<?php echo $value['codes']; ?>" <?php if(isset($users->role_manage) && in_array($value['codes'], $role_data)){echo 'checked';}?> parent_value="<?php echo $value['id']; ?>">
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
													<input name="role_sub[]" type="checkbox" class="custom-input sub_class" value="<?php echo $subs['codes']; ?>" <?php if(isset($users->role_manage) && in_array($subs['codes'], $role_data)){echo 'checked';}?> parent_val="<?php echo $subs['parent_id']; ?>">
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