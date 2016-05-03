<?php
namespace Weixin\Controller;
class IndexController extends WeixinController {
    public function index(){

        $banners = D('Admin/Banner')->getBannersByPositionId(1);
        $this->assign('banners',$banners);

        $goods = D('Goods')->getGoods();
        fb($goods);
        $this->assign('goods',$goods);


        $this->assign('nav_type',1);
        $this->display();
    }
}