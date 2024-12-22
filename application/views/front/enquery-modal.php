<div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-body">
            <a href="javascript:void(0)" class="modal-close" data-dismiss="modal"><i class="lni lni-cross-circle"></i></a>
            <div class="modal-form">
                <div class="title">Enquiry</div>
                <form action="javascript:void(0)" method="post" role="form" class="enquiryForm" id="enquiryForm">
                    <input type="hidden" name="product_id" id="product_id" value="<?php echo $product_id;?>">
                    <input type="hidden" name="type" id="type" value="2">
                    <div class="single-form form-group">
                        <input type="text" class="form-control validate1" name="name" placeholder="Name" data-validate-msg="Name field is required">
                    </div>
                    <div class="row form-row">
                        <div class="col-sm-6">
                            <div class="single-form form-group">
                                <input type="email" class="form-control validate1" name="email" placeholder="Email" data-validate-msg="Email field is required">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="single-form form-group">
                                <input type="text" class="form-control validate1" id="phone" name="phone" placeholder="Phone" data-validate-msg="Phone no field is required">
                            </div>
                        </div>
                    </div>
                    <div class="single-form form-group">
                        <textarea class="form-control validate1" name="message" id="message1" rows="8" placeholder="Your Message" data-validate-msg="Message field is required"></textarea>
                    </div>
                    <div class="single-form form-group" align="center">
                        <button class="main-btn enquiryButton">Send Message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

  <script type="text/javascript">
  $(".enquiryButton").click(function(){
      var enable = true;
      $( ".validate1" ).each(function( index,element ) {
        if($(element).val() == ''){
          toastr.error($(element).data('validate-msg'), 'Validation Failed' , {timeOut: 2000,closeButton:true,progressBar:true});
          enable = false;
          return false;
        }
      });

      if(enable){
        saveEnquiryData();
      }
  }); 

  function saveEnquiryData(){
    var formData = new FormData($("#enquiryForm")[0]);
    $.ajax({
      type: "POST",
      url: BASE_URL +'contact-save-data',
      data: formData,
      enctype:'multipart/form-data',
      contentType : false,
      processData : false,
      beforeSend:function(){
        $('.enquiryButton').prop('disabled',true);
        $('.enquiryButton').val('Processing....');
      },
      success:function(result){
        var data = jQuery.parseJSON(result);
        if(data.status == 1){
          $('.enquiryButton').val('Send Message');
          $('#enquiryModal').modal('hide');
          toastr.success(data.message, 'Success', {timeOut: 1000,progressBar:true,closeButton:true});
          $('#enquiryForm').trigger("reset");
        } else {
          $('.enquiryButton').prop('disabled',false);
          $('.enquiryButton').val('Send Message');
          toastr.error(data.message, 'Failed', {timeOut: 2000,closeButton:true,progressBar:true});
        }
      }
    });
  }
</script>