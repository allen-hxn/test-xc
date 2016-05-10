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
   	$page = new Page($count, 8);
   	$show = $page->my_show();
   	$pic = M('album_pic')->where($where)->limit($page->firstRow.','.$page->listRows)->select();
   	
   	$where2['aid'] = I('id');
   	$comments = M('album_comments')->where($where2)->select();
   	$this->assign('comments',$comments);
   	
   	$this->assign('pagebar',$show);
   	$this->assign('album',$album);
   	$this->assign('pic',$pic);
   	$this->display();
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
