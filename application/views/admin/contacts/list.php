<div class="card shadow mb-4">
	<div class="card-header py-3 forms">
		<div class="row form-row mb-2">
			<div class="col-sm-6 d-flex">
				<h6 class="title my-auto">Contact & Enquiry list</h6>
			</div>
			<div class="col-sm-6 text-right">
				<?php if(getUserDetails($this->session->userdata('user_id'),'role_manage') && in_array('delete-contact', getUserDetails($this->session->userdata('user_id'),'role_manage'))){?>
				<a href="javascript:void(0)" class="btn btn-sm btn-danger" onclick="deleteContact('all')" data-tooltip="Delete"><i class="fa fa-trash"></i></a>
				<?php } ?>
				<a href="javascript:void(0)" onclick="resetSearch()" class="btn btn-sm btn-primary" data-tooltip="Reset"><i class="fa fa-sync"></i></a>
			</div>
		</div>
		<div class="row form-row mb-2">
			<input type="hidden" id="sortByField" value="">
			<input type="hidden" id="sortBy" value="">
			<div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
				<div class="form-group">
					<select class="form-control select2-nosearch" id="perPage" onchange="searchFilter()">
						<option value="5">5 Per Page</option>
						<option value="10" selected>10 Per Page</option>
						<option value="20">20 Per Page</option>
						<option value="50">50 Per Page</option>
						<option value="100">100 Per Page</option>
						<option value="10000000000">All</option>
					</select>
				</div>
			</div>
			<div class="col-sm-8 col-md-9 col-lg-4 col-xl-3 offset-xl-1">
				<div class="form-group">
					<input type="text" class="form-control" id="keyword" placeholder="Search" onkeyup="searchFilter()" />
				</div>
			</div>
			<div class="col-sm-4 col-md-3 col-lg-2 col-xl-2">
				<div class="form-group">
					<select class="form-control select2-nosearch" id="type" onchange="searchFilter()">
						<option value="">Select Type</option>
						<option value="1">Contact</option>
						<option value="2">Enquiry</option>
					</select>
				</div>
			</div>
			<div class="col-sm-8 col-md-9 col-lg-6 col-xl-4">
				<div class="form-group">
					<input type="text"  name="startEnd" id="startEnd" placeholder="Created At" class="form-control" readonly/>
				</div>
			</div>

		</div>
	</div>
	<div class="card-body">
		<div class="table-wrap">
			<div class="preloader">
				<?php $this->load->view('admin/common/default/loader');?>
			</div>
			<div class="table-responsive scrollTop">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="50">
								<div class="custom-checkbox">
										<input type="checkbox" class="custom-input checkAll" id="customCheckcheckAll">
										<label class="custom-label" for="customCheckcheckAll"></label>
									</div>
							</th>
							<th>
								<a href="javascript:void(0)" class="sorting name" onclick="sortBy('name','contacts.name','ASC')">
									<span class="title"> Info</span>
									<span class="sorting-icon">
										<i class="fas fa-sort-up commonSorting name_DESC"></i>
										<i class="fas fa-sort-down commonSorting name_ASC"></i>
									</span>
								</a>
							</th>
							<th>Type</th>
							<!-- <th>
								<a href="javascript:void(0)" class="sorting email" onclick="sortBy('email','contacts.email','ASC')">
									<span class="title"> Email</span>
									<span class="sorting-icon">
										<i class="fas fa-sort-up commonSorting email_DESC"></i>
										<i class="fas fa-sort-down commonSorting email_ASC"></i>
									</span>
								</a>
							</th>
							<th>Phone</th> -->	
							<th>Product</th>								
							<th>Message</th>
							<th>
								<a href="javascript:void(0)" class="sorting created_at" onclick="sortBy('created_at','pages.created_at','ASC')">
									<span class="title">Date</span>
									<span class="sorting-icon">
										<i class="fas fa-sort-up commonSorting created_at_DESC"></i>
										<i class="fas fa-sort-down commonSorting created_at_ASC"></i>
									</span>
								</a>
							</th>
							
						</tr>
					</thead>
					<tbody id="contactsList">
						<tr><td colspan="15" align="center">Searching Datas</td></tr>
					</tbody>
				</table>
			</div>
			<div class="row" id="paginationDiv"></div>
		</div>
	</div>
</div>