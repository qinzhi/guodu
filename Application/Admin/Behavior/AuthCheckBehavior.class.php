<?php

namespace Admin\Behavior;
use Think\Behavior,Common\Library\Org\Util\Crypt;

defined('THINK_PATH') or exit();

class AuthCheckBehavior extends Behavior {
    protected $config;
    public function run(&$params) {

        switch ($params['app_type']) {
            case 'public': {
                return;
            }
        }

        $admin_id = session('_id');
        if(empty($admin_id)){
            $_auth = cookie('_auth');
            if(!empty($_auth)){
                list($_account, $_password, $_id)
                    = isset($_auth) ? explode("\t", authcode($_auth, 'DECODE')) : array('', '', 0);
                $admin = M('Admin')->find($_id);
                if(!empty($admin) && $_account == $admin['account'] && $_password == $admin['password']){
                    session('_id',$admin['id']);
                }else{
                    echo '<p>权限不足,<a href="/login">重新登录</a>。</p>';
                }
            }else{
                header('Location: /login');
            }
        }
    }
}
?>