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
   	$count = $album->where($where)->count();
   	$Page = new \Think\Page($count,10);
   	$show = $Page->show();
   	$list = $album->order("id desc")->where($where)->limit($Page->firstRow.','.$Page->listRows)->select();
   	
   	
   	
   	$this->assign('_page',$show);
   	$this->assign('_list',$list);
   	$this->display();
   	
   	$this->display();
   }
   
   public function detail(){
   	$this->display();
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
