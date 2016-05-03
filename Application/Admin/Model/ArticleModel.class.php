<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;
class ArticleModel extends CommonModel{

    public function __construct(){
        parent::__construct();
    }

    public function getArticles(){
        return $this->field('t.id,t.title,t.category_id,t.category_id,t.create_time,t.sort,t1.name as category')
                        ->table($this->tablePrefix . 'article as t')
                            ->join('left join ' . $this->tablePrefix . 'article_category as t1 on t.category_id=t1.id')
                                ->where(array('t.is_del'=>0))->select();
    }

    /**
     * 添加文章
     * @param $params
     */
    public function addArticle($params){
        $article = array(
            'title' => $params['title'],
            'subtitle' => $params['subtitle'],
            'category_id' => (int)$params['category_id'],
            'sort' => (int)$params['sort'],
            'create_time' => time(),
            'update_time' => time()
        );

        $article_id = $this->add($article);//添加文章
        if($article_id > 0){

            /** --------   添加文章详情   --------- **/
            $detail = array(
                'article_id' => $article_id,
                'detail' => $params['detail']
            );
            M('ArticleToDetail')->add($detail);

            /** --------   添加商品SEO   --------- **/
            $seo = array(
                'article_id' => $article_id,
                'keywords' => $params['keywords'],
                'description' => $params['description']
            );
            M('ArticleToSeo')->add($seo);
        }
    }

    /**
     * 更新文章
     * @param $params
     * @param $article_id
     */
    public function editArticleById($params,$article_id){
        $article = array(
            'id' => $article_id,
            'title' => $params['title'],
            'subtitle' => $params['subtitle'],
            'category_id' => (int)$params['category_id'],
            'sort' => (int)$params['sort'],
            'update_time' => time()
        );

        if($this->save($article)){//更新商品

            $map['article_id'] = $article_id;

            /** --------   更新商品详情   --------- **/
            $detail = array(
                'detail' => $params['detail']
            );
            M('ArticleToDetail')->where($map)->save($detail);

            /** --------   更新商品SEO   --------- **/
            $seo = array(
                'keywords' => $params['keywords'],
                'description' => $params['description']
            );
            M('ArticleToSeo')->where($map)->save($seo);
        }
    }

    /**
     * 逻辑删除单个商品
     * @param $id
     * @return bool
     */
    public function delGoodsById($id){
        return $this->where(array('id'=>$id))->save(array('is_del'=>1));
    }

    /**
     * 获取单个商品
     * @param $id
     * @return mixed
     */
    public function getArticleById($id){
        return $this->field('t.*,t1.detail,t2.keywords,t2.description,t3.name as category')
                        ->table($this->tablePrefix . 'article as t')
                            ->join('left join ' . $this->tablePrefix . 'article_to_detail as t1 on t1.article_id = t.id')
                                ->join('left join ' . $this->tablePrefix . 'article_to_seo as t2 on t2.article_id = t.id')
                                    ->join('left join ' . $this->tablePrefix . 'article_category as t3 on t3.id = t.category_id')
                                        ->where('t.id='.$id)->find();
    }

    /**
     * 获取单个商品分类
     * @param $goods_id
     * @return mixed
     */
    public function getGoodsCategoriesById($goods_id){
        return M('GoodsToCategory')->where('goods_id='.$goods_id)->select();
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

    /**
     * 获取产品
     * @param $goods_id
     * @return mixed
     */
    public function getProductsById($goods_id){
        $map = array(
            'goods_id' => $goods_id,
            'is_del' => 0
        );
        return M('Products')->where($map)->select();
    }
}