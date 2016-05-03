<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;
class BannerPositionModel extends CommonModel{
    
    public function __construct(){
        parent::__construct();
    }

    public function gets(){
        return $this->where(
            array(parent::FIELD_IS_DEL => parent::DEL_NO)
        )->select();
    }
}