<?php
namespace Weixin\Controller;
class CategoryController extends WeixinController {
    public function index(){
        $categories = D('Admin/GoodsCategory')->getCategoriesOnOpen();
        $this->assign('categories',$categories);
        $this->assign('nav_type',2);
        $this->display();
    }
}