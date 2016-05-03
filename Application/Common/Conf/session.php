<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/21
 * Time: 18:33
 */
return array(
    'SESSION_OPTIONS' => array(
        'type' => 'Db',
        'expire' => 1440,
    ),
    'SESSION_TABLE' => DB_PREFIX . 'session',
);