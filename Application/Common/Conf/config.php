<?php

return array(
    "LOAD_EXT_FILE"=>"fb",
    'LOAD_EXT_CONFIG' => 'db,session,tags',
    'MODULE_ALLOW_LIST' => array('Home', 'Admin'),
    'DEFAULT_MODULE' => 'Home',

    /* URL配置 */
    'URL_CASE_INSENSITIVE' => false, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_PATHINFO_DEPR'    => '/', //PATHINFO URL分割符

    'TMPL_TEMPLATE_SUFFIX'=>'.php', //模板文件的后缀

    'DEFAULT_AJAX_RETURN' => 'JSON',
    'DEFAULT_V_LAYER'       =>  'Tpl',

    //子域名部署
    //'URL_CASE_INSENSITIVE'  =>  true,   //URL大小写
    'APP_SUB_DOMAIN_DEPLOY'   =>    1,   // 开启子域名配置
    'APP_SUB_DOMAIN_RULES'    =>    array(
        'admin.guolai.com'  => 'Admin',      // admin.soa.com域名指向Admin模块
        'www.guolai.com'  => 'Home',      // www.domain1.com域名指向Home模块
        'm.guolai.com'  => 'Weixin',      // www.domain1.com域名指向Home模块
    ),

    /*'VAR_PAGE'	=>'p',
    'TMPL_CACHE_ON' => false,
    'TOKEN_ON'=>false,
    'TMPL_STRIP_SPACE'=>false,
    'URL_HTML_SUFFIX' => '',
    'DB_FIELDS_CACHE'=>false,
    'SESSION_AUTO_START'=>true,*/

    /* 认证相关 */
   /* 'USER_AUTH_KEY'	=>'auth_id',	// 用户认证SESSION标记
    'ADMIN_AUTH_KEY'			=>'administrator',
    'USER_AUTH_GATEWAY'=>'public/login',// 默认认证网关
    'DB_LIKE_FIELDS'            =>'content|remark',*/

    //'SHOW_PAGE_TRACE'=>0, //显示调试信息

    /* 系统数据加密设置 */
    'DATA_AUTH_KEY' => '1*NX+Jds|p!IFqltgD)"?4;ic<{,wuya239Ax^]-', //默认数据加密KEY
);