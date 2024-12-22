<?php if($pages){ foreach($pages as $key=>$val){?>
	<tr>
		<?php if($val->is_delete == 1){ ?>
		<td>
			<div class="custom-checkbox">
					<input type="checkbox" class="custom-input singleCheck" id="customCheck<?php echo $val->id;?>" value="<?php echo $val->id;?>">
					<label class="custom-label" for="customCheck<?php echo $val->id;?>"></label>
				</div>
		</td>	
		<?php }else{ ?>
		<td></td>
		<?php } ?>
		<?php if( getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('edit-page', getUserDetails($this->session->userdata('user_id'),'role_manage')) && $val->type == 1){?>

			<td><a href="<?php echo base_url()?>admin/edit-page/<?php echo $val->slug;?>" target="_blank"><?php echo $val->title;?></a></td>
			<td><a href="<?php echo base_url()?>admin/edit-page/<?php echo $val->slug;?>" target="_blank"><?php echo date('d M, Y',strtotime($val->created_at));?></a></td>
		<?php } else { ?>
			<td><?php echo $val->title;?></td>
			<td><?php echo date('d M, Y',strtotime($val->created_at));?></td>
		<?php } ?>
        <td>
			<div class="dropdown">
				<button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">Action</button>
				<div class="dropdown-menu dropdown-menu-right">
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('edit-page', getUserDetails($this->session->userdata('user_id'),'role_manage'))){
						if($val->type == 1){
						?>
					<a class="dropdown-item" href="<?php echo base_url()?>admin/edit-page/<?php echo $val->slug;?>"><i class="fas fa-fw fa-edit"></i> Edit</a>
					<?php } }  ?>
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('seo', getUserDetails($this->session->userdata('user_id'),'role_manage'))){ ?>
						<a class="dropdown-item" href="<?php echo base_url()?>admin/seo/<?php echo $val->page_type;?>/<?php echo $val->id;?>" target="_blank"><i class="fab fa-fw fa-amazon"></i> Seo</a> 
					<?php } ?>
					<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('banners', getUserDetails($this->session->userdata('user_id'),'role_manage'))){ ?>
					<a class="dropdown-item" href="<?php echo base_url()?>admin/banners/<?php echo $val->page_type;?>/<?php echo $val->id;?>" target="_blank"><i class="fas fa-fw fa-image"></i> Banner</a>
				<?php } ?>
				<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('delete-page', getUserDetails($this->session->userdata('user_id'),'role_manage'))){
					if($val->is_delete == 1){
					?>
					<a class="dropdown-item" href="javascript:void(0)" onclick="deletePage(<?php echo $val->id;?>)"><i class="fas fa-fw fa-trash"></i> Delete</a>
					<?php } } ?>
				</div>
			</div>
		</td>
	</tr>
<?php } } else { ?>
	<tr><td colspan="15" align="center">No Pages Found!</td>
	</tr>
<?php } ?>