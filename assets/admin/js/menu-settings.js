$(document).ready(function(){
	"use strict";
	
	var trigger = $('.menu-options .item-header > a');
	trigger.on('click', function(){
		var body = $(this).parent('.item-header').siblings('.item-body');
		$('.menu-options .item-body').not(body).removeClass('active').slideUp(300);
		$('.menu-options .item-header > a').not(this).removeClass('active');
		if(($(this).hasClass('active') === true) && (body.hasClass('active') === true)){
			$(this).removeClass('active');
			body.removeClass('active').slideUp(300);
		}else{
			$(this).addClass('active');
			body.addClass('active').slideDown(300);
		}
	});
	
	$('.sortable').nestedSortable({
		forcePlaceholderSize: true,
		items: 'li',
		handle: '.item',
		placeholder: 'menu-highlight',
		listType: 'ul',
		maxLevels: 2,
		opacity: 0.6,
	});

	$('.sortable').draggable();
	
});

function addToMenu(type){

	var menuname = $('.menuname').val();
	if(menuname){
		if(type != 'custom'){
			$('.'+type+' li').each(function(index){
				if($(this).find(".custom-input").prop("checked") == true){

					$('.sortable').append('<li><div class="item"><div class="item-title">'+$(this).find('.custom-label').text()+'<a href="javascript:void(0)" class="item-trigger" onclick="toggleMenu(this)"><i class="far fa-fw fa-angle-down"></i></a></div><div class="item-body"><input type="hidden" class="type" value="'+type+'"><input type="hidden" class="id" value="'+$(this).find(".custom-input").val()+'"><input class="form-control href" type="hidden" value=""/><div class="form-group"><label class="control-label">Name</label><input class="form-control title" type="text" value="'+$(this).find('.custom-label').text()+'"/></div><div class="form-group"><label class="control-label">Class</label><input class="form-control class" type="text" value=""></div><div class="action-group"><a href="javascript:void(0)" class="btn-remove" onclick="removeMenu(this)">Remove</a><a href="javascript:void(0)" class="btn-cancel" onclick="cancelMenu(this)">Cancel</a></div></div></div></li>');

					$(this).find(".custom-input").prop("checked",false);
				}
			});
		} else {

			if($('.name').val() != ''){
				$('.sortable').append('<li><div class="item"><div class="item-title">'+$('.name').val()+'<a href="javascript:void(0)" class="item-trigger" onclick="toggleMenu(this)"><i class="far fa-fw fa-angle-down"></i></a></div><div class="item-body"><input type="hidden" class="type" value="'+type+'"><input type="hidden" class="id" value=""><div class="form-group"><label class="control-label">Name</label><input class="form-control title" type="text" value="'+$('.name').val()+'"/></div><div class="form-group"><label class="control-label">Url</label><input class="form-control href" type="text" value="'+$('.url').val()+'"/></div><div class="form-group"><label class="control-label">Class</label><input class="form-control class" type="text" value=""></div><div class="action-group"><a href="javascript:void(0)" class="btn-remove" onclick="removeMenu(this)">Remove</a><a href="javascript:void(0)" class="btn-cancel" onclick="cancelMenu(this)">Cancel</a></div></div></div></li>');

				$('.name').val('');
				$('.url').val('');
			} else {
				toastr.error('Title cannot be blank', 'Failed', {timeOut: 2000,closeButton:true,progressBar:true});
			}	
		}
	} else {
		toastr.error('Select the menu', 'Failed', {timeOut: 2000,closeButton:true,progressBar:true});
	}
}

function selectAll(type){
	$('.'+type+' li').each(function(index){
		$(this).find(".custom-input").prop('checked', true);
	});
}

function toggleMenu(This){
	$(This).parent('.item-title').toggleClass('active');
	$(This).parent('.item-title').siblings('.item-body').slideToggle(300);
}

function cancelMenu(This){
	$(This).parents('.item-body').siblings('.item-title').toggleClass('active');
	$(This).parents('.item-body').slideUp(300);
}

function removeMenu(This){
	$(This).parents('.item').parent('li').remove();
}

function searchData(filter,type) {

	filter = filter.toLowerCase();
	$('.'+type+' li').each(function(index){
		if ($(this).find('.custom-label').text().toLowerCase().indexOf(filter) > -1) {
            $(this).css('display','')
        } else {
            $(this).css('display','none')
        }
	});
}

function saveData(){
  
  var menuname = $('.menuname').val();
  var jsonDdata = [];
  var isTitleBlank = 2;
  $('.sortable > li').each(function(index){

  	if($(this).find('.title').val() == ''){
		isTitleBlank = 1;
	}
  	var children = [];
  	$(this).find('ul > li').each(function(index){

  		if($(this).find('.title').val() == ''){
  			isTitleBlank = 1;
  		}
  		children.push({type:$(this).find('.type').val(),id:$(this).find('.id').val(),title:$(this).find('.title').val(),href:$(this).find('.href').val(),class:$(this).find('.class').val()})
  	});
  	if(children){
  		jsonDdata.push({type:$(this).find('.type').val(),id:$(this).find('.id').val(),title:$(this).find('.title').val(),href:$(this).find('.href').val(),class:$(this).find('.class').val(),children:children})
  	} else {
  		jsonDdata.push({type:$(this).find('.type').val(),id:$(this).find('.id').val(),title:$(this).find('.title').val(),href:$(this).find('.href').val(),class:$(this).find('.class').val()})
  	}
  	

  });

  if(isTitleBlank == 2){
	  $.ajax({
	    type: "POST",
	    url: BASE_URL +'admin/menu-save-data',
	    data: {menu:menuname,jsonDdata:jsonDdata},
	    beforeSend:function(){

	      $('.btn-saveMenu').prop('disabled',true);
	      $('.btn-saveMenu').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Saving...');
	    },
	    success:function(result){

	      var data = jQuery.parseJSON(result);
	      if(data.status == 1){
	        $('.btn-saveMenu').html('Saved');
	        toastr.success(data.msg, 'Saved', {timeOut: 1000,progressBar:true,onHidden:function() { window.location.href = BASE_URL+'admin/menu-settings'; }   });
	      } else {
	        $('.btn-saveMenu').prop('disabled',false);
	        $('.btn-saveMenu').html('Save');
	        toastr.error(data.msg, 'Save failed', {timeOut: 2000,closeButton:true,progressBar:true});
	      }
	    }
	  });
	} else {
		toastr.error('Title cannot be blank.', 'Failed', {timeOut: 2000,closeButton:true,progressBar:true});
	}
}

function menuChange(menuname){

	$.ajax({
    type: "POST",
    url: BASE_URL +'admin/get-menu-data',
    data: {menu:menuname},
    beforeSend:function(){

      
    },
    success:function(result){

      var data = jQuery.parseJSON(result);
      $('.menu-list').html(data.html);
    }
  });
}