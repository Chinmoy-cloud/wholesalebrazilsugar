function saveData(){
  var formData = new FormData($("#manageForm")[0]);
  formData.append('description', tinymce.get("description").getContent());
  $.ajax({
    type: "POST",
    url: BASE_URL +'admin/site-settings-save-data',
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
        toastr.success(data.msg, 'Saved', {timeOut: 1000,progressBar:true,onHidden:function() { window.location.href = BASE_URL+'admin/site-settings'; }   });
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
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if(width < 350 || height < 250){
                        toastr.error('Choose a file with minimum 350x250 Dimensions. ', 'Upload failed', {timeOut: 2000,closeButton:true,progressBar:true});
                        $('#image').val('');
                    }else{
                        $('.upic').attr('src', e.target.result);
                    }
                }
            }else{
                toastr.error('You can upload only JPG, JPEG, PNG files.', 'Upload failed', {timeOut: 2000,closeButton:true,progressBar:true});
                $('#image').val('');
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function(){
  $(".saveButton").click(function(){
    var enable = true;
    $( ".validate" ).each(function( index,element ) {  
      if(($(element).attr('name') == 'contact_email' || $(element).attr('name') == 'career_email' || $(element).attr('name') == 'business_email') && jQuery.trim($(element).val()) != '' && IsEmail($(element).val())==false){
        toastr.error('Please enter a valid email.', 'Validation failed', {timeOut: 2000,closeButton:true,progressBar:true});
        enable = false;
        return false;
       } 
       if(($(element).attr('name') == 'facebook_link' || $(element).attr('name') == 'twitter_link' || $(element).attr('name') == 'youtube_link' || $(element).attr('name') == 'instagram_link' || $(element).attr('name') == 'google_link' || $(element).attr('name') == 'behance_link') && jQuery.trim($(element).val()) != '' && IsUrl($(element).val())==false){
        toastr.error('Please enter a valid url.', 'Validation failed', {timeOut: 2000,closeButton:true,progressBar:true});
        enable = false;
        return false;
       }           
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
  $(".cancelButton").click(function(){
    window.location.href=BASE_URL+"admin/site-settings";
  });
});