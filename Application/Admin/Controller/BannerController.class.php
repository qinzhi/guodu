<?php
namespace Admin\Controller;
class BannerController extends AdminController {

    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $banner = D('Banner')->gets();
        $this->assign('banner',$banner);
        $this->display();
    }

    public function add(){
        if(IS_POST){
            $banner = array(
                'position_id' => I('post.position_id/d'),
                'name' => I('post.name'),
                'intro' => I('post.intro'),
                'image' => I('post.image'),
                'link' => I('post.link'),
                'status' => I('post.status/d'),
                'sort' => I('post.sort/d'),
                'create_time' => time(),
            );
            $time = I('post.time');
            if(!empty($time)){
                list($start_time,$end_time) = explode(' - ',$time);
                $banner['start_time'] = strtotime($start_time);
                $banner['end_time'] = strtotime($end_time);
            }
            $insert_id = D('Banner')->add($banner);
            if($insert_id > 0){
                $this->redirect(U('Banner/index'));
            }else{
                $this->error('广告添加失败',U('Banner/add'));
            }
        }else{
            $position = D('BannerPosition')->gets();
            $this->assign('position',$position);
            $this->display();
        }
    }

    public function edit(){
        $id = I('get.id/d');
        if(IS_POST){
            $banner = array(
                'id' => $id,
                'position_id' => I('post.position_id/d'),
                'name' => I('post.name'),
                'intro' => I('post.intro'),
                'image' => I('post.image'),
                'link' => I('post.link'),
                'status' => I('post.status/d'),
                'sort' => I('post.sort/d'),
                'create_time' => time(),
            );
            $time = I('post.time');
            if(!empty($time)){
                list($start_time,$end_time) = explode(' - ',$time);
                $banner['start_time'] = strtotime($start_time);
                $banner['end_time'] = strtotime($end_time);
            }
            $result = D('Banner')->save($banner);
            if($result > 0){
                $this->redirect(U('Banner/index'));
            }else{
                $this->error('广告编辑失败',U('Banner/edit',array('id'=>$id)));
            }
        }else{
            $banner = D('Banner')->find($id);
            $this->assign('banner',$banner);
            $position = D('BannerPosition')->gets();
            $this->assign('position',$position);
            $this->display();
        }
    }

    public function position(){
        $position = D('BannerPosition')->gets();
        $this->assign('position',$position);
        $this->display(CONTROLLER_NAME . DS . 'Position/index');
    }

    public function position_add(){
        if(IS_POST){
            $position = array(
                'name' => I('post.name'),
                'intro' => I('post.intro'),
                'width' => I('post.width/d'),
                'height' => I('post.height/d'),
                'sort' => I('post.sort/d'),
                'status' => I('post.status/d'),
                'create_time' => time(),
            );
            $insert_id = M('BannerPosition')->add($position);
            if($insert_id > 0){
                $this->redirect(U('Banner/position'));
            }else{
                $this->error('广告位添加失败',U('Banner/position_add'));
            }
        }else{
            $this->display(CONTROLLER_NAME . DS . 'Position/add');
        }
    }

    public function position_edit(){
        $id = I('get.id/d');
        if(IS_POST){
            $position = array(
                'id' => $id,
                'name' => I('post.name'),
                'intro' => I('post.intro'),
                'width' => I('post.width/d'),
                'height' => I('post.height/d'),
                'sort' => I('post.sort/d'),
                'status' => I('post.status/d'),
                'create_time' => time(),
            );
            $result = M('BannerPosition')->save($position);
            if($result){
                $this->redirect(U('Banner/position'));
            }else{
                $this->error('广告位更新失败',U('Banner/position_edit',array('id'=>$id)));
            }
        }else{
            $position = M('BannerPosition')->find($id);
            $this->assign('position',$position);
            $this->display(CONTROLLER_NAME . DS . 'Position/edit');
        }
    }

    public function position_update(){
        if(IS_AJAX){
            $result = M('BannerPosition')->save(I('post.'));
            if($result){
                $result = array('code'=>1,'msg'=>'更新成功');
            }else{
                $result = array('code'=>0,'msg'=>'更新失败');
            }
        }else{
            $result = array('code'=>0,'msg'=>'异常提交');
        }
        $this->ajaxReturn($result);
    }

    public function position_del(){
        $id = I('post.id/d');
        $result = M('BannerPosition')->where('id='.$id)->save(array('is_del'=>1));
        if($result){
            $result = array('code'=>1,'msg'=>'删除成功');
        }else{
            $result = array('code'=>0,'msg'=>'删除失败');
        }
        $this->ajaxReturn($result);
    }
}