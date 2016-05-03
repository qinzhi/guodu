<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;

class CommonModel extends Model{
    const FIELD_IS_DEL = 'is_del';

    const DEL_YES = '1';//删除

    const DEL_NO = '0';//没删除
    
}