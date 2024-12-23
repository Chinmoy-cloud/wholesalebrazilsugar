<?php if($brands){ foreach($brands as $key=>$val){?>
	<tr>
		<td>
			<div class="custom-checkbox">
					<input type="checkbox" class="custom-input singleCheck" id="customCheck<?php echo $val->id;?>" value="<?php echo $val->id;?>">
					<label class="custom-label" for="customCheck<?php echo $val->id;?>"></label>
				</div>
		</td>
		<td width="100"><div class="img-container"><a href="<?php echo getBrandDetails($val->id,'image');?>" class="d-block w-100 h-100" data-fancybox=""><img src="<?php echo getBrandDetails($val->id,'image');?>" alt=""/></a></div></td>
		<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('edit-user', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>

			<td><a href="<?php echo base_url()?>admin/edit-user/<?php echo $val->id;?>" target="_blank"><?php echo $val->name;?></a></td>
			<td><a href="<?php echo base_url()?>admin/edit-user/<?php echo $val->id;?>" target="_blank"><?php echo $val->email;?></a>
				<td><a href="<?php echo base_url()?>admin/edit-user/<?php echo $val->id;?>" target="_blank"><?php echo date('d M, Y',strtotime($val->created_date));?></a></td>
        </td>

		<?php } else { ?>
			<td><?php echo $val->name;?></td>
			<!-- <td><?php echo $val->icon;?></td> -->
            <td><?php echo date('d M, Y',strtotime($val->created_date));?></td>
		<?php } ?>

		
		<td id="status_td_<?php echo $val->id;?>"><?php echo ($val->status == 1)?'<span class="btn btn-xs btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Active</span></span>':'<span class="btn btn-xs btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Inactive</span></span>';?></td>
		<td>

			<div class="dropdown">
				<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">Action</button>
				<div class="dropdown-menu dropdown-menu-right">
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('edit-brand', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>
					<a class="dropdown-item" href="<?php echo base_url()?>admin/edit-brand/<?php echo $val->id;?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
					<?php } ?>
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('change-status-brand', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>
					<a class="dropdown-item" href="javascript:void(0)" onclick="statusChange(<?php echo $val->id;?>,<?php echo ($val->status == 1)?2:1;?>)" id="status_a_<?php echo $val->id;?>"><?php echo ($val->status == 1)?'<i class="fas fa-fw fa-times-circle"></i>  Deactivate':'<i class="fas fa-fw fa-check-circle"></i>  Activate';?></a>
					<?php } ?>
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('delete-brand', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>
					<a class="dropdown-item" href="javascript:void(0)" onclick="deleteUser(<?php echo $val->id;?>)"><i class="fas fa-fw fa-trash"></i> Delete</a>
					<?php } ?>
				</div>
			</div>

		</td>
	</tr>
<?php } } else { ?>
	<tr>
		<td colspan="15" align="center">No Department's Found!</td>
	</tr>
<?php } ?>
		