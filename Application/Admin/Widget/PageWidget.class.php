<?php
namespace Admin\Widget;
use Think\Controller;
class PageWidget extends Controller {

    protected $config = array('app_type' => 'public');

    public function headerTitle($name) {
        $this -> assign('name', $name);
        $this -> display('Widget:Page/headerTitle');
    }

    public function loading(){
        $this -> display('Widget:Page/loading');
    }

    public function navBar() {
        $this -> display('Widget:Page/navBar');
    }

    public function sideBar($slideBar) {
        $this -> assign('slideBar', $slideBar);
        $this -> display('Widget:Page/sideBar');
    }

    public function breadcrumbs($breadcrumbs) {
        $this -> assign('breadcrumbs', $breadcrumbs);
        $this -> display('Widget:Page/breadcrumbs');
    }

    public function title($breadcrumbs) {
        if(!empty($breadcrumbs)){
            $breadcrumb = array_pop($breadcrumbs);
            $title = $breadcrumb['name'];
        }else{
            $title = '首页';
        }
        $this -> assign('title', $title);
        $this -> display('Widget:Page/title');
    }

    public function search() {
        $this -> display('Widget:Page/search');
    }
}
?>