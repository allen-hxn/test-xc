<?php if (!defined('THINK_PATH')) exit(); if(is_array($comments)): $i = 0; $__LIST__ = $comments;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$com): $mod = ($i % 2 );++$i;?><div class='row-fluid' style="padding:10px 0px;border-top: 1px dotted #ccc;">
			    <div style="float:left;width:7%;"><img  class="img-rounded"  src="/Public/Home/images/noone.jpg" width="45" height="45" /></div>
	             <div style="float:right; width:93%;">
	                   <div style=" word-wrap: break-word; word-break: break-all;margin-bottom: 10px;">
	                                         <a href="javascript:;"><?php echo ($com["username"]); ?></a>:<?php echo (ubbreplace($com["comment"])); ?>
	                   </div>
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
	                  <input type="hidden" name="albumid" value="<?php echo ($album["id"]); ?>" />
	                  <div><textarea type="text" style="width:98%;" class="comment-text" id="comment-text" placeholder="写点什么吧..." rows="2"></textarea></div>                 
	                  <div style='float:left;'><span class="emotion"><i class="fa fa-smile-o fa-lg"></i></span>&nbsp;</div>
	                  <div style="float:right;"><font class='comm'>0</font>/140 &nbsp;<button class="btn btn-primary submit-comment">发表</button></div>
	                  <div style="clear:both;"></div>
	                 </div>            
	             </div>       
			  </div><?php endforeach; endif; else: echo "" ;endif; ?>