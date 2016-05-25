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


<style>


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
	  <li><a href="<?php echo U('Album/detail',array('id'=>$album['id']));?>"><?php echo ($album["name"]); ?></a> <span class="divider">/</span></li>
	  <li class="active">详细</li>
	</ul>
   </div>
	  	
	<div class="row-fluid" >
	<div class="span6">
	<img data-src="holder.js/260x180" data-lightbox="image-box-set" data-title="My caption" alt="260x180" src="/Uploads<?php echo ($pic["path"]); ?>"  style="width: 100%;">
	</div>
    <div class="span6">
    <!--  -->
              <div class="comment" style="padding:20px 0px;">
	          <div class='row-fluid'>
		          <div class="span6" style="text-algin:left;"><h4><?php echo ($comments_count); ?>条评论，<?php echo ($canyu); ?>人参与。</h4></div>
		          <div class="span6" style="margin-top:10px;"><div style="float:right;"><i class="fa fa-star fa-lg"></i></div></div>

	          </div>
	          
	          <div class='comment-content'>
	             <div style="float:left;width:7%;"><img  class="img-rounded"  src="/Uploads/album/20160509/57302d4d014c4.jpg" width="45" height="45" /></div>
	             <div style="float:right; width:92%;">
	             <form action="<?php echo U('album/addPicComment');?>" method="post">
	             <input type="hidden" name="pid" value="<?php echo ($pic["pid"]); ?>" />
	                  <div><textarea type="text" style="width:99%;" class="comment-text" id="comment-text" name='con' placeholder="写点什么吧..." rows="5"></textarea></div>                 
	                  <div style='float:left;'><span class="emotion"><i class="fa fa-smile-o fa-lg"></i></span>&nbsp;</div>
	                  <div style="float:right;"><font class='comm'>0</font>/140 &nbsp;<input type='submit' class="btn btn-primary" value="发布"></div>
	                  <div style="clear:both;"></div>
	             </div>
	             </form>	             
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
	             <div style="float:right; width:92%;">
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
    </div>
         
          
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
		"APP"    : "/index.php?s=", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>

<script src="/Public/static/bootstrap-dropdown-hover-master/dist/jquery.bootstrap-dropdown-hover.min.js"></script>
<script src="/Public/static/jQuery-qqFace/js/jquery-browser.js"></script>
<script src="/Public/static/jQuery-qqFace/js/jquery.qqFace.js"></script>
<script src="/Public/static/style.js"></script>
<script>
$(function(){

	//回复 折叠
	$('.show-huifu').click(function(){
		var did = $(this).attr('data-target');
		$(did).toggle();
	});
	
	
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
	$('body').on('click','delete-hui',function(){
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
				$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'dian','flag':'pic'},function(data){
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
			$.post('<?php echo U("album/editZan");?>',{'id':cid,'type':'quxiao','flag':'pic'},function(data){
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
	
	$('.emotion').qqFace({ 
        assign:'comment-text', //给输入框赋值 
        path:'/Public/static/jQuery-qqFace/arclist/'    //表情图片存放的路径 
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