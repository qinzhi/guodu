<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Weixin\Model;

class GoodsModel extends CommonModel{

    const TABLE = 'goods_category';

    const FIELD_ID = 'id';

    const FIELD_NAME = 'name';

    const FIELD_STATUS = 'status';

    const FIELD_IS_DEL = 'is_del';

    const STATUS_OPEN = 1;//上架状态

    const STATUS_CLOSE = 0;//下架状态

    const DEL_YES = '1';//删除

    const DEL_NO = '0';//没删除

    public function __construct(){
        parent::__construct();
    }

    public function getGoods(){
        $where = array(
            'g.' . self::FIELD_STATUS => self:: STATUS_OPEN,
            'g.' . self::FIELD_IS_DEL => self::DEL_NO
        );
        $goods = $this->field('g.*,p.num as rule_num,p.price as rule_price')->alias('g')
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
     * 判断是否存在该商品
     * @param $id
     * @return bool
     */
    public function hasGoodsById($id){
        $where = array(
            self::FIELD_ID => $id,
            self::FIELD_IS_DEL => self::DEL_NO
        );
        $goods = $this->where($where)->find();
        return !empty($goods)?:false;
    }

}