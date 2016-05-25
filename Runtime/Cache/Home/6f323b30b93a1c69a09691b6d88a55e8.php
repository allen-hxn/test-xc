<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
<title><?php echo C('WEB_SITE_TITLE');?></title>
<link href="/Public/static/bootstrap/css/bootstrap.css" rel="stylesheet">
<link href="/Public/static/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
<link href="/Public/static/bootstrap/css/docs.css" rel="stylesheet">
<link href="/Public/static/bootstrap/css/onethink.css" rel="stylesheet">
<link href="/Public/static/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="/Public/static/bootstrap/js/html5shiv.js"></script>
<![endif]-->

<link href="/Public/static/lightbox/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="/Public/static/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" charset="utf-8" />
<style>
.thumbnails li:hover{border-color:blue;}
.popover{max-width:600px;};

.comment-body a{cursor:pointer;}
.dian-hui a{padding:0 5px;}
.hide-xiangce li:hover{border:1px solid blue;}
.xuan{border:1px solid blue;}
</style>

<!--[if lt IE 9]>
<script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
<script type="text/javascript" src="/Public/static/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public/static/layer-pc/layer.js"></script>
<!--<![endif]-->
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>

</head>
<body>
	<!-- 头部 -->
	<!-- 导航条
================================================== -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="<?php echo U('index/index');?>">OneThink</a>
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="nav-collapse collapse">
                <ul class="nav">
                    <?php $__NAV__ = M('Channel')->field(true)->where("status=1")->order("sort")->select(); if(is_array($__NAV__)): $i = 0; $__LIST__ = $__NAV__;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i; if(($nav["pid"]) == "0"): ?><li>
                            <a href="<?php echo (get_nav_url($nav["url"])); ?>" target="<?php if(($nav["target"]) == "1"): ?>_blank<?php else: ?>_self<?php endif; ?>"><?php echo ($nav["title"]); ?></a>
                        </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </ul>
            </div>
            <div class="nav-collapse collapse pull-right">
                <?php if(is_login()): ?><ul class="nav" style="margin-right:0">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-left:0;padding-right:0"><?php echo get_username();?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo U('User/profile');?>">修改密码</a></li>
                                <li><a href="<?php echo U('User/logout');?>">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                <?php else: ?>
                    <ul class="nav" style="margin-right:0">
                        <li>
                            <a href="<?php echo U('User/login');?>">登录</a>
                        </li>
                        <li>
                            <a href="<?php echo U('User/register');?>" style="padding-left:0;padding-right:0">注册</a>
                        </li>
                    </ul><?php endif; ?>
            </div>
        </div>
    </div>
</div>

	<!-- /头部 -->
	
	<!-- 主体 -->
	
    <header class="jumbotron subhead" id="overview">
        <div class="container">
            <h2>源自相同起点，演绎不同精彩！</h2>
            <p class="lead"></p>
        </div>
    </header>

