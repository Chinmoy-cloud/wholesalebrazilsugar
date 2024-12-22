function saveData(){

  var formData = new FormData($("#manageForm")[0]);
  $.ajax({
    type: "POST",
    url: BASE_URL +'admin/banner-save-data',
    data: formData,
    enctype:'multipart/form-data',
    contentType : false,
    processData : false,
    beforeSend:function(){

      $('.saveButton').prop('disabled',true);
      $('.saveButton').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
    },
    success:function(result){

      var data = jQuery.parseJSON(result);
      if(data.status == 1){
        $('.saveButton').html('Saved');
        toastr.success(data.msg, 'Saved', {timeOut: 1000,progressBar:true,onHidden:function() { window.location.reload(); }   });
      } else {
        $('.saveButton').prop('disabled',false);
        $('.saveButton').html('Save');
        toastr.error(data.msg, 'Save failed', {timeOut: 2000,closeButton:true,progressBar:true});
      }
    }
  });
}


function readURL(input) {
  if (input.files && input.files[0]) {
    var ext = input.files[0].name;
    extension = ext.substring(ext.lastIndexOf('.')+1);
    var reader = new FileReader();
    reader.onload = function (e) {
      if(extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'JPG' || extension == 'JPEG' || extension == 'PNG'){
        $('.upic').attr('src', e.target.result);
      }else{
        toastr.error('You can upload only JPG, JPEG, PNG files.', 'Upload failed', {timeOut: 2000,closeButton:true,progressBar:true});
      }
    }
    reader.readAsDataURL(input.files[0]);
  }
}


$(document).ready(function(){
  $(".saveButton").click(function(){
    var enable = true;
    $( ".validate" ).each(function( index,element ) {  
       if(jQuery.trim($(element).val()) == ''){
        toastr.error($(element).data('validate-msg'), 'Validation failed', {timeOut: 2000,closeButton:true,progressBar:true});
        enable = false;
        return false;
      }
     
     
    });
    if(enable){
      saveData();
    }

  });

});