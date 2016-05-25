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
        
   <div class="container">
   	<ul class="breadcrumb">
	  <li><a href="<?php echo U('Index/index');?>">首页</a> <span class="divider">/</span></li>
	  <li><a href="<?php echo U('Album/index');?>">相册</a><span class="divider">/</span></li>
	  <li class='active'>
	  <?php if($type == 1): ?>最爱
	   <?php elseif($type == 2): ?>
	   风景
	   <?php elseif($type == 3): ?>
	   美食
	   <?php elseif($type == 4): ?>
	   怀恋
	   <?php else: ?>
	       全部<?php endif; ?>
	  </li>
	</ul>
	<a class="btn btn-primary" style="margin-left:13px;" href="<?php echo U('album/add');?>">添加相册</a>
	<a class="btn btn-primary" style="margin-left:13px;" href="<?php echo U('album/upload');?>">上传照片</a>
   </div>
   <div class="span3 bs-docs-sidebar">    
        <ul class="nav nav-list bs-docs-sidenav">
            <li>
			    <a href="<?php echo U('Album/index');?>">
				<i class="icon-chevron-right"></i>全部</a>
		    </li>
        <?php if(is_array($leixing)): foreach($leixing as $k=>$vo): ?><li>
			    <a href="<?php echo U('album/index',array('type'=>$k));?>">
				<i class="icon-chevron-right"></i><?php echo ($vo); ?></a>
		    </li><?php endforeach; endif; ?>	       
	   </ul>
    </div>
   

        
    <div class="span9">
        <section id="contents">	
				
			<div class="row-fluid">
			 
              <ul class="thumbnails">
				<?php if(is_array($_list)): $k1 = 0; $__LIST__ = $_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$item): $mod = ($k1 % 3 );++$k1;?><li class="span4">
	                <div class="thumbnail">
	                  <a href="<?php echo U('album/detail',array('id'=>$item['id']));?>">
					  <img data-src="holder.js/300x200" alt="300x200" src="/Uploads<?php echo ((isset($item["fengmian"]) && ($item["fengmian"] !== ""))?($item["fengmian"]):'/none.png'); ?>" style="width:100%;height:200px;">	                 
	                 </a>
	                  <strong style="position:relative;top:-31px;right:-81%; font-size:20px;color:white;"><?php echo ((isset($item["count"]) && ($item["count"] !== ""))?($item["count"]):0); ?></strong>
	                  <div class="caption" style="margin-top:-20px;">
	                    
	                    <div style="float:left;">
	                    <h4><a href="<?php echo U('album/detail',array('id'=>$item['id']));?>"><?php echo ($item["name"]); ?></a></h4>
		                    
	                    </div>
						<div style="float:right;     margin-top: 16px;text-align:right;">
						  <i class="icon-thumbs-up" title="赞"></i>12
		                    <i class="icon-comment" title="评论"></i>100
						</div>
	                     <div style="clear:both;"></div>              
	                  </div>
	                </div>
	              </li>
	              
	              <?php if(($mod) == "2"): ?></ul>
		             </div>
		             <div class="row-fluid">
		                <ul class="thumbnails"><?php endif; endforeach; endif; else: echo "" ;endif; ?>
			   </ul>
             </div>
			
        </section>
        
         <div class="pagination pagination-centered">
			  <ul>
			    <?php echo ($_page); ?>
			  </ul>
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
		"APP"    : "", //当前项目地址
		"PUBLIC" : "/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>
 <!-- 用于加载js代码 -->
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
<div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
</div>

	<!-- /底部 -->
</body>
</html>