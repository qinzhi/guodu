<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;

class GoodsCategoryModel extends CommonModel{

    public $order = 'sort asc'; //排序

    const TABLE = 'goods_category';

    const SEO_TABLE = 'goods_category_to_seo';

    const FIELD_ID = 'id';

    const FIELD_NAME = 'name';

    const FIELD_ICON = 'icon';

    const FIELD_STATUS = 'status';//状态

    const FIELD_SORT = 'sort';//排序

    const FIELD_IS_DEL = 'is_del';//是否删除

    const STATUS_OPEN = 1;//开启状态

    const STATUS_CLOSE = 0;//关闭状态

    const DEL_YES = '1';//删除

    const DEL_NO = '0';//没删除

    public function __construct(){
        parent::__construct();
    }

    public function move($id,$action){
        $auth = $this->find($id);
        $authList = $this->getCategories();
        for($i=0,$len=count($authList);$i<$len;$i++){
            if($authList[$i]['id'] == $auth['id']){
                if($i == 0 && $action == 'up' ){//上移失败
                    return false;
                }elseif($i == $len-1 && $action == 'down'){//下移失败
                    return false;
                }else{
                    if($action == 'up'){
                        $refer = $authList[$i - 1];
                    }elseif($action == 'down'){
                        $refer = $authList[$i + 1];
                    }else{
                        return false;
                    }
                    $tmp = $refer['sort'];
                    $status1 = $this->where(array('id'=>$refer['id']))->setField(array('sort'=>$auth['sort']));
                    $status2 = $this->where(array('id'=>$auth['id']))->setField(array('sort'=>$tmp));
                    if($status1 && $status2){
                        return true;
                    }else{
                        return false;
                    }
                }
            }
        }
    }

    /**
     * 获取分类排序
     * @return int
     */
    public function getCategorySort(){
        $category = $this->order('sort desc')->find();
        return !empty($category) ? ($category['sort'] + 1) : 0;
    }

    /**
     * 添加分类
     * @param $category
     * @param $seo
     * @return bool|mixed
     */
    public function addCategory($category,$seo){
        $insert_id = $this->add($category);
        if($insert_id === false){
            return $insert_id;
        }else{
            $seo['category_id'] = $insert_id;
            M(self::SEO_TABLE)->add($seo);
            return true;
        }
    }

    /**
     * 通过分类Id更新分类
     * @param $category
     * @param $seo
     * @param $id
     * @return bool
     */
    public function updateCategoryById($category,$seo,$id){
        $result = $this->where(array('id'=>$id))->save($category);
        if($result === false){
            return $result;
        }else{
            M(self::SEO_TABLE)->where(array('category_id'=>$id))->save($seo);
            return true;
        }
    }

    /**
     * 通过分类Id获取分类
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id){
        return $this->alias('t')
                        ->join('left join ' . $this->tablePrefix . self::SEO_TABLE . ' as t1 on t1.category_id=t.id')
                            ->where(array('t.id'=>$id))
                                ->order($this->order)->find();
    }

    public function setOrder($order){
        $this->order = $order;
    }

    /**
     * 通过分类Id删除分类
     * @param $id
     * @return bool
     */
    public function delCategoryById($id){
        return $this->where(array(
            self::FIELD_ID => $id,
            self::FIELD_IS_DEL => self::DEL_YES
        ));
    }

    /**
     * 获取所有分类
     * @return mixed
     */
    public function getCategories(){
        $where = array(
            self::FIELD_IS_DEL=>self::DEL_NO
        );
        return $this->_get($where);
    }

    /**
     * 获取所有开启状态的分类
     * @return mixed
     */
    public function getCategoriesOnOpen(){
        $where = array(
            self::FIELD_STATUS=>self::STATUS_OPEN,
            self::FIELD_IS_DEL=>self::DEL_NO
        );
        return $this->_get($where);
    }

    /**
     * 获取所有关闭状态的分类
     * @return mixed
     */
    public function getCategoriesOnClose(){
        $where = array(
            self::FIELD_STATUS=>self::STATUS_CLOSE,
            self::FIELD_IS_DEL=>self::DEL_NO
        );
        return $this->_get($where);
    }

    private function _get($where){
        $categories = $this->where($where)
            ->order($this->order)->select();
        foreach ($categories as &$category){
            $category['icon'] = get_img($category['icon']);
        }
        return $categories;
    }
}