<?php
namespace Admin\Controller;
use \Common\Library\Org\Util\Tree;
/**
 * 文章管理控制器
 * Class AuthController
 * Author Qinzhi
 */
class ArticleController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->articleModel = D('Article');
    }

    public function index(){
        $articles = $this->articleModel->getArticles();fb($articles);
        $this->assign('articles',$articles);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $this->articleModel->addArticle(I('post.','',''));
            $this->redirect('Article/index');
        }else{
            $this->display();
        }
    }

    public function edit(){
        $id = I('get.id/d');
        if(IS_POST){
            $this->articleModel->editArticleById(I('post.','',''),$id);
            $this->redirect('Article/index');
        }else{
            $article = $this->articleModel->getArticleById($id);
            $this->assign('article',$article);
            $this->display();
        }
    }

}