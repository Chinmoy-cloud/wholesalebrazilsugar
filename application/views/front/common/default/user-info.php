<?php 
$vehicle_details = $this->db->get_where('vehicles',array('id'=>$this->session->userdata('vehicle_id')))->row();
$vehicle_owner = $this->db->get_where('user',array('id'=>$vehicle_details->vehicle_owner_id))->row();
?>
<div class="card">
  <div class="card-body">
    <div class="d-flex flex-column align-items-center text-center">
      <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
      <div class="mt-3">
        <h4><?php echo $vehicle_details->driver_name; ?></h4>
        <p class="text-secondary mb-1"><?php echo $vehicle_details->vehicle_no; ?></p>
        <p class="text-muted font-size-sm">Owner : <?php echo $vehicle_owner->name; ?></p>
      </div>
    </div>
  </div>
</div>
<div class="card mt-3">
  <ul class="list-group list-group-flush">
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap <?php echo ($this->uri->segment(1) == 'profile')?'active':''?>">
      <a href="<?php echo base_url(); ?>profile">
        <h6 class="mb-0"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i> Profile</h6>
      </a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap <?php echo ($this->uri->segment(1) == 'trip')?'active':''?>">
      <a href="<?php echo base_url(); ?>trip">
        <h6 class="mb-0"><i class="fas fa-truck fa-sm fa-fw mr-2 text-gray-400"></i> Trip</h6>
      </a>
    </li>
    <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
      <a href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">        
        <h6 class="mb-0"><i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout</h6>
      </a>
    </li>
  </ul>
</div>