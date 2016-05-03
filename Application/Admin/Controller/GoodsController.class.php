<?php
namespace Admin\Controller;
use \Common\Library\Org\Util\Tree;
class GoodsController extends AdminController {

    public $goodsModel;

    public function __construct(){
        parent::__construct();
        $this->goodsModel = D('Goods');
    }

    //商品列表
    public function index(){
        $goods = $this->goodsModel->getGoods();
        $this->assign('goods',$goods);
        $this->display();
    }

    //添加商品
    public function add(){
        if(IS_POST){
            $this->goodsModel->addGoods(I('post.'));
            $this->redirect('Goods/index');
        }else{
            $categories = D('GoodsCategory')->getCategories();
            foreach ($categories as &$category){
                unset($category['icon']);
            }
            $this->assign('categories',$categories);
            $this->display();
        }
    }

    //编辑商品
    public function edit(){
        $id = I('get.id/d');
        if(IS_POST){
            $this->goodsModel->editGoodsById(I('post.'),$id);
            $this->redirect('Goods/index');
        }else{
            //商品基本信息
            $goods = $this->goodsModel->getGoodsById($id);
            $this->assign('goods',$goods);

            //商品图片
            $images = $this->goodsModel->getGoodsImageById($id);
            foreach ($images as &$val){
                $val['imageUrl'] = get_img($val['image']);
            }
            $this->assign('images',$images);

            //商品价格规则
            $rules = $this->goodsModel->getGoodsPriceById($id);
            $this->assign('rules',$rules);

            //商品推荐类型
            $commend = $this->goodsModel->getGoodsCommendById($id);
            $commend_id = array();
            foreach($commend as $value){
                array_push($commend_id,$value['commend_id']);
            }
            $this->assign('commend_id',$commend_id);

            //商品属性
            $attr = $this->goodsModel->getGoodsAttrById($id);
            $this->assign('model_id',key($attr));//商品模型id
            $this->assign('attr',current($attr));

            //分类
            $categories = D('GoodsCategory')->getCategories();
            foreach ($categories as &$category){
                unset($category['icon']);
            }
            $this->assign('categories',$categories);
            
            $this->display();
        }
    }

    //更新商品
    public function update(){
        if(IS_AJAX){
            $action = I('get.action');
            if($action == 'price'){ //更新价格
                $result = $this->updatePrice();
            }else{
                $result = $this->goodsModel->save(I('post.'));
                if($result){
                    $result = array('code'=>1,'msg'=>'更新成功');
                }else{
                    $result = array('code'=>0,'msg'=>'更新失败');
                }
            }
        }else{
            $result = array('code'=>0,'msg'=>'异常提交');
        }
        $this->ajaxReturn($result);
    }

    public function del(){
        $id = I('request.id/d');
        $result = $this->goodsModel->delGoodsById($id);
        if($result){
            $result = array('code'=>1,'msg'=>'删除成功');
        }else{
            $result = array('code'=>0,'msg'=>'删除失败');
        }
        $this->ajaxReturn($result);
    }

    public function __call($function,$args)
    {
        if ($function === 'spec') { 
            $tpl = I('request.tpl');
            if ($tpl == 'select') {
                $has_id = I('request.has_id');
                $where = array();
                if (!empty($has_id)) {
                    $where['id'] = array('not in', implode(',', $has_id));
                }
                $specs = D('Spec')->get_specs('id,name', $where);
                $this->assign('specs', $specs);
            } elseif ($tpl == 'edit') {
                $id = I('request.id/d');
                $spec = D('Spec')->get_spec_by_id($id);
                $this->assign('spec', $spec);
            }
            $this->display(CONTROLLER_NAME . DS . ucfirst($function) . DS . $tpl);
        }else{
            echo"你所调用的函数: ".$function."(参数: ";
            dump(array_merge(I('post.'),I('get.')));
            echo")<br>不存在！<br>";
        }
    }
}