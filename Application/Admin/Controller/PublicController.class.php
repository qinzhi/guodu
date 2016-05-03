<?php
/**
 * Created by PhpStorm.
 * User: qinzhi
 * Date: 15-12-26
 * Time: 下午4:20
 */
namespace Admin\Controller;

use Think\Controller, Think\Verify;
use Common\Library\Org\Util\Crypt;

class PublicController extends Controller
{

    protected $config = array('app_type' => 'public');

    /**
     * 登录
     */
    public function login()
    {
        if (IS_AJAX) {
            $code = trim(I('post.captcha'));
            $verify = new Verify();
            if ($verify->check($code)) {
                $account = I('post.account');
                $password = I('post.password');
                $admin = M('Admin')->where(array('account' => $account))->find();
                if (!empty($admin)) {
                    if ($this->psd_verify($password, $admin['password']) === TRUE) {
                        session('_id', $admin['id']);
                        $remember = I('post.remember');
                        if (!empty($remember)) {
                            $saveTime = 7 * 24 * 3600;
                            cookie('_auth',
                                authcode("{$admin['account']}\t{$admin['password']}\t{$admin['id']}", 'ENCODE'), $saveTime);
                        }
                        $result = array('code' => 1, 'msg' => '验证成功');
                    } else {
                        $result = array('code' => 0, 'msg' => '密码不正确');
                    }
                } else {
                    $result = array('code' => 0, 'msg' => '用户名不存在');
                }
            } else {
                $result = array('code' => 0, 'msg' => '验证码不正确');
            }
            $this->ajaxReturn($result);
        } else {
            $admin_id = session('_id');
            if (!empty($admin_id)) {
                $this->redirect('/'); //跳转首页
            } else
                $this->display();
        }
    }

    /**
     * 密码验证
     */
    private function psd_verify($inputPsd, $password)
    {
        $inputPsd = md5(md5($inputPsd) . C('DATA_AUTH_KEY'));
        if ($inputPsd == $password) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /**
     * 注销
     */
    public function logout()
    {
        session(null);
        cookie('_auth', null);
        $this->redirect(U('/login')); //重新登录
    }

    /**
     * 验证码
     */
    public function captcha()
    {
        $config = array(
            'imageW' => '100',   //验证码宽度 设置为0为自动计算
            'imageH' => '32',   //验证码高度 设置为0为自动计算
            'fontSize' => 14,    // 验证码字体大小
            'useNoise' => false, // 是否添加杂点 默认为true
            'useCurve' => false,    //是否使用混淆曲线 默认为true
            'length' => 4,     // 验证码位数
            'useImgBg' => false,    //是否使用背景图片 默认为false
            'bg' => array(255, 255, 255), //验证码背景颜色 rgb数组设置，例如 array(243, 251, 254)
        );
        $verify = new Verify($config);
        $verify->entry();
    }
}