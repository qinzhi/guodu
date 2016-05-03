<?php
namespace Admin\Controller;
use \Common\Library\Org\Util\Json;
class GoodsAttrController extends AdminController {

    public $attr;

    public function __construct(){
        parent::__construct();
        $this->attr = D('Attr');
    }

    public function getModels(){
        $model = M('Model')->where(array('is_del'=>0))->select();
        if(IS_AJAX){
            $this->ajaxReturn($model);
        }else{
            return $model;
        }
    }

    public function gets(){
        $model_id = I('request.id/d');
        $attrs = $this->attr->where(array('model_id'=>$model_id))->select();
        $this->ajaxReturn($attrs);
    }

    public function index(){
        $models = $this->getModels();
        $this->assign('models',$models);
        $this->display('Goods/Attr/index');
    }

    public function add(){
        if(IS_POST){
            $name = trim(I('request.name'));
            $model_id = M('Model')->add(array('name'=>$name));

            $attr_name = I('request.attr_name');
            if(!empty($attr_name)){
                $type = I('request.type');
                $value = I('request.value');
                for($i=0,$len=count($attr_name);$i<$len;$i++){
                    $attr = array(
                        'model_id' => $model_id,
                        'type' =>   $type[$i],
                        'name' =>   $attr_name[$i],
                        'value' =>  $value[$i],
                        'sort' => $i
                    );
                    $this->attr->add($attr);
                }
            }
            $this->success('添加成功',U('GoodsAttr/index'));
            return;
        }

        $this->display('Goods/Attr/add');

    }

    public function edit(){
        if(IS_POST){
            $name = trim(I('request.name'));
            $model_id = I('request.id');
            M('Model')->save(array('name'=>$name,'id'=>$model_id));

            $del_id = I('request.del_id');
            if(!empty($del_id)){
                $this->attr->where(array('id'=>array('in',$del_id)))->delete();
            }

            $attr_id = I('request.attr_id');
            if(!empty($attr_id)){
                $attr_name = I('request.attr_name');
                $type = I('request.type');
                $value = I('request.value');
                for($i=0,$len=count($attr_id);$i<$len;$i++){
                    $attr = array(
                        'model_id' => $model_id,
                        'type' =>   $type[$i],
                        'name' =>   $attr_name[$i],
                        'value' =>  $value[$i],
                        'sort' => $i
                    );
                    if(empty($attr_id[$i])){
                        $this->attr->add($attr);
                    }else{
                        $attr['id'] = $attr_id[$i];
                        $this->attr->save($attr);
                    }
                }
            }
            $this->success('保存成功',U('GoodsAttr/index'));
        }else{
            $id = I('request.id/d');
            $model = M('Model')->find($id);
            if(!empty($model)){
                $model['attr'] = $this->attr->where(array('model_id'=>$id))->order('sort asc')->select();
            }
            $this->assign('model',$model);
            $this->display('Goods/Attr/edit');
        }
    }

    public function del(){
        $model_id = I('request.ids');
        $model_id = explode(',',$model_id);
        if(count($model_id) > 1){
            $status = M('Model')->where(array('id'=> array('in',$model_id) ))->save(array('is_del'=>1));
        }else{
            $model_id = array_pop($model_id);
            $status = M('Model')->where(array('id'=>$model_id ))->save(array('is_del'=>1));
        }
        if($status){
            $data = array('code'=>1,'msg'=>'删除成功');
        }else{
            $data = array('code'=>0,'msg'=>'删除失败');
        }
        $this->ajaxReturn($data);
    }

}