<div id="main-container" class="container">
    <div class="row">
        


        
   <div>
   	<ul class="breadcrumb">
	  <li><a href="<?php echo U('Index/index');?>">首页</a> <span class="divider">/</span></li>
	  <li><a href="<?php echo U('Album/index');?>">相册</a> <span class="divider">/</span></li>
	  <li class="active"><?php echo ($album["name"]); ?></li>
	</ul>
   </div>

   <div style="margin:0 0 20px 0 ;">
     <div class="row-fluid">
	    <div class="span6">
	    	  <div style="float:left;">
	    	  <img data-src="holder.js/260x180"  alt="260x180" src="/Uploads<?php echo ((isset($album["fengmian"]) && ($album["fengmian"] !== ""))?($album["fengmian"]):'/none.png'); ?>"  style="width: 100px; height: 100px;">            	         
	    	  </div>  
	    	  <div style="float:left;margin:0 0 0 10px;">

	    	   <h4><?php echo ($album["name"]); ?></h4>	    	    
	    	   <p><?php echo ($album["info"]); ?></p>
	    	   <a class="btn btn-primary" href="<?php echo U('album/upload',array('aid'=>$album['id']));?>">上传照片</a>
		       <button class="btn btn-info">批量管理</button>
		       <div class="btn-group hide-div" >
					  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">更多			   
					    <span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">			   
	                  <li><a href="<?php echo U('album/edit',array('id'=>$album['id']));?>">编辑</a></li>
	                  <li><a class="delete-album" data-aid="<?php echo ($album["id"]); ?>">删除</a></li>
			   </div>  
	    	  </div>         
             
	     
	    </div>
	    <div class="span3 offset3" style=" margin-top: 35px;">
	    <div style="float:right; text-align:right;">
	    			<div>照片数：<?php echo ($pic_count); ?></div>
	                <i class="icon-thumbs-up"></i>12
	                <i class="icon-comment"></i><?php echo ($comments_count); ?>
	                <p>创建于：<?php echo (date('Y-m-d',$album["addtime"])); ?></p>
	    </div>
	    </div>
	  </div>
   </div>
	  
	
	<div class="row-fluid" id='layer-photos-demo' style="padding:20px 0 40px 0;">
	
            <ul class="thumbnails">
            <?php if(is_array($pic)): $i = 0; $__LIST__ = $pic;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$var): $mod = ($i % 4 );++$i;?><li class="span3">
                <div class="thumbnail">
                 <a href="/Uploads<?php echo ($var["path"]); ?>" rel="prettyPhoto[pp_gal]">
                  <img data-src="holder.js/260x180" data-lightbox="image-box-set" data-title="My caption" alt="260x180" src="/Uploads<?php echo ($var["path"]); ?>"  style="width: 260px; height: 180px;">
                 </a>
                <div class="caption" style="font-size:10px;">
	                <i class="icon-thumbs-up"></i>12
	                <a class="example" href="javascript:;" data-toggle="popover" data-placement="bottom" data-content='<form style="margin:0px;" class="form-inline"><img  class="img-rounded" style="position:absolute;" src="/Uploads/album/20160509/57302d4d014c4.jpg" width="25" height="25" />&nbsp;<textarea type="text"  style="width:200px;margin:0 8px 0 30px;" class="input-small fast-comment" placeholder="写点什么吧" rows="1"></textarea> <div style="float:right;"> <button type="submit" class="btn">发表</button></div></form>' title="" data-original-title=""><i class="icon-comment"></i></a>100
	                <div class="btn-group hide-div dropdown" >
					  <a class="btn dropdown-toggle btn-mini" data-toggle="dropdown" href="#">			   
					    <span class="caret"></span>
					  </a>
					  <ul class="dropdown-menu">			   
	                  <li><a href="#" class='shift-ab' data-pid="<?php echo ($var["pid"]); ?>">移动</a></li>
	                  <li><a href="<?php echo U('album/picDetail',array('pid'=>$var['pid'],'aid'=>$album['id']));?>" class="more-comment">更多评论</a></li>
	                  <li><a href="<?php echo U('album/picDetail',array('pid'=>$var['pid'],'aid'=>$album['id']));?>">编辑</a></li>	                 
	                  <li class="divider"></li>
	                  <li><a href="<?php echo U('album/setFengmian',array('id'=>$var['pid'],'aid'=>$album['id']));?>">设置为封面</a></li>
	                  <li><a class="delete-pic" data-pid="<?php echo ($var["pid"]); ?>">删除</a></li>              
					  </ul>
				 </div>  	                         
					<div style="float:right;">
					<span><?php echo (date('Y-m-d',$var["addtime"])); ?></span>
					</div>             
                </div>
                </div>              
              </li>
              <?php if(($mod) == "3"): ?></ul><ul class="thumbnails"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
     
            </ul>
            
                     
            
          </div>
          
          <div class="comment" style="padding:20px 0px;">
	          <div class='row-fluid'>
		          <div class="span6" style="text-algin:left;"><h4><?php echo ($comments_count); ?>条评论，<?php echo ($canyu); ?>人参与。</h4></div>
		          <div class="span6" style="margin-top:10px;"><div style="float:right;"><i class="fa fa-star fa-lg"></i></div></div>

	          </div>
	          
	          <div class='comment-content'>
	             <div style="float:left;width:7%;"><img  class="img-rounded"  src="/Uploads/album/20160509/57302d4d014c4.jpg" width="45" height="45" /></div>
	             <div style="float:right; width:93%;">
	             <input type="hidden" name="albumid" value="<?php echo ($album["id"]); ?>" />
	                  <div><textarea type="text" style="width:99%;" class="comment-text" id="comment-text" placeholder="写点什么吧..." rows="5"></textarea></div>                 
	                  <div style='float:left;'><span class="emotion"><i class="fa fa-smile-o fa-lg"></i></span>&nbsp;</div>
	                  <div style="float:right;"><font class='comm'>0</font>/140 &nbsp;<button class="btn btn-primary submit-comment">发表</button></div>
	                  <div style="clear:both;"></div>
	             </div>	             
	             <div style="clear:both;"></div>
	          </div>
	          
	          <div class="dropdown" style="margin:10px 0;border-bottom:1px solid #dedede;">
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
			               最新评论
			        <b class="caret"></b>
			      </a>
			    <ul class="dropdown-menu">
			     <li><a href="#">最早评论</a></li>
			     <li><a href="#">最热评论</a></li>
			    </ul>
			  </div>
			  
	   <div class='comment-body'>
	         <?php if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$com): $mod = ($i % 2 );++$i;?><div class='row-fluid' style="padding:10px 0px;border-top: 1px dotted #ccc;">
			    <div style="float:left;width:7%;"><img  class="img-rounded"  src="/Public/Home/images/noone.jpg" width="45" height="45" /></div>
	             <div style="float:right; width:93%;">
	                   <div style=" word-wrap: break-word; word-break: break-all;margin-bottom: 10px;">
	                                         <a href="javascript:;"><?php echo ($com["username"]); ?></a>:<?php echo (ubbreplace($com["comment"])); ?>
	                   </div>
	                   <?php if($com["sub"] != ''): ?><div style="border:1px solid #dedede;border-radius:4px;padding:8px 20px; margin:0px 20px 0 40px;">
	                     <a href="javascript:;"><?php echo ($com["sub"]["username"]); ?></a>:<?php echo (ubbreplace($com["sub"]["comment"])); ?>
	                   </div><?php endif; ?>
                  
	                <div class="shi-dian-hui">
	                   <div style='float:left;'><font style="font-size:5px;color:#aeaeae;"><?php echo (date('Y年m月d日',$com["addtime"])); ?></font></div>
	                   <div style="float:right;" class="dian-hui" >
	                     <?php if($com["add_uid"] == session('user_auth.uid')): ?><a class='delete-hui' style="display:none;" href="javascript:;" data-id="<?php echo ($com["id"]); ?>" >删除</a><?php endif; ?>
	                     <a href="javascript:;"  data-id= "<?php echo ($com["id"]); ?>" <?php if($com["isZan"] == 1): ?>class="zan quxiao" style="color:red;"<?php else: ?>class="zan dianzan"<?php endif; ?> ><i class="fa fa-thumbs-o-up">(<span><?php echo ($com["zan"]); ?></span>)</i></a>|<a href="javascript:;" class="show-huifu" data-target="#demo<?php echo ($com["id"]); ?>">回复</a>	                        	                        
	                   </div>
	                   <div style="clear:both;"></div>
	                </div>
	             </div>	
             	   <div id="demo<?php echo ($com["id"]); ?>" class="coll comment-content" style="display:none;" >
			        <div style="padding:10px 0; width:80%;float:right;">
			         <form action="<?php echo U('album/addHuifu');?>" method="post">
	                  <input type="hidden" name="albumid" value="<?php echo ($album["id"]); ?>" />
	                  <input type="hidden" name="commentid" value="<?php echo ($com["id"]); ?>" />
	                  <div><textarea type="text" style="width:98%;" name='con' class="comment-text" id="comment-text" placeholder="写点什么吧..." rows="2"></textarea></div>                 
	                  <div style='float:left;'><span class="emotion"><i class="fa fa-smile-o fa-lg"></i></span>&nbsp;</div>
	                  <div style="float:right;"><font class='comm'>0</font>/140 &nbsp;<input type='submit' class="btn btn-primary" value="发表"></div>
	                 
	                  <div style="clear:both;"></div>
	                  </form>
	                 </div>            
	             </div>       
			  </div><?php endforeach; endif; else: echo "" ;endif; ?>
 
			  
		</div>
			  <div class="pagination pagination-centered">
			  <ul>
			    <?php echo ($pagebar); ?>
			  </ul>
			</div>
        </div>        
	</div>
	
	<div style="display:none; width:800px;min-height:500px; padding:10px;" class="hide-xiangce">
	<form action="<?php echo U('album/yidong');?>" method="post" id="hide-form" >
		<input type="hidden" id="hidden-yidong" name='yidong-pid' />
		<input type="hidden"  name='yidong-aid' />
	</form>

	  <div>
	     <ul style="list-style:none;">	       
	        <?php if(is_array($alist)): $i = 0; $__LIST__ = $alist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$al): $mod = ($i % 3 );++$i;?><li style='padding:4px;margin:4px;width:180px;float:left;cursor:pointer;' data-aid="<?php echo ($al["id"]); ?>">
	        <img data-src="holder.js/300x200" alt="300x200" src="/Uploads<?php echo ((isset($al["fengmian"]) && ($al["fengmian"] !== ""))?($al["fengmian"]):'/none.png'); ?>" style="width:100px;height:100px;">	                 	                 
	        <span>
	        <?php echo ($al["name"]); ?>
	        </span>
	       <?php if(($mod) == "2"): endif; ?>
	       </li><?php endforeach; endif; else: echo "" ;endif; ?>	       
	     </ul>
	    <div style="clear:both;"></div>

	    <button class="btn submit-yidong">移动</button>
	  </div>
	  <script>
	  $(function(){
		  $('.hide-xiangce li').click(function(){
			  $(this).siblings('li').removeClass('xuan');
			  $(this).addClass('xuan');
		  });
		  
		  $('.submit-yidong').click(function(){
				var aid =  $('.xuan').attr('data-aid');
				
				if(aid == ""){
					layer.alert('请选择一个相册');
					return false;
				}
				$('input[name=yidong-aid]').val(aid);
				$('#hide-form').submit();
			  });
		  
	  })
	  </script>
	</div>
	

    </div>
