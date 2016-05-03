<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/5/27
 * Time: 14:40
 */
namespace Admin\Model;

use Think\Model;
class BannerModel extends CommonModel{

    const FIELD_POSITION_ID = 'position_id';

    const FIELD_STATUS = 'status';

    const STATUS_OPEN = 1;
    
    const STATUS_CLOSE = 0;

    public function __construct(){
        parent::__construct();
    }

    public function gets(){
        $where = array(
            'b.' . parent::FIELD_IS_DEL => parent::DEL_NO
        );
        return $this->alias('b')->field('b.*,p.name as position_name')
                    ->join('left join ' . $this->tablePrefix . 'banner_position as p on b.position_id=p.id')
                    ->where($where)->select();
    }

    public function getBannersByPositionId($position_id){
        $where = array(
            self::FIELD_POSITION_ID => $position_id,
            self::FIELD_STATUS => self::STATUS_OPEN,
            parent::FIELD_IS_DEL => parent::DEL_NO
        );
        return $this->where($where)->select();
    }
}