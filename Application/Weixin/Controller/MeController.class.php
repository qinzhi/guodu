<?php
namespace Weixin\Controller;
use Think\Controller;
class MeController extends Controller {
    public function index(){
        $this->assign('nav_type',4);
        $this->display();
    }
}