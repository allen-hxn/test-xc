<?php
namespace Admin\Controller;

use Think\Controller;

class AlbumController extends AdminController{
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
}