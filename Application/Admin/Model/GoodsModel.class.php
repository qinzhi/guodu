<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;
class GoodsModel extends CommonModel{

    const TABLE = 'goods_category';

    const FIELD_ID = 'id';

    const FIELD_NAME = 'name';

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
            'g.' . self::FIELD_IS_DEL => self::DEL_NO
        );
        return $this->field('g.*,c.name as category_name')
                        ->alias('g')
                            ->join('left join ' . $this->tablePrefix . 'goods_category as c on g.category_id=c.id')
                                ->where($where)->select();
    }

    /**
     * 添加单个商品
     * @param $params
     */
    public function addGoods($params){

        $_num = $params['_num'];
        $_price = $params['_price'];
        $price = current($_price);
        $image = $params['image'];
        $cover_index = intval($params['cover_index']);
        $cover_index = ($cover_index > 0 && $cover_index < count($image)) ? $cover_index : 0;
        $cover_image = !empty($image[$cover_index]) ? $image[$cover_index] : '';//封面图片

        $goods = array(
            'name' => $params['name'],
            'intro' => $params['intro'],
            'goods_no' => $params['goods_no'],
            'model_id' => $params['model_id'],
            'category_id' => (int)$params['category_id'],
            'cover_image' => $cover_image,
            'search_words' => $params['search_words'],
            'cost_price' => $params['cost_price'],
            'sell_price' => $price,
            'store_nums' => $params['store_nums'],
            'weight' => $params['weight'],
            'unit' => $params['unit'],
            'sort' => $params['sort'],
            'status' => (int)$params['status'],
            'create_time' => time(),
            'update_time' => time()
        );
        $goods_id = $this->add($goods);//添加商品
        if($goods_id > 0){
            /** --------   添加商品批发价格规则   --------- **/
            for ($i=0;$i<count($_num);$i++){
                $rule = array(
                    'goods_id' => $goods_id,
                    'num' => $_num[$i],
                    'price' => $_price[$i]
                );
                M('GoodsToPrice')->add($rule);
            }

            /** --------   添加商品图片   --------- **/
            for ($i=0;$i<count($image);$i++){
                $image = array(
                    'goods_id' => $goods_id,
                    'image' => $image[$i],
                    'is_default' => $cover_index == $i ? 1 : 0,
                );
                M('GoodsToImage')->add($image);
            }

            /** --------   添加商品详情   --------- **/
            $detail = array(
                'goods_id' => $goods_id,
                'detail' => I('post.detail','','')
            );
            M('GoodsToDetail')->add($detail);

            /** --------   添加商品SEO   --------- **/
            $seo = array(
                'goods_id' => $goods_id,
                'keywords' => $params['keywords'],
                'description' => $params['description']
            );
            M('GoodsToSeo')->add($seo);

            /** --------   添加商品类型   --------- **/
            $commend_type = $params['commend_type'];
            if(!empty($commend_type)){
                foreach($commend_type as $val){
                    $commend[] = array(
                        'commend_id' => $val,
                        'goods_id' => $goods_id
                    );
                }
                M('GoodsToCommend')->addAll($commend);
            }

            /** --------   添加商品扩展属性   --------- **/
            $model_id = $params['model_id'];
            $_attr = $params['_attr'];
            if($model_id > 0 && !empty($_attr)){
                foreach($_attr as $key => $val){
                    $attr = array(
                        'goods_id' => $goods_id,
                        'model_id' => $model_id,
                        'attr_id' => $key,
                        'attr_value' => is_array($val) ? implode(',',$val) : $val
                    );
                    M('GoodsToAttr')->add($attr);
                }
            }
        }
    }

    public function editGoodsById($params,$goods_id){
        $_num = $params['_num'];
        $_price = $params['_price'];
        $price = current($_price);
        $image = $params['image'];
        $cover_index = intval($params['cover_index']);
        $cover_index = ($cover_index > 0 && $cover_index < count($image)) ? $cover_index : 0;
        $cover_image = !empty($image[$cover_index]) ? $image[$cover_index] : '';//封面图片

        $goods = array(
            'id' => $goods_id,
            'name' => $params['name'],
            'intro' => $params['intro'],
            'goods_no' => $params['goods_no'],
            'model_id' => $params['model_id'],
            'category_id' => (int)$params['category_id'],
            'cover_image' => $cover_image,
            'search_words' => $params['search_words'],
            'cost_price' => $params['cost_price'],
            'sell_price' => $price,
            'store_nums' => $params['store_nums'],
            'weight' => $params['weight'],
            'unit' => $params['unit'],
            'sort' => $params['sort'],
            'status' => (int)$params['status'],
            'update_time' => time()
        );

        if($this->save($goods)){//更新商品

            $where['goods_id'] = $goods_id;

            /** --------   添加商品批发价格规则   --------- **/
            M('GoodsToPrice')->where($where)->delete();
            for ($i=0;$i<count($_num);$i++){
                $rule = array(
                    'goods_id' => $goods_id,
                    'num' => $_num[$i],
                    'price' => $_price[$i]
                );
                M('GoodsToPrice')->add($rule);
            }

            /** --------   添加商品图片   --------- **/
            M('GoodsToImage')->where($where)->delete();
            for ($i=0;$i<count($image);$i++){
                $imageData = array(
                    'goods_id' => $goods_id,
                    'image' => $image[$i],
                    'is_default' => $cover_index == $i ? 1 : 0,
                );
                M('GoodsToImage')->add($imageData);
            }

            /** --------   更新商品详情   --------- **/
            $detail = array(
                'detail' => I('post.detail','','')
            );
            M('GoodsToDetail')->where($where)->save($detail);

            /** --------   更新商品SEO   --------- **/
            $seo = array(
                'keywords' => $params['keywords'],
                'description' => $params['description']
            );
            M('GoodsToSeo')->where($where)->save($seo);

            /** --------   添加商品类型   --------- **/
            $commend_type = $params['commend_type'];
            M('GoodsToCommend')->where($where)->delete();//删除商品类型
            if(!empty($commend_type)){
                foreach($commend_type as $val){
                    $commend[] = array(
                        'commend_id' => $val,
                        'goods_id' => $goods_id
                    );
                }
                M('GoodsToCommend')->addAll($commend);
            }

            /** --------   添加商品扩展属性   --------- **/
            $model_id = $params['model_id'];
            $_attr = $params['_attr'];
            M('GoodsToAttr')->where($where)->delete();//删除商品分类
            if($model_id > 0 && !empty($_attr)){
                foreach($_attr as $key => $val){
                    $attr = array(
                        'goods_id' => $goods_id,
                        'model_id' => $model_id,
                        'attr_id' => $key,
                        'attr_value' => is_array($val) ? implode(',',$val) : $val
                    );
                    M('GoodsToAttr')->add($attr);
                }
            }
        }
    }

    /**
     * 逻辑删除单个商品
     * @param $id
     * @return bool
     */
    public function delGoodsById($id){
        $data = array(
            self::FIELD_ID => $id,
            self::FIELD_IS_DEL => self::DEL_YES
        );
        return $this->save($data);
    }

    /**
     * 获取单个商品
     * @param $id
     * @return mixed
     */
    public function getGoodsById($id){
        return $this->alias('t')
                        ->join('left join ' . $this->tablePrefix . 'goods_to_detail as t1 on t1.goods_id = t.id')
                            ->join('left join ' . $this->tablePrefix . 'goods_to_seo as t2 on t2.goods_id = t.id')
                                ->where('t.id='.$id)->find();
    }

    /**
     * 获取单个商品推荐类型
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsCommendById($goods_id){
        return M('GoodsToCommend')->where('goods_id='.$goods_id)->select();
    }

    /**
     * 获取单个商品批发价格规则
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsPriceById($goods_id){
        return M('GoodsToPrice')->where('goods_id='.$goods_id)->select();
    }

    /**
     * 获取单个商品图片
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsImageById($goods_id){
        return M('GoodsToImage')->where('goods_id='.$goods_id)->select();
    }

    /**
     * 获取单个商品属性
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsAttrById($goods_id){
        $attr = M('GoodsToAttr')->where('goods_id='.$goods_id)->select();
        $arr = array();
        foreach($attr as $value){
            $arr[$value['model_id']][$value['attr_id']] = array(
                'model_id' => $value['model_id'],
                'attr_id' => $value['attr_id'],
                'attr_value' => $value['attr_value'],
                'sort' => $value['sort'],
            );
        }
        return $arr;
    }
}