<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

class AlbumController extends UCommonController {

   public function index(){
   	

   	$album = D('Album');
   	$where = array();
   	if(I('get.type')){
   		 $where['type'] = I('get.type');
   		 $this->assign('type',I('get.type'));
   	}
   	$count = $album->where($where)->count();
   	$Page = new \Think\Page($count,6);
   	$show = $Page->my_show();
   	$list = $album->order("id desc")->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
   	
   	$leixing = C('ALBUM_THEME');
   	$this->assign('leixing',$leixing);
   	
   	$this->assign('_page',$show);
   	$this->assign('_list',$list);
   	$this->display();
   }
   
   public function detail(){
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
