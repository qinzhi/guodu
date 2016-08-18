<?php
namespace Weixin\Controller;
class IndexController extends WeixinController {
    public function index(){
        D('Common/Wechat','Service');

        $banners = D('Admin/Banner')->getBannersByPositionId(1);
        $this->assign('banners',$banners);

        $goods = D('Goods')->getGoods();

        $this->assign('goods',$goods);

        $this->assign('nav_type',1);
        $this->display();
    }
}