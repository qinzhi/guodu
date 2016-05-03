<?php
return array(

    'DEFAULT_THEME'    =>    'Default',

    'SESSION_PREFIX' => 'weixin_',

    /* 模板相关配置 */
    'TMPL_PARSE_STRING' => array(
        '__STATIC__' => __ROOT__ . '/Public/Static',
        '__WEIXIN__' => __ROOT__ . '/Public/' . MODULE_NAME,
        '__COMMON__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/common',
        '__PLUGINS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/plugins',
        '__IMG__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/images',
        '__CSS__'    => __ROOT__ . '/Public/' . MODULE_NAME . '/css',
        '__JS__'     => __ROOT__ . '/Public/' . MODULE_NAME . '/js',
    ),

    'URL_HTML_SUFFIX' => '',    //URL伪静态后缀设置
    //'URL_CASE_INSENSITIVE' =>true,  //URL是否不区分大小写
    'URL_MODEL' => '2', //2 (REWRITE  模式);
);