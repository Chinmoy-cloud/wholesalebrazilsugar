 <!-- Fruits Shop Start-->
 <?php $allProducts = getFeaturedProduct(); ?>
<div class="container-fluid fruite py-5">
    <div class="container py-5">
        <div class="tab-class text-center">
            <div class="row g-4">
                <div class="col-lg-12 text-center mb-5">
                    <h1>Check Out Our Products</h1>
                </div>
            </div>
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        <div class="col-lg-12">
                            <div class="row g-4">
                                <?php
                                if ($allProducts && count($allProducts) > 0) {
                                    foreach ($allProducts as $key2 => $val) {
                                ?>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="rounded position-relative fruite-item">
                                        <div class="fruite-img">
                                            <?php if (file_exists($val->logo)) { ?>
                                                <img src="<?php echo base_url() . $val->logo; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            <?php } else { ?>
                                                <img src="<?php echo base_url(); ?>assets/admin/img/no-image.jpg" class="img-fluid w-100 rounded-top" alt="">
                                            <?php } ?>
                                        </div>
                                       <!--  <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Fruits</div> -->
                                        <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                            <h4><?php echo $val->title; ?></h4>
                                            <p><?php echo $val->short_description; ?></p>
                                            <div class="d-flex justify-content-between flex-lg-wrap">
                                                <a href="javascript:void(0);" class="btn border border-secondary rounded-pill px-3 text-primary" onclick="getEnqueryModal(<?php echo $val->id; ?>)"><i class="fa fa-comments me-2 text-primary"></i> Enquiry</a>
                                                <a href="<?php echo base_url(); ?>product/<?php echo $val->alias; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-eye me-2 text-primary"></i> Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </div>
</div>
<!-- Fruits Shop End-->