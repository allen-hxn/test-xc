$(function(){
	//动画 点赞+1
	$('a.dianzan').click(function(){
		  var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
		  $(this).append('<div id="zhan"><b>+1<\/b></\div>');
		  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
		   $(this).fadeIn('fast').remove();
		   var Num = parseInt(obj.find('span').text());
		       Num++;
		    	obj.find('span').text(Num);		    
		  });	   
		  return false;
		 });
	
	$('body').on('click','.dianzan',function(){
		var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
		  $(this).append('<div id="zhan"><b>+1<\/b></\div>');
		  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
		   $(this).fadeIn('fast').remove();
		   var Num = parseInt(obj.find('span').text());
		       Num++;
		    	obj.find('span').text(Num);		    
		  });	   
		  return false;
		 });
	//动画 点赞-1
	$('a.quxiao').click(function(){
		  var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
		  $(this).append('<div id="zhan"><b>-1<\/b></\div>');
		  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
		   $(this).fadeIn('fast').remove();
		   var Num = parseInt(obj.find('span').text());
		       Num--;
		    	obj.find('span').text(Num);		    
		  });	   
		  return false;
		 });
	$('body').on('click','.quxiao',function(){
		var left = parseInt($(this).offset().left)+10, top =  parseInt($(this).offset().top)-10, obj=$(this);
		  $(this).append('<div id="zhan"><b>-1<\/b></\div>');
		  $('#zhan').css({'position':'absolute','z-index':'1', 'color':'#C30','left':left+'px','top':top+'px'}).animate({top:top-10,left:left+10},'slow',function(){
		   $(this).fadeIn('fast').remove();
		   var Num = parseInt(obj.find('span').text());
		       Num--;
		    	obj.find('span').text(Num);		    
		  });	   
		  return false;
		 });
	
	
	//点赞
	$('.dianzan').click(function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		$.post('{:U("album/editZan")}',{'id':cid,'type':'dian'},function(data){
			if(data.status == 1){
			    this_.removeClass('dianzan').addClass('quxiao');
			    this_.css('color','red');
			    layer.msg('成功', {icon: 1});
			}else{
				layer.alert(data.msg);
			}
		},'json');
	});
	$('body').on('click','.dianzan',function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		$.post('{:U("album/editZan")}',{'id':cid,'type':'dian'},function(data){
			if(data.status == 1){
			    this_.removeClass('dianzan').addClass('quxiao');
			    this_.css('color','red');
			    layer.msg('成功', {icon: 1});
			}else{
				layer.alert(data.msg);
			}
		},'json');
	});
	
	//取消点赞
	$('body').on('click','.quxiao',function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		$.post('{:U("album/editZan")}',{'id':cid,'type':'quxiao'},function(data){
			if(data.status == 1){
			    this_.removeClass('quxiao').addClass('dianzan');
			    this_.css('color','');
			    layer.msg('成功', {icon: 1});
			}else{
				layer.alert(data.msg);
			}
		},'json');
	});
	
	
	//加载更多
	$('.load-more').click(function(){
		var p = $(this).attr('data-page');
		var this_ = $(this);
		var id = "{$album.id}";
		$.get('{:U("Album/loadMoreComment")}',{'p':p,'id':id},function(data){
			$('.comment-body').append(data);
			p = parseInt(p);
			this_.attr('data-page',p+1);
		});
	});
	
	
	//点击删除回复
	$('.delete-hui').click(function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		layer.confirm('您确定要删除吗',{},function(){
			 layer.msg('的确很重要', {icon: 1});
			 $.post('{:U("album/deleteComment")}',{'id':cid},function(data){
				 if(data.status == 1){
					 this_.parents('.row-fluid').remove();
					 layer.msg('删除成功', {icon: 1});
				 }else{
					 layer.alert(data.msg);
				 }
			 },'json');
		});
	});
	
	//显示删除回复
	$('.shi-dian-hui').mouseenter(function(){
		$(this).find('.delete-hui').show();
	}).mouseleave(function(){
		$(this).find('.delete-hui').hide();
	});
	
	
	
	
	//文本框自动换行
	$('body').on('keyup','.fast-comment',function(){
		var str = $(this).val();
		if(str.length > 20){
			$(this).attr('rows',2);
		}
		if(str.length > 40){
			$(this).attr('rows',3);
		}
		
	});
	
	//回复 折叠
	$('.show-huifu').click(function(){
		$(this).parents('.row-fluid').find('.coll').toggle();
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