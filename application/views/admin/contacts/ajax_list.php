<?php if($contacts){ foreach($contacts as $key=>$val){?>
	<tr>
		<td>
			<div class="custom-checkbox">
				<input type="checkbox" class="custom-input singleCheck" id="customCheck<?php echo $val->id;?>" value="<?php echo $val->id;?>">
				<label class="custom-label" for="customCheck<?php echo $val->id;?>"></label>
			</div>
		</td>
		<td>
			<strong>Name:</strong> <?php echo !empty($val->name)?$val->name:'';?></br>
			<strong>Email:</strong> <?php echo $val->email;?></br>
			<strong>Phone:</strong> <?php echo $val->phone;?></br>
		</td>
		<td id="status_td_<?php echo $val->id;?>"><?php echo ($val->type == 1)?'<span class="btn btn-xs btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Contact</span></span>':'<span class="btn btn-xs btn-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Enquiry</span></span>';?></td>
		<td><?php echo $val->product_name;?></td>
		<td><?php echo $val->message;?></td>		
		<td><?php echo date('d M, Y',strtotime($val->created_at));?></td>
		
        <!-- <td>
			<div class="dropdown">
				<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">Action</button>
				<div class="dropdown-menu dropdown-menu-right">
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('change-status-contact', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>
					<a class="dropdown-item" href="javascript:void(0)" onclick="statusChange(<?php echo $val->id;?>,<?php echo ($val->status == 1)?2:1;?>)" id="status_a_<?php echo $val->id;?>"><?php echo ($val->status == 1)?'<i class="fas fa-fw fa-times-circle"></i>  Unseen':'<i class="fas fa-fw fa-check-circle"></i>  Seen';?></a>
					<?php } ?>
				    <?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('delete-contact', getUserDetails($this->session->userdata('user_id'),'role_manage'))){
					?>
					<a class="dropdown-item" href="javascript:void(0)" onclick="deleteContact(<?php echo $val->id;?>)"><i class="fas fa-fw fa-trash"></i> Delete</a>
					<?php } ?>
				</div>
			</div>
		</td> -->
	</tr>
<?php } } else { ?>
	<tr><td colspan="15" align="center">No Data Found!</td>
	</tr>
<?php } ?>