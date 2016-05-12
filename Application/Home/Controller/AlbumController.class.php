<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use Think\Upload;
use Think\Page;
class AlbumController extends UCommonController {

   public function index(){
   	
   	$album = D('Album');
   	$where = array();
   	$where['user_id'] = session('user_auth.uid');
   	if(I('get.type')){
   		 $where['type'] = I('get.type');
   		 $this->assign('type',I('get.type'));
   	}
   	$count = $album->where($where)->count();
   	$Page = new \Think\Page($count,6);
   	$show = $Page->my_show();
   	$list = $album->order("id desc")->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
   	foreach($list as $key=>$val){
   		$list[$key]['count'] = M('album_pic')->where(array('aid'=>$val['id']))->count();
   	}
   	
   	$leixing = C('ALBUM_THEME');
   	$this->assign('leixing',$leixing);
   	
   	$this->assign('_page',$show);
   	$this->assign('_list',$list);
   	$this->display();
   }
   
   public function detail(){
   	
   	$album = M('album')->where(array('id'=>I('id')))->find();
   	
   	$where['aid'] = I('id');
   	$where['status'] = 0;
   	$count = M('album_pic')->where($where)->count();
   	$pic = M('album_pic')->where($where)->order('addtime desc')->select();
   	
   	$pic_count = M('album_pic')->where(array('aid'=>I('id')))->count();
   	
   	$where2['aid'] = I('id'); 	
   	$commetns_count = M('album_comments')->where($where2)->count();
   	$page = new Page($commetns_count, 5);
   	$show = $page->my_show();
   	$comments = M('album_comments')->where($where2)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
   	
   	$canyu = M('album_comments')->where($where2)->distinct(true)->field('add_uid')->select();
    $canyu = count($canyu);
    
   	foreach ($comments as $key=>$val){
   		$comments[$key]['zan'] = M('album_comments_zan')->where(array('com_id'=>$val['id']))->count();//点赞数
   		
   		$is = M('album_comments_zan')->where(array('com_id'=>$val['id'],'uid'=>session('user_auth.uid')))->find();
   		empty($is)?$comments[$key]['isZan']=0:$comments[$key]['isZan']=1;
   		
   		$userinfo = M('ucenter_member')->where(array('id'=>$val['add_uid']))->find();
   		$comments[$key]['username'] = $userinfo['username'];
   		
   		if($val['parent_id']){
   			$comments[$key]['sub'] = M('album_comments a')->field('a.*,b.username')->join('left join ab_ucenter_member b on a.add_uid =b.id')->where(array('a.id'=>$val['parent_id']))->find();
   		}
   	}
   	$this->assign('comments',$comments);

   	$alist = M('album')->select();
   	$this->assign('alist',$alist);
   	$this->assign('pic_count',$pic_count);
   	$this->assign('comments_count',$commetns_count);
   	$this->assign('canyu',$canyu);
   	$this->assign('pagebar',$show);
   	$this->assign('album',$album);
   	$this->assign('pic',$pic);
   	$this->display();
   }
   
   public function loadMoreComment(){
   	$where2['aid'] = I('id');
   	$commetns_count = M('album_comments')->where($where2)->count();
   	$page =new Page($commetns_count, 5);
   	$show = $page->show();
   	$comments = M('album_comments')->where($where2)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
   	foreach ($comments as $key=>$val){
   		$comments[$key]['zan'] = M('album_comments_zan')->where(array('com_id'=>$val['id']))->count();//点赞数
   		 
   		$is = M('album_comments_zan')->where(array('com_id'=>$val['id'],'uid'=>session('user_auth.uid')))->find();
   		empty($is)?$comments[$key]['isZan']=0:$comments[$key]['isZan']=1;
   		 
   		$userinfo = M('ucenter_member')->where(array('id'=>$val['add_uid']))->find();
   		$comments[$key]['username'] = $userinfo['username'];
   	}
   	
   	$this->assign('comments',$comments);
   	$content = $this->fetch('Album:comments');
   	echo $content;
   }
   
