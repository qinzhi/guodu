<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Weixin\Model;

use Think\Model;
class CommonModel extends Model{

    public $user_id;

    public function __construct(){
        $this->user_id = 1;
        parent::__construct();
    }

}