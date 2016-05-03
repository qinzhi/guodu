<?php
namespace Weixin\Controller;
class GoodsController extends WeixinController {

    public function index(){
        $this->assign('nav_type',2);
        $this->display();
    }
}