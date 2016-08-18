<?php
namespace Weixin\Controller;
use Think\Controller;
class WeixinController extends Controller {

    public $cart_num;

    public function notify(){

    }

    public function _initialize(){

        if(!IS_AJAX){

            $this->cart_num = D('Cart')->getNum();
            $this->assign('cartNum',$this->cart_num);

        }

        $this->assign('version','1.0');
    }

}