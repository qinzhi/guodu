<?php
namespace Admin\Controller;
use \Common\Library\Org\Util\Tree;
/**
 * 权限管理控制器
 * Class AuthController
 * Author Qinzhi
 */
class AuthController extends AdminController {

    public function __construct(){
        parent::__construct();
        $this->AuthRole = D('AuthRole');
    }

    public function index(){
        $authLists = $this->AuthRole->get_auths();
        $tree = new Tree($authLists);
        $auth = $tree->leaf();
        $this->assign('auth',$auth);
        $this->assign('tree',$this->AuthRole->format_tree($authLists));
        $this->display();
    }

    public function getAuth(){
        $id = I('request.id/d');
        $auth = $this->AuthRole->find($id);
        if(IS_AJAX){
            $this->ajaxReturn($auth);
        }else{
            return $auth;
        }
    }

    public function add(){
        if(IS_POST){
            $pid = I('request.p_id/d',0);
            $pauth = $this->AuthRole->get_auth_by_pid($pid,'sort desc');
            if($pid == 0) $level = 0;
            else{
                $auth = $this->AuthRole->get_auth_by_id($pid);
                $level = $auth['level'] + 1;
            }
            $sort = !empty($pauth) ? ($pauth['sort'] + 1) : 0;
            $data = array(
                'pid' => $pid,
                'level' => $level,
                'module' => MODULE_NAME,
                'type' => I('request.type'),
                'name' => trim(I('request.name')),
                'site' => trim(I('request.site')),
                'sort' => $sort,
            );
            $insert_id = $this->AuthRole->add($data);
            if($insert_id === false){
                $this->error('权限添加失败','/Auth');
                return;
            }
        }
        $this->redirect('/Auth');
    }

    public function edit(){
        if(IS_AJAX){
            parse_str(urldecode(I('request.params')),$params);
            $pid = $params['p_id'];
            $auth = $this->AuthRole->get_auth_by_id($pid);
            if($pid == 0) $level = 0;
            else $level = $auth['level'] + 1;
            $data = array(
                'id' => $params['id'],
                'pid' => $params['p_id'],
                'level' => $level,
                'module' => MODULE_NAME,
                'type' => $params['type'],
                'name' => trim($params['name']),
                'site' => trim($params['site'])
            );
            $result = $this->AuthRole->save($data);
            if($result){
                $result = array('code'=>1,'msg'=>'保存成功');
            }else{
                $result = array('code'=>0,'msg'=>'保存失败');
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
            $result = $this->AuthRole->move($id,$action);
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

    public function del(){
        if(IS_AJAX){
            $id = I('request.id/d');
            $auth = $this->AuthRole->get_auth_by_pid($id);
            if(!empty($auth)){
                $result = array('code'=>0,'msg'=>'不能直接删除上级模块');
            }else{
                if($this->AuthRole->delete($id)){
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

}