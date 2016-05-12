$(function(){
	
	$('a.zan').click(function(){
		if($(this).hasClass('dianzan')){
			////动画 点赞+1
			var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
			  $(this).append('<div id="zhan"><b>+1<\/b></\div>');
			  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
			   $(this).fadeIn('fast').remove();
			   var Num = parseInt(obj.find('span').text());
			       Num++;
			    	obj.find('span').text(Num);		    
			  });	   
			  return false;
		}else{
			//动画 点赞-1
			var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
			  $(this).append('<div id="zhan"><b>-1<\/b></\div>');
			  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
			   $(this).fadeIn('fast').remove();
			   var Num = parseInt(obj.find('span').text());
			       Num--;
			    	obj.find('span').text(Num);		    
			  });	   
			  return false;
		}
		  
		 });
	
	$('body').on('click','a.zan',function(){
		if($(this).hasClass('dianzan')){
			////动画 点赞+1
			var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
			  $(this).append('<div id="zhan"><b>+1<\/b></\div>');
			  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
			   $(this).fadeIn('fast').remove();
			   var Num = parseInt(obj.find('span').text());
			       Num++;
			    	obj.find('span').text(Num);		    
			  });	   
			  return false;
		}else{
			//动画 点赞-1
			var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
			  $(this).append('<div id="zhan"><b>-1<\/b></\div>');
			  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
			   $(this).fadeIn('fast').remove();
			   var Num = parseInt(obj.find('span').text());
			       Num--;
			    	obj.find('span').text(Num);		    
			  });	   
			  return false;
		}
		 });
	

	
	
		
	
	//显示删除回复
	$('.shi-dian-hui').mouseenter(function(){
		$(this).find('.delete-hui').show();
	}).mouseleave(function(){
		$(this).find('.delete-hui').hide();
	});
	$('body').on('mouseenter','.shi-dian-hui',function(){
		$(this).find('.delete-hui').show();
	}).on('mouseleave','.shi-dian-hui',function(){
		$(this).find('.delete-hui').hide();
	});
	
	
	
	
	//控制字数
  $('.comment-text').keyup(function(){
	  var str = $(this).val().length;
	  $(this).parents('.comment-content').find('.comm').text(str);
  });
	
  $('.comment-text').change(function(){
	  var str = $(this).val().length;
	  $(this).parents('.comment-content').find('.comm').text(str);
  });
	
  //控制回复 分割线
	$('.comment-body').find('div').eq(0).css('border','0px');
	
  
	
  //鼠标hover下啦菜单
	$('[data-toggle="dropdown"]').bootstrapDropdownHover({
		  // see next for specifications
	})
});