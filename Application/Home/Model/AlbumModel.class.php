<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: huajie <banhuajie@163.com>
// +----------------------------------------------------------------------

namespace Admin\Model;
use Think\Model;
use Think\Upload;


class AlbumModel extends Model{
   
       /* 自动验证规则 */
    protected $_validate = array(
        array('name', 'require', '行为标识必须', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '/^[a-zA-Z]\w{0,39}$/', '标识不合法', self::MUST_VALIDATE, 'regex', self::MODEL_BOTH),
        array('name', '', '标识已经存在', self::MUST_VALIDATE, 'unique', self::MODEL_BOTH),
    );

}
