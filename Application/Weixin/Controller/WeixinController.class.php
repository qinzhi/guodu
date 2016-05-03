<?php
namespace Weixin\Controller;
use Think\Controller;
class WeixinController extends Controller {
    public function _initialize(){
        $this->assign('version','1.0');
    }
}