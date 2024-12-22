<!DOCTYPE html>

<html lang="en">

    <head>

        <meta charset="utf-8">

        <title><?php echo isset($pageTitle)?$pageTitle.' | Wholesale Brazil Sugar': 'Wholesale Brazil Sugar';?></title>

        <meta content="width=device-width, initial-scale=1.0" name="viewport">

        <meta content="" name="keywords">

        <meta content="" name="description">

        <!-- Google Web Fonts -->

        <link rel="preconnect" href="https://fonts.googleapis.com">

        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 



        <!-- Icon Font Stylesheet -->

        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">



        <!-- Libraries Stylesheet -->

        <link href="<?php echo base_url();?>assets/front/lib/lightbox/css/lightbox.min.css" rel="stylesheet">

        <link href="<?php echo base_url();?>assets/front/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->

        <link href="<?php echo base_url();?>assets/front/css/bootstrap.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/css/toastr.min.css">

        <?php if(isset($cssFiles)){ foreach ($cssFiles as $cssKey => $cssValue) { ?>

          <link href="<?php echo base_url();?>assets/front/css/<?php echo $cssValue;?>.css" rel="stylesheet">

        <?php } } ?> 

        <!-- Template Stylesheet -->

        <link href="<?php echo base_url();?>assets/front/css/style.css" rel="stylesheet">

    </head>

    <body>

        <!-- Spinner Start -->

        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">

            <div class="spinner-grow text-primary" role="status"></div>

        </div>

        <!-- Spinner End -->

        <?php $this->load->view('front/common/default/header'); ?>        

        <?php $this->load->view((isset($viewPage)?'front/'.$viewPage:''));?>

        <?php $this->load->view('front/common/default/footer'); ?>



        <div class="modal fade enquiryModal" id="enqueryModal" data-backdrop="static" data-keyboard="false">

        

        </div>

        <style type="text/css">

        .modal-open {overflow: auto;}

        .modal{ overflow-x: hidden; overflow-y: auto;}

        .enquiryModal{}

        .enquiryModal .modal-content{border: 0;border-radius: 16px;box-shadow: rgba(0,0,0,0.5) 0 2px 20px;}

        .enquiryModal .modal-close{display: flex;justify-content: center;align-items: center;width: 40px;height: 40px;background-color: #045978;box-shadow: rgba(0,0,0,0.1) 0 2px 10px;border-radius: 50%;font-size: 20px;color: #fff;position: absolute;top: -10px;right: -10px;}

        .enquiryModal .modal-form{}

        .enquiryModal .modal-form .title{font-size: 20px;font-weight: 700;line-height: 1;margin: 0 0 10px;padding: 0 0 10px;border-bottom: 1px solid rgba(0,0,0,0.1);}

        .enquiryModal .modal-form .form-control{height:40px;border-radius:6px;padding: 10px 16px;}

        .enquiryModal .modal-form textarea.form-control{height:unset; max-height: 120px;}

        .enquiryModal .modal-form .form-control:focus{border-color:var(--primaryColor)}

        .enquiryModal .modal-form .action-btn{display: flex;justify-content: center;align-items: center;background-color: var(--secondaryColor);padding: 10px 30px;height: 40px; min-width: 160px; border-radius: 30px;white-space: nowrap; position: relative; z-index: 0; overflow: hidden;}

        .enquiryModal .modal-form .action-btn input{color: #fff;letter-spacing: 0;font-weight: 700;font-size: 14px;text-transform: uppercase;background-color: transparent;border: 0;position: absolute;top: 0;left: 0;width: 100%;height: 100%;}

        .enquiryModal .modal-form .action-btn:before{content: '';position: absolute;width: 100%;height: 100%;top: 0;left: 0;background: var(--primaryColor);transform: scale(0,1);transition: all .3s ease;z-index: -1;}

        .enquiryModal .modal-form .action-btn:hover:before{transform: scale(1,1);}

        </style>



         <!-- Back to Top -->

        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   



        

    <!-- JavaScript Libraries -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="<?php echo base_url();?>assets/front/lib/easing/easing.min.js"></script>

    <script src="<?php echo base_url();?>assets/front/lib/waypoints/waypoints.min.js"></script>

    <script src="<?php echo base_url();?>assets/front/lib/lightbox/js/lightbox.min.js"></script>

    <script src="<?php echo base_url();?>assets/front/lib/owlcarousel/owl.carousel.min.js"></script>



    <!-- Template Javascript -->

    <script src="<?php echo base_url();?>assets/front/js/main.js"></script>

    <script defer="defer" src="<?php echo base_url();?>assets/admin/js/toastr.min.js"></script>

    <script>

        var BASE_URL = '<?php echo base_url();?>';

    </script>

    <?php if(isset($jsFiles)){ foreach ($jsFiles as $jsKey => $jsValue) { ?>

    <script defer="defer" src="<?php echo base_url();?>assets/front/js/<?php echo $jsValue;?>.js"></script>

    <?php } } ?>

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/65f311599131ed19d979e7d2/1hounnibq';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End of Tawk.to Script-->
    </body>

</html>