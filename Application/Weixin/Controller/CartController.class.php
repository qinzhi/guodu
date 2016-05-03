<?php
namespace Weixin\Controller;
class CartController extends WeixinController {

    public function index(){
        $this->assign('nav_type',3);
        $this->display();
    }

    public function add(){
        $goods_id = I('request.goods_id/d');
        $result['code'] = 1;
        if(D('Goods')->hasGoodsById($goods_id)){
            $num = I('request.num/d');
            $status = D('Cart')->addCart($goods_id,$num);
            if($status){
                $result['msg'] = '添加成功';
            }else{
                $result['msg'] = '添加失败';
            }
        }else{
            $result['code'] = 0;
            $result['msg'] = '该商品不存在';
        }
        $this->ajaxReturn($result);
    }
}