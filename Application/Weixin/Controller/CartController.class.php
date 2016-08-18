<?php
namespace Weixin\Controller;
class CartController extends WeixinController {

    public function index(){
        $this->assign('nav_type',3);
        if($this->cart_num > 0){

            $totalNum = D('Cart')->getNum();
            $totalPrice = D('Cart')->getTotalPrice();
            $this->assign('totalNum',$totalNum);
            $this->assign('totalPrice',$totalPrice);

            $goods = D('Cart')->getGoods();
            $this->assign('goods',$goods);
            $this->display();
        }else{
            $this->display('empty');
        }
    }

    public function add(){
        $goods_id = I('request.goods_id/d');
        $num = I('request.num/d');
        $result['code'] = 1;
        $result['num'] = $num;
        if(D('Goods')->hasGoodsById($goods_id)){
            if($num <= 0){
                $status = D('Cart')->delCart($goods_id);
            }else{
                $status = D('Cart')->addCart($goods_id,$num);
            }
            if($status){
                $result['msg'] = '添加成功';
            }else{
                $result['msg'] = '添加失败';
            }
        }else{
            $result['code'] = 0;
            $result['msg'] = '该商品不存在';
        }

        $result['totalNum'] = D('Cart')->getNum();

        $result['totalPrice'] = D('Cart')->getTotalPrice();
        $this->ajaxReturn($result);
    }


}