<?php
/**
 * 购物车模型
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Weixin\Model;

class CartModel extends CommonModel{

    //表名
    const TABLE = 'cart';

    //自增id
    const FIELD_ID = 'id';

    //商品id
    const FIELD_GOODS_ID = 'goods_id';

    //用户id
    const FIELD_USER_ID = 'user_id';

    //购物车商品数量
    const FIELD_NUM = 'cart_num';

    //更新时间
    const FIELD_UPDATE_TIME = 'update_time';

    /**
     * 购物车商品总数
     * @return int
     */
    public function getNum(){
        $where = array(
            'user_id' => $this->user_id
        );
        $sum = $this->where($where)->sum(self::FIELD_NUM);
        return $sum > 0 ? $sum : 0;
    }

    /**
     * 购物车商品总价
     * @return int
     */
    public function getTotalPrice(){
        $goods = $this->getGoods();
        $totalPrice = 0;
        foreach($goods as $val){
            $goodsPrice = 0;
            $cart_num = $val['cart_num'];
            foreach($val['rule'] as $rule){
                if($cart_num >= $rule['num']){
                    $goodsPrice = $cart_num * $rule['price'];
                }
            }
            $totalPrice += $goodsPrice;
        }
        return $totalPrice;
    }

    /**
     * 添加购物车
     * @param $goods_id
     * @param $num
     * @return bool|mixed
     */
    public function addCart($goods_id,$num){
        if($cart_id = $this->isExists($goods_id)){//更新
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

    //删除
    public function delCart($goods_id){
        if($cart_id = $this->isExists($goods_id)){
            return $this->delete($cart_id);
        }else{
            return false;
        }
    }

    /**
     * 获取购物车商品
     * @return array
     */
    public function getGoods(){
        $where = array(
            'c.' . CartModel::FIELD_USER_ID=>$this->user_id
        );

        $goods = $this->alias('c')->field('g.*,p.num as rule_num,p.price as rule_price,c.cart_num')
                        ->join('left join ' . $this->tablePrefix . 'goods as g on g.id=c.goods_id')
                        ->join('left join ' . $this->tablePrefix . 'goods_to_price as p on g.id=p.goods_id')
                        ->where($where)->select();
        $arr = array();
        foreach($goods as $val){
            if(empty($arr[$val['id']])){
                $arr[$val['id']] = $val;
            }

            $arr[$val['id']]['rule'][] = array(
                'num' => $val['rule_num'],
                'price' => $val['rule_price']
            );
        }
        return $arr;
    }

    /**
     * 判断购物车是否存在该商品
     * @param $goods_id
     * @return bool
     */
    public function isExists($goods_id){
        $where = array(
            self::FIELD_GOODS_ID => $goods_id,
            self::FIELD_USER_ID => $this->user_id
        );
        $cartGoods = $this->where($where)->find();
        return !empty($cartGoods)?$cartGoods['id']:false;
    }
}