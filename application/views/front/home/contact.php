 <?php $settings = getSiteSettings(); ?>
 <div class="container-fluid contact py-5">
    <div class="container py-5">
        <div class="p-5 bg-light rounded">
            <div class="row g-4">
                <div class="col-12">
                    <div class="text-center mx-auto" style="max-width: 700px;">
                        <h1 class="text-primary">Get in touch</h1>
                        <!-- <p class="mb-4">The contact form is currently inactive. Get a functional and working contact form with Ajax & PHP in a few minutes. Just copy and paste the files, add a little code and you're done.</p> -->
                    </div>
                </div>
                <div class="col-lg-7">
                    <form id="contactForm" action="javascript:void(0)" method="post">
                        <input type="text" class="w-100 form-control border-0 py-3 mb-4 validate" placeholder="Your Name" name="name" data-validate-msg="Name field is required">
                        <input type="email" class="w-100 form-control border-0 py-3 mb-4 validate" placeholder="Enter Your Email"  name="email" data-validate-msg="Email field is required">
                        <textarea class="w-100 form-control border-0 mb-4 validate" rows="5" cols="10" placeholder="Your Message" name="message" data-validate-msg="Message field is required"></textarea>
                        <button class="w-100 btn form-control border-secondary py-3 bg-white text-primary contactButton" type="button">Submit</button>
                    </form>
                </div>
                <div class="col-lg-5">
                    <!-- <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Address</h4>
                            <p class="mb-2"><?php echo $settings->address; ?></p>
                        </div>
                    </div> -->
                    <div class="d-flex p-4 rounded mb-4 bg-white">
                        <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Mail Us</h4>
                            <p class="mb-2"><?php echo $settings->contact_email; ?></p>
                        </div>
                    </div>
                    <div class="d-flex p-4 rounded bg-white">
                        <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                        <div>
                            <h4>Telephone</h4>
                            <p class="mb-2"><?php echo $settings->phone; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>