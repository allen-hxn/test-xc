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

<link rel="stylesheet" href="/Public/static/uploadify/uploadify.css">  
<style>
.bar {
    height: 18px;
    background: green;
}
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
        
<div class="container">
   	<ul class="breadcrumb">
	  <li><a href="<?php echo U('Index/index');?>">首页</a> <span class="divider">/</span></li>
	  <li><a href="<?php echo U('Album/index');?>">相册</a><span class="divider">/</span></li>
	  <li class="active" >上传照片</li>
	</ul>
</div>

        
<div class="span12">

<h4>上传照片</h4>
		<form class="login-form" action="/index.php?s=/Home/album/upload/aid/3.html" method="post">
		
				<div class="control-group">
		            <label class="control-label" >相册</label>
		            <div class="controls">
		            <?php if(empty($al)): ?><select id="album" name="album" onchange="" ondblclick="" class="" ><?php  foreach($ab as $key=>$val) { ?><option value="<?php echo $key ?>"><?php echo $val ?></option><?php } ?></select>
		            <?php else: ?>
		                <select name="album" id="album"  >
		                <option value="<?php echo ($al["id"]); ?>"><?php echo ($al["name"]); ?></option>
		                </select><?php endif; ?>
		                
		            </div>
		          </div>
		          
				<span>
				<input type="file" name="file_upload" id="file_upload" />
				</span>
               
                <a href="javascript:$('#file_upload').uploadify('upload', '*')" class="btn btn-primary"><i class="icon-upload icon-white"></i>开始上传</a>
                <a href="javascript:$('#file_upload').uploadify('stop')" class="btn btn-warning"><i class="icon-upload icon-white"></i>停止上传</a>
                
               <!--  <a href="javascript:$('#file_upload').uploadify('cancel')" class="btn btn-danger"><i class="icon-remove icon-white"></i>取消首文件</a> -->
                <a href="javascript:$('#file_upload').uploadify('cancel','*')" class="btn btn-danger"><i class="icon-remove icon-white"></i>清除所有</a>
                
				        <div id="progress">
						    <div class="bar" style="width: 0%;"></div>
						</div>
		            </div>
		          </div>
				<p>注意：单张图片文件大小不超过1M</p>
        </form>
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

<script src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
<script src="/Public/static/layer-pc/layer.js"></script>

<script>
$(function () {
	    
	    $("#file_upload").uploadify({
	    	auto:false,
	    	fileObjName:'albumimage',
	    	fileSizeLimit:'1MB',
	    	removeCompleted : false,
	    	buttonText    :'选择文件',
	        swf           : "/Public/static/uploadify/uploadify.swf",
	        uploader      : '<?php echo U("album/upload");?>',
	        onQueueComplete: function(queueData) {
	            layer.alert(queueData.uploadsSuccessful + ' files were successfully uploaded.');
	        },
	        'onUploadStart': function (file) {  
                $("#file_upload").uploadify("settings", "formData", { 'id':  $('#album').val()});  
                //在onUploadStart事件中，也就是上传之前，把参数写好传递到后台。  
            },
	        'onUploadSuccess' : function(file, data, response) {
	        	console.log(data);
	        	var d = eval("("+data+")");
	        	if(d.status == 1){
	        		layer.alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + d.msg);
	        	}else{
	        		layer.alert(d.msg);
	        	}
	            
	        }
	        
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