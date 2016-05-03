<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Weixin\Model;

class CartModel extends CommonModel{

    const TABLE = 'cart';

    const FIELD_ID = 'id';

    const FIELD_GOODS_ID = 'goods_id';

    const FIELD_USER_ID = 'user_id';

    const FIELD_NUM = 'num';

    const FIELD_UPDATE_TIME = 'update_time';


    public function __construct(){
        parent::__construct();
    }

    public function addCart($goods_id,$num){
        $cart_id = $this->isExists($goods_id);
        if($cart_id > 0){//更新
            $data = array(
                self::FIELD_ID => $cart_id,
                self::FIELD_NUM => $num,
                self::FIELD_UPDATE_TIME => time()
            );
            return $this->save($data);
        }else{//添加
            $data = array(
                self::FIELD_GOODS_ID => $goods_id,
                self::FIELD_NUM => $num,
                self::FIELD_USER_ID => $this->user_id,
                self::FIELD_UPDATE_TIME => time()
            );
            return $this->add($data);
        }
    }

    public function isExists($goods_id){
        $where = array(
            self::FIELD_GOODS_ID => $goods_id,
            self::FIELD_USER_ID => $this->user_id
        );
        $cartGoods = $this->where($where)->find();
        return !empty($cartGoods)?$cartGoods['id']:false;
    }
}