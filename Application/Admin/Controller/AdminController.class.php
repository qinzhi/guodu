<?php
namespace Admin\Controller;
use Think\Controller;
class AdminController extends Controller {

    public $_admin_id;

    public function _initialize(){

        $this->_admin_id = session('_id');
        
        if(!IS_AJAX){
            $menu = D('AuthRole')->get_menu();
            $tree = new \Common\Library\Org\Util\Tree($menu);
            $slideBar = $tree->leaf();

            D('AuthRole')->get_breadcrumbs();
            $breadcrumbs = D('AuthRole')->breadcrumbs;

            $this->assign('breadcrumbs',array_reverse($breadcrumbs));
            $this->assign('slideBar',$slideBar);
        }
    }

}