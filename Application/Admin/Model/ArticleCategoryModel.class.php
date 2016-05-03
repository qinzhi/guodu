<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;

class ArticleCategoryModel extends CommonModel{

    public static $order = 'sort asc'; //排序

    public function __construct(){
        parent::__construct();
        $this->seoTable = 'article_category_to_seo';
    }

    public function move($id,$action){
        $auth = $this->find($id);
        $authList = $this->get_categories_by_pid($auth['pid']);
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

    public function format_tree($AuthLists,$is_json = true,$is_init = true){
        if($is_init) $tree[] = array('id'=>'','pid'=>0,'level'=>0,'name'=>'根节点');
        foreach($AuthLists as $auth){
            if($auth['level'] < 2){
                $tree[] = array(
                    'id' => $auth['id'],
                    'pId' => $auth['pid'],
                    'name' => $auth['name'],
                    'level' => $auth['level'],
                    'open' => true,
                );
            }
        }
        return $is_json?json_encode($tree):$tree;
    }

    /**
     * 通过父Id获取单个分类
     * @param $pid
     * @param string $sort
     * @return mixed
     */
    public function getCategoryByPid($pid,$sort = ''){
        $sort = $sort ?: $this::$order;
        return $this->table($this->getTableName() . ' as t')
                        ->join('left join ' . $this->tablePrefix . $this->seoTable . ' as t1 on t1.category_id=t.id')
                            ->where(array('pid'=>$pid))
                                ->order($sort)->find();
    }

    /**
     * 通过父Id获取子分类
     * @param $pid
     * @return mixed
     */
    public function getCategoriesByPid($pid){
        return $this->where(array('pid'=>$pid))->order($this::$order)->select();
    }

    /**
     * 获取所有分类
     * @return mixed
     */
    public function getCategories(){
        return $this->order($this::$order)->select();
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
            M($this->seoTable)->add($seo);
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
            M($this->seoTable)->where(array('category_id'=>$id))->save($seo);
            return true;
        }
    }

    /**
     * 通过分类Id获取分类
     * @param $id
     * @return mixed
     */
    public function getCategoryById($id){
        return $this->table($this->getTableName() . ' as t')
                        ->join('left join ' . $this->tablePrefix . $this->seoTable . ' as t1 on t1.category_id=t.id')
                            ->where(array('t.id'=>$id))
                                ->order($this::$order)->find();
    }

    /**
     * 通过分类Id删除分类
     * @param $id
     * @return bool
     */
    public function delCategoryById($id){
        return $this->where('id=',$id)->save(array('is_del'=>1));
    }
}