</div>

<script type="text/javascript">
    $(function(){
        $(window).resize(function(){
            $("#main-container").css("min-height", $(window).height() - 343);
        }).resize();
    })
</script>
	<!-- /主体 -->

	<!-- 底部 -->
	 <button id="back-to-top" style="position:fixed;top:800px;right:50px;display:none;"><i class="fa fa-chevron-up fa-2x"></i></button>
 <<script type="text/javascript">
$(function(){
    $(window).scroll(function(){  
        if ($(window).scrollTop()>100){  
            $("#back-to-top").fadeIn(500);  
        }  
        else  
        {  
            $("#back-to-top").fadeOut(500);  
        }  
    });  

    //当点击跳转链接后，回到页面顶部位置  

    $("#back-to-top").click(function(){  
        $('body,html').animate({scrollTop:0},200);  
        return false;  
    }); 
})
</script>
    <!-- 底部
    ================================================== -->
    <footer class="footer">
      <div class="container">
          <p> 本站由 <strong><a href="http://www.onethink.cn" target="_blank">OneThink</a></strong> 强力驱动</p>
      </div>
    </footer>

<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "", //当前网站地址
		"APP"    : "", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>


<script src="/Public/static/prettyPhoto/js/jquery.prettyPhoto.js"></script>
<script src="/Public/static/bootstrap-dropdown-hover-master/dist/jquery.bootstrap-dropdown-hover.min.js"></script>
<script src="/Public/static/jQuery-qqFace/js/jquery-browser.js"></script>
<script src="/Public/static/jQuery-qqFace/js/jquery.qqFace.js"></script>
<script src="/Public/static/style.js"></script>
<script>
$(function(){
	
	//删除相册
	$('.delete-album').click(function(){
		var aid = $(this).attr('data-aid');
	      layer.confirm('您确定要删除么',function(){
	    	  window.location.href="<?php echo U('album/deletealbum');?>?aid="+aid;
	});
	});
	//删除相片
	$('.delete-pic').click(function(){
		var pid = $(this).attr('data-pid');
      layer.confirm('您确定要删除么',function(){
    	  window.location.href="<?php echo U('album/deletepic');?>?pid="+pid;
      });

	});
	
	//移动相册
	$('.shift-ab').click(function(){
		var pid = $(this).attr('data-pid');
		$('#hidden-yidong').val(pid);
		//捕获页
		layer.open({
		  area: 'auto',
		  maxWidth:'800px',
		  type: 1,
		  shade: 0.6,
		  title: '选择相册', //不显示标题
		  content: $('.hide-xiangce'), //捕获的元素
		  cancel: function(index){
		    layer.close(index);
		    this.content.show();
		  }
		});
	});
	
	//回复 折叠
	$('.show-huifu').click(function(){
		$(this).parents('.row-fluid').find('.coll').toggle();
	});
	
	//加载更多
	$('.load-more').click(function(){
		var p = $(this).attr('data-page');
		var this_ = $(this);
		var id = "<?php echo ($album["id"]); ?>";
		$.get('<?php echo U("Album/loadMoreComment");?>',{'p':p,'id':id},function(data){
			$('.comment-body').append(data);
			p = parseInt(p);
			this_.attr('data-page',p+1);
		});
	});
/////////////////////////////////////	
	
	//点击删除回复
	$('.delete-hui').click(function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		layer.confirm('您确定要删除吗',{},function(){
			 
			 $.post('<?php echo U("album/deleteComment");?>',{'id':cid},function(data){
				 if(data.status == 1){
					 this_.parents('.row-fluid').remove();
					 layer.msg('删除成功', {icon: 1});
				 }else{
					 layer.alert(data.msg);
				 }
			 },'json');
		});
	});
	
	$('body').on('click','.delete-hui',function(){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		layer.confirm('您确定要删除吗',{},function(){
			 
			 $.post('<?php echo U("album/deleteComment");?>',{'id':cid},function(data){
				 if(data.status == 1){
					 this_.parents('.row-fluid').remove();
					 layer.msg('删除成功', {icon: 1});
				 }else{
					 layer.alert(data.msg);
				 }
			 },'json');
		});
	})
///////////////////////////////////////////////	
	//点赞
	$('.zan').click(function(){
		if($(this).hasClass('dianzan')){
				var this_ = $(this);
				var cid = $(this).attr('data-id');
				$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'dian'},function(data){
					if(data.status == 1){
					    this_.removeClass('dianzan').addClass('quxiao');
					    this_.css('color','red');
					    layer.msg('成功', {icon: 1});
					}else{
						layer.alert(data.msg);
					}
				},'json');
			
		}else if($(this).hasClass('quxiao')){
			var this_ = $(this);
			var cid = $(this).attr('data-id');
			$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'quxiao'},function(data){
				if(data.status == 1){
				    this_.removeClass('quxiao').addClass('dianzan');
				    this_.css('color','');
				    layer.msg('成功', {icon: 1});
				}else{
					layer.alert(data.msg);
				}
			},'json');
		}
	});

	$('body').on('click','.zan',function(){
		if($(this).hasClass('dianzan')){
			var this_ = $(this);
			var cid = $(this).attr('data-id');
			$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'dian'},function(data){
				if(data.status == 1){
				    this_.removeClass('dianzan').addClass('quxiao');
				    this_.css('color','red');
				    layer.msg('成功', {icon: 1});
				}else{
					layer.alert(data.msg);
				}
			},'json');
		
	}else if($(this).hasClass('quxiao')){
		var this_ = $(this);
		var cid = $(this).attr('data-id');
		$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'quxiao'},function(data){
			if(data.status == 1){
			    this_.removeClass('quxiao').addClass('dianzan');
			    this_.css('color','');
			    layer.msg('成功', {icon: 1});
			}else{
				layer.alert(data.msg);
			}
		},'json');
	}
	});

	
////////////////////////////////////////////	
	
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
	
	//发布
	$('.submit-comment').click(function(){
		
		var con = $('.comment-text').val();
		var aid = $('input[name=albumid]').val();

		if(con == ''){
			layer.alert('评论内容不能为空');
			return false;
		}
		if(con.length > 140){
			layer.alert('评论内容长度超过限制');
			return false;
		}
	
           $.post('<?php echo U("album/addComment");?>',{'aid':aid,'con':con},function(data){
			if(data.status == 1){
				layer.alert('提交成功',function(){
					window.location.reload();
				});
				
			}else{
				layer.alert(data.msg);
			}
		},'json'); 
		
	});
	
	//表情
	$('.emotion').qqFace({ 
		id : 'facebox',
        assign:'comment-text', //给输入框赋值 
        path:'/Public/static/jQuery-qqFace/arclist/'    //表情图片存放的路径 
    }); 
	
	
	$("a[rel^='prettyPhoto']").prettyPhoto({
		animation_speed:'fast',
		theme:'facebook',
		social_tools:'',
	});
	
	
	$('body').on('blur','.comment-text',function(){
		$('.example').popover('hide')
	});
	
	$('.example').popover({
		'html':true,
	});
	 
  
});
</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>