   public function add(){
   if(IS_POST){
			$ab = D('Album');
			if($ab->create()){
				$ab->addtime = time();
				$ab->addip = get_client_ip();
				$ad->user_id = session('user_auth.uid');
				if($ab->add()){
					$this->success('相册添加成功',U('album/index'));
				}else{
					$this->error('相册添加失败');
				}
			}else{
				$this->error($ab->getError());
			}
		}else{
			
			$leixing = C('ALBUM_THEME');
			$this->assign('leixing',$leixing);			
			$this->display();
		}
   }
   
   public function edit(){
   	if(IS_POST){
			$album = M('Album');
			$data['id'] = I('id');
			$data['name'] = I('name');
			$data['info'] = I('info');
			$data['type'] = I('type');
			
   			if($album->save($data)){
   				$this->success('相册修改成功',U('album/index'));
   			}else{
   				$this->error('相册修改失败');
   			}
   	}else{
   			
   		if(I('id')){
   			$ab = M('album')->where(array('id'=>I('id')))->find();
   			$this->assign('ab',$ab);
   			$leixing = C('ALBUM_THEME');
   			$this->assign('leixing',$leixing);
   			$this->display();
   		}else{
   			$this->error('访问错误');
   		}
   		  		 		
   	}
   }
   
   /*
    * 图片上传
    */
   public function upload(){ 	
	   	if(IS_POST){
	   		$config = array(
	   				'maxSize'    =>    3145728,
	   				'rootPath'   =>    './Uploads/',
	   				'savePath'   =>    '/album/',
	   				'saveName'   =>    array('uniqid',''),
	   				'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
	   				'autoSub'    =>    true,
	   				'subName'    =>    array('date','Ymd'),
	   		);
	   		$upload = new \Think\Upload($config);// 实例化上传类
	   		
	   		$res['status'] =0;
	   		
	   		$info   =   $upload->upload();// 上传单个文件
	   		if(!$info) {// 上传错误提示错误信息
	   			$res['msg'] = $upload->getError();
	   		}else{// 上传成功 获取上传文件信息
	   			
	   			
	   			foreach($info as $file){
	   				$data = array();
	   				$data['path'] = $file['savepath'].$file['savename'];
	   			    $data['filesize'] = $file['size'];
	   			    $data['filename'] = $file['savename'];
	   			    $data['aid']      = $_POST['id'];
	   			    $data['addtime']  = time();
	   			    $data['addip']    = get_client_ip();
	   			    
	   			    $res = M('album_pic')->add($data);
	   			}
	   			$res['status'] = 1;
	   			$res['msg'] = 'succ';
	   		}
	   		
	   		exit(json_encode($res));
	   		
	   	}else{
	   		
	   		if(I('aid')){
	   			$album = M('album')->where(array('id'=>I('aid')))->find();
	   			$this->assign('al',$album);
	   		}

	   		$ab = D('Album');
	   		$where['user_id'] = session('user_auth.uid');
	   		$list = $ab->where($where)->select();	   		
	   		$data = getArrayKeyVal($list,'id',"name");//获取一维数组
	   		
	   		$this->assign('ab',$data);
	   		$this->display();
	   	}
   }
   
