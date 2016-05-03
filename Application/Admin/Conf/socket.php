<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/12/24
 * Time: 16:14
 */

// 最大数据 8K
define( 'WEBSOCKET_MAX', 1024 * 8 );

// 最大接收缓冲区
define( 'WEBSOCKET_RCVBUF', WEBSOCKET_MAX );

// 发送最大字节数
define( 'WEBSOCKET_SNDBUF', 1024 * 64 );

// 最大使用内存
define( 'WEBSOCKET_MEMORY', '1024M' );

// 最大同时在线数
define( 'WEBSOCKET_ONLINE', 1024 );

// HOST
define( 'WEBSOCKET_HOST', '127.0.0.1' );

// PORT
define( 'WEBSOCKET_PORT', 843 );

// 允许的域名
define( 'WEBSOCKET_DOMAIN', '' );

// api 的key
define( 'WEBSOCKET_KEY', 'Q#WHJGIOU*(&_}{:?PO-78SE#$%^&*()O' );

// 管理员密码
define( 'ADMIN_PASS', '123456' );