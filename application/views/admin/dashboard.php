<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Overview</h1>
</div>
<div class="row">
  <?php if($this->session->userdata('role') == 'admins'){ ?>
  <div class="col-xl-3 col-md-6 mb-4">
    <a href="javascript:void(0);">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Products</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_product; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-weight fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
 <?php } ?>
 <div class="col-xl-3 col-md-6 mb-4">
    <a href="javascript:void(0);">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Enquery</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_enquiry; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-car fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
  <?php if($this->session->userdata('role') == 'admins'){ ?>
 <div class="col-xl-3 col-md-6 mb-4">
    <a href="javascript:void(0);">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Current Month Enquery</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $month_enquiry; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-archive fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
 <div class="col-xl-3 col-md-6 mb-4">
    <a href="javascript:void(0);">
      <div class="card border-left-secondary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">Today Enquery</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $today_enquiry; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-box-open fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>  
  <?php } ?>
</div>