   public function picDetail(){
   	
   	$d['id'] =I('aid');
   	$album = M('album')->where($d)->find();
   
   	
   	$data['pid'] = I('pid');
   	$pic = M('album_pic')->where($data)->find();
   	  	
   	$where2['pid'] = I('pid');
   	$comments_count = M('album_pic_comments')->where($where2)->count();
   	$page = new Page($comments_count,5);
   	$show = $page->my_show();
   	$comments = M('album_pic_comments')->where($where2)->order('addtime desc')->limit($page->firstRow.','.$page->listRows)->select();
   	
   	$canyu = M('album_pic_comments')->where($where2)->distinct(true)->field('add_uid')->select();
   	$canyu = count($canyu);
 
   	foreach ($comments as $key=>$val){
 		$comments[$key]['zan'] = M('album_pic_comments_zan')->where(array('com_id'=>$val['id']))->count();//点赞数
   		 
   		$is = M('album_pic_comments_zan')->where(array('com_id'=>$val['id'],'uid'=>session('user_auth.uid')))->find();
   		empty($is)?$comments[$key]['isZan']=0:$comments[$key]['isZan']=1; 
   		 
   		$userinfo = M('ucenter_member')->where(array('id'=>$val['add_uid']))->find();
   		$comments[$key]['username'] = $userinfo['username'];
   		 
    	if($val['parent_id']){
    			$comments[$key]['sub'] = M('album_pic_comments a')->field('a.*,b.username')->join('left join ab_ucenter_member b on a.add_uid =b.id')->where(array('a.id'=>$val['parent_id']))->find();
   		} 
   	}
   	
   	$this->assign('album',$album);
   	$this->assign('comments',$comments);
   	$this->assign('pagebar',$show);
   	$this->assign('comments_count',$comments_count);
   	$this->assign('canyu',$canyu);
   	$this->assign('pic',$pic);
   	$this->display();
   }
   
   public function addPicComment(){
   	if(IS_POST){
   		$data['pid'] = I('pid');
   		$data['comment'] = I('con');
   		$data['add_uid'] = session('user_auth.uid');
   		$data['addtime'] = time();
   		$res = M('album_pic_comments')->add($data);
   		
   		
   		if($res){
   			$this->success('发布成功');
   		}else{
   			$this->error('操作失败');
   		}
   	}else{
   		$this->error('错误操作');
   	}
   }
   
   /**
    * 设置封面
    */
   public function setFengmian(){
   	  if(I('aid')){
   	  	$pic = M('album_pic')->where(array('pid'=>I('id')))->find();
   	  	$data['fengmian'] = $pic['path'];
   	  	$res = M('album')->where(array('id'=>I('aid')))->save($data);
   	  	if($res){
   	  		$this->success('修改成功');
   	  	}else{
   	  		$this->error('修改失败');
   	  	}
   	  }else{
   	  	$this->error('错误操作','album/index');
   	  }
   }
   
   
   public function addComment(){
   	if(IS_POST){
   		$data['aid'] = I('aid');
   		$data['comment'] = I('con');
   		$data['add_uid'] = session('user_auth.uid');
   		$data['addtime'] = time();
   		$res = M('album_comments')->add($data);
   		if($res){
   			$json['status'] = 1;
   			$json['msg'] = 'succ';
   		}else{
   			$json['status'] = 0;
   			$json['msg'] = '失败';
   		}
   		exit(json_encode($json));
   	}else{
   		$this->error('错误操作');
   	}
   }
   
   public function addHuifu(){
   	if(IS_POST){
   		$data['aid'] = I('albumid');
   		$data['comment'] = I('con');
   		$data['add_uid'] = session('user_auth.uid');
   		$data['addtime'] = time();
   		$data['parent_id'] =I('commentid');
   		$res = M('album_comments')->add($data);
       if($res){
       	$this->success('发布成功');
       }else{
       $this->error('发布失败');
       }
   	}else{
   		$this->error('错误操作');
   	}
   }
   
   public function deleteComment(){
   	  if(IS_POST){
   	  	$data['id'] = I('id');
   	  	$res = M('album_comments')->where($data)->delete();
   	  	if($res){
   			$json['status'] = 1;
   			$json['msg'] = 'succ';
   		}else{
   			$json['status'] = 0;
   			$json['msg'] = '失败';
   		}
   		exit(json_encode($json));
   	  }else{
   	  	$this->error('错误操作');
   	  }
   }
   
   public function editZan(){
	   	if(IS_POST){
	   		
	   		if(I('flag') == 'pic'){
	   			if(I('type') == 'dian'){
	   				$data['com_id'] = I('id');
	   				$data['uid'] = session('user_auth.uid');
	   				$res = M('album_pic_comments_zan')->add($data);
	   				if($res){
	   					$json['status'] = 1;
	   					$json['msg'] = 'succ';
	   				}else{
	   					$json['status'] = 0;
	   					$json['msg'] = '失败';
	   				}
	   					
	   				 
	   			}elseif(I('type') == 'quxiao'){
	   				$where['com_id'] = I('id');
	   				$where['uid'] = session('user_auth.uid');
	   				$res = M('album_pic_comments_zan')->where($where)->delete();
	   				if($res){
	   					$json['status'] = 1;
	   					$json['msg'] = 'succ';
	   				}else{
	   					$json['status'] = 0;
	   					$json['msg'] = '失败';
	   				}
	   			}
	   			exit(json_encode($json));
	   		}else{
	   			if(I('type') == 'dian'){
	   				$data['com_id'] = I('id');
	   				$data['uid'] = session('user_auth.uid');
	   				$res = M('album_comments_zan')->add($data);
	   				if($res){
	   					$json['status'] = 1;
	   					$json['msg'] = 'succ';
	   				}else{
	   					$json['status'] = 0;
	   					$json['msg'] = '失败';
	   				}
	   				 
	   			
	   			}elseif(I('type') == 'quxiao'){
	   				$where['com_id'] = I('id');
	   				$where['uid'] = session('user_auth.uid');
	   				$res = M('album_comments_zan')->where($where)->delete();
	   				if($res){
	   					$json['status'] = 1;
	   					$json['msg'] = 'succ';
	   				}else{
	   					$json['status'] = 0;
	   					$json['msg'] = '失败';
	   				}
	   			}
	   			exit(json_encode($json));
	   		}
	   		
	   	}
   }
   
   public function yidong(){
   	if(IS_POST){

   		$data['aid'] =  I('yidong-aid');
   		$where['pid'] = I('yidong-pid');
   		$res = M('album_pic')->where($where)->save($data);
   		if($res){
   			$this->success('移动成功');
   		}else{
   			$this->error('移动失败');
   		}
   	}else{
   		$this->error('错误操作');
   	}
   }
   
   public function deletepic(){
   	  $prefix = C('DB_PREFIX');
   	  $data['pid'] = I('pid');
   	  $pic = M('album_pic ap')->join(' left join '.$prefix.'album ab on ab.id = ap.aid')->where($data)->find();
//    	  dump($pic);
//    	  dump(M()->getLastSql());exit;
   	  if($pic['user_id'] != session('user_auth.uid')){
   	  	$this->error('您没有删除资格');
   	  }
   	  $res = M('album_pic')->where($data)->delete();
   	  if($res){
   	  	unlink('./Uploads'.$pic['path']);
   	  	$this->success('删除成功');
   	  }else{
   	  	$this->error('删除失败');
   	  }
   }
   
  public function deletealbum(){
  	$prefix = C('DB_PREFIX');
  	$data['id'] = I('aid');
    $album = M('album')->where($data)->find();
  	if($album['user_id'] != session('user_auth.uid')){
  		$this->error('您没有删除资格');
  	}
  	$pid = M('album_pic')->where(array('aid'=>I('aid')))->count();
  	if($pid != 0){
  		$this->error('该相册还有相片，请先清空');
  	}
  	$res = M('album')->where($data)->delete();
  	if($res){
  		$this->success('删除成功',U('album/index'));
  	}else{
  		$this->error('删除失败');
  	}
  }
   
   /* 文档分类检测 */
   private function category($id = 0){
   	/* 标识正确性检测 */
   	$id = $id ? $id : I('get.category', 0);
   	if(empty($id)){
   		$this->error('没有指定文档分类！');
   	}
   
   	/* 获取分类信息 */
   	$category = D('Category')->info($id);
   	if($category && 1 == $category['status']){
   		switch ($category['display']) {
   			case 0:
   				$this->error('该分类禁止显示！');
   				break;
   				//TODO: 更多分类显示状态判断
   			default:
   				return $category;
   		}
   	} else {
   		$this->error('分类不存在或被禁用！');
   	}
   }
}
