function searchFilter(page_num,loadingType) {
   page_num = page_num?page_num:0;
  var sortBy = $('#sortBy').val();
  var sortByField = $('#sortByField').val();
  var perPage = $('#perPage').val();
  var type = $('#type').val(); 
  var keyword = $('#keyword').val();
  var startEnd = $('#startEnd').val();
  $.ajax({
    type: 'POST',
    url: BASE_URL+'admin/contact-search-data/'+page_num,
    data:'page='+page_num+'&sortBy='+sortBy+'&sortByField='+sortByField+'&perPage='+perPage+'&keyword='+keyword+'&startEnd='+startEnd+'&type='+type,
    beforeSend: function () {
      $('.preloader').addClass('active');
      $('.table-responsive').addClass('overflow-hidden');
    },
    success: function (html) {
      var data = jQuery.parseJSON(html);
      $('#contactsList').html(data.html);
      $('#paginationDiv').html(data.pagination);
      if(loadingType != 1){
        $('html, body').animate({scrollTop:$('#contactsList').offset().top - 200 }, 500);
      }
      $('.preloader').removeClass('active');
      $('.table-responsive').removeClass('overflow-hidden');
    }
  });
}


function sortBy(field,sortByField,sortBy){
 $('#sortByField').val(sortByField);
  $('#sortBy').val(sortBy);
  $('.commonSorting').removeClass('active');
  $('.'+field+'_'+sortBy).addClass('active');
  $('.'+field).removeAttr('onclick');
  if(sortBy == 'ASC'){
    sortBy = 'DESC';
  } else {
    sortBy = 'ASC';
  }
  $('.'+field).attr('onclick', 'sortBy("'+field+'","'+sortByField+'","'+sortBy+'")');
  searchFilter();
}

function resetSearch(){
  location.reload();
}





function deleteContact(id){
  var ids = '';
  if(id == 'all'){
    $('.singleCheck').each(function(index,element){
      if($(this).prop("checked") == true){
        ids += $(this).val()+',';
      } 
    });
    ids = ids.replace(/,\s*$/, "");
  } else {
    ids = id;
  }
  if(ids){
    $('#deleteModal').find('#deleteData').val(ids);
    $('#deleteModal').modal('show');
  } else {
    toastr.error('Please select atleast one data to delete', 'Delete failed', {timeOut: 2000,closeButton:true,progressBar:true});
  }
  
}

function deleteConfirm(){
  var ids = $('#deleteModal').find('#deleteData').val();
  $.ajax({
    type: 'POST',
    url: BASE_URL+'admin/delete-contact',
    data:'ids='+ids,
    beforeSend: function () {
      $('.deleteButton').prop('disabled',true);
      $('.deleteButton').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Deleting...');
    },
    success: function (html) {
      var data = jQuery.parseJSON(html);
      if(data.status == 1){
        $('#deleteModal').modal('hide');
        $('.deleteButton').html('Confirm');
        $('#customCheckcheckAll').prop('checked',false);
        toastr.success(data.msg, 'Delete success', {timeOut: 1000,progressBar:true,closeButton:true  });
        searchFilter();
      } else {
        $('.deleteButton').prop('disabled',false);
        $('.deleteButton').html('Confirm');
        toastr.error(data.msg, 'Delete failed', {timeOut: 2000,closeButton:true,progressBar:true});
      }

    }
  });

}

function statusChange(id,status){
  $.ajax({
    type: 'POST',
    url: BASE_URL+'admin/change-status-contact',
    data:'id='+id+'&status='+status,
    beforeSend: function () {
      $('.preloader').addClass('active');
      $('.table-responsive').addClass('overflow-hidden');
    },
    success: function (html) {
      $('.preloader').removeClass('active');
      $('.table-responsive').removeClass('overflow-hidden');
      var data = jQuery.parseJSON(html);
      if(data.status == 1){
        if(status == 1){
          $('#status_td_'+id).html('<span class="btn btn-xs btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Active</span></span>');
          $('#status_a_'+id).html('<i class="fas fa-fw fa-times-circle"></i> Unseen');
          $('#status_a_'+id).removeAttr('onclick');
          $('#status_a_'+id).attr('onclick', 'statusChange('+id+',2)');
        } else {
          $('#status_td_'+id).html('<span class="btn btn-xs btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-times"></i></span><span class="text">Inactive</span></span>');
          $('#status_a_'+id).html('<i class="fas fa-fw fa-check-circle"></i> Seen');
          $('#status_a_'+id).removeAttr('onclick');
          $('#status_a_'+id).attr('onclick', 'statusChange('+id+',1)');
        }        
        toastr.success(data.msg, 'Status changed', {timeOut: 2000,progressBar:true,closeButton:true   });
      }else{
        toastr.error(data.msg, 'Status change failed', {timeOut: 2000,closeButton:true,progressBar:true});
      }
    }
  });

}

$(document).ready(function(){
$(function () {
      $('.datepicker').datepicker();
  });

  var url = window.location.href;
  var param = url.split('/');
  if( param[param.length - 1] && param[param.length - 1] == 'contacts' ){
    searchFilter('',1);

    $('#startEnd').daterangepicker({ autoUpdateInput: false });
    $('#startEnd').on('apply.daterangepicker', function(ev, picker) {
   
    $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
      searchFilter('',1);
    });

    $('#startEnd').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
         searchFilter('',1);
    });
  }
  
  $(".cancelButton").click(function(){
    window.location.href=BASE_URL+"admin/contacts";
  });

});