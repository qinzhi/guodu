<?php
namespace Admin\Controller;
use Common\Service\Emotions;
class WeixinController extends AdminController {
    public function setting_menu(){
        if(IS_POST){

            $buttons = I('request.buttons');
            $data['button'] = $buttons;

            if(!empty($buttons) && $this->wechat->createMenu($data) !== FALSE){
                $this->ajaxReturn(array(
                    'code' => 1,
                    'msg' => '发布成功'
                ));
            }else{
                $this->ajaxReturn(array(
                    'code' => 0,
                    'msg' => '发布失败'
                ));
            }

        }else{

            $this->assign($this->wechat->getMenu());

            $this->assign('emotions',Emotions::get_emotions());
            $this->display();
        }
    }
}