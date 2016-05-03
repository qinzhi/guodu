<?php
namespace Admin\Controller;
use \Common\Library\Org\Util\Tree;
class GoodsCategoryController extends AdminController {

    public $categoryModel;

    public function __construct(){
        parent::__construct();
        $this->categoryModel = D('GoodsCategory');
    }

    public function index(){
        $categories = $this->categoryModel->getCategories();
        $this->assign('categories',$categories);
        $this->display('Goods/category');
    }
    
    public function getCategories(){
        $categories = $this->categoryModel->getCategories();
        if(IS_AJAX){
            $this->ajaxReturn($categories);
        }else{
            return $categories;
        }
    }

    public function getCategory(){
        $id = I('request.id/d');
        $category = $this->categoryModel->getCategoryById($id);
        if(IS_AJAX){
            $this->ajaxReturn($category);
        }else{
            return $category;
        }
    }

    public function add(){
        if(IS_POST){
            $data = array(
                'name' => trim(I('request.name')),
                'icon' => I('request.icon'),
                'status' => (bool) I('request.status'),
                'sort' => $this->categoryModel->getCategorySort(),
            );
            $seo = array(
                'title' => trim(I('request.title')),
                'keywords' => trim(I('request.keywords')),
                'descript' => trim(I('request.descript')),
            );
            $result = $this->categoryModel->addCategory($data,$seo);
            if($result === false){
                $this->error('分类添加失败',U('GoodsCategory/index'));
                return;
            }
        }
        $this->redirect(U('/GoodsCategory/index'));
    }

    public function edit(){
        if(IS_AJAX){
            parse_str(urldecode(I('request.params')),$params);
            $id = $params['id'];
            $data = array(
                'name' => trim($params['name']),
                'icon' => $params['icon'],
                'status' => (bool) $params['status'],
            );
            $seo = array(
                'title' => trim($params['title']),
                'keywords' => trim($params['keywords']),
                'descript' => trim($params['descript']),
            );
            $result = $this->categoryModel->updateCategoryById($data,$seo,$id);
            if($result){
                $data = $this->categoryModel->getCategoryById($id);
                $data['icon'] = get_img($data['icon']);
                $result = array('code'=>1,'msg'=>'保存成功','data'=>$data);
            }else{
                $result = array('code'=>0,'msg'=>'保存失败');
            }
        }else{
            $result = array('code'=>0,'msg'=>'异常提交');
        }

        $this->ajaxReturn($result);
    }

    public function del(){
        if(IS_AJAX){
            $id = I('request.id/d');
            $category = $this->categoryModel->getCategoryByPid($id);
            if(!empty($category)){
                $result = array('code'=>0,'msg'=>'不能直接删除上级模块');
            }else{
                if($this->categoryModel->delCategoryById($id)){
                    $result = array('code'=>1,'msg'=>'删除成功');
                }else{
                    $result = array('code'=>0,'msg'=>'删除失败');
                }
            }
        }else{
            $result = array('code'=>0,'msg'=>'异常提交');
        }
        $this->ajaxReturn($result);
    }

    public function move(){
        if(IS_AJAX){
            $id = I('request.id/d');
            $action = I('request.action');
            $result = $this->categoryModel->move($id,$action);
            if($result){
                $result = array('code'=>1,'msg'=>'移动成功');
            }else{
                $result = array('code'=>0,'msg'=>'移动失败');
            }

        }else{
            $result = array('code'=>0,'msg'=>'异常提交');
        }
        $this->ajaxReturn($result);
    }

}