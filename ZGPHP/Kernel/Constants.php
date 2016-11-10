<?php
/* +----------------------------------------------------------------
 * | Software: [ZGPHP framework]
 * |	 Site: www.gzibm.com
 * |----------------------------------------------------------------  
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.gzibm.com All Rights Reserved.
 * +----------------------------------------------------------------*/	
 	
 define( 'ZGPHP_VERSION', '1.1.0' );				//框架版本号

 define( 'DS', DIRECTORY_SEPARATOR );

 define( 'ROOT_PATH', '.' );
 
 define( 'ZGPHP_PATH', __DIR__ );				//当前目录绝对路径
 
 define( 'REQUEST_METHOD', $_SERVER['REQUEST_METHOD'] );
 
 //-----------------------------------------------------------------

 define( 'IS_CGI', substr( PHP_SAPI, 0, 3 ) == 'cgi' ? TRUE : FALSE );		 //是否是IIS CGI模式

 define( 'IS_WIN', strstr( PHP_OS, 'WIN' ) ? TRUE : FALSE );					 //是否WIN系统

 define( 'IS_CLI', PHP_SAPI == 'cli' ? TRUE : FALSE );

 define( 'IS_GET', $_SERVER['REQUEST_METHOD'] == 'GET' );					 //判断是否是GET请求

 define( 'IS_POST', ( $_SERVER['REQUEST_METHOD'] == 'POST' ) ? TRUE : FALSE );//判断是否是POST请求

 define( 'IS_DELETE', $_SERVER['REQUEST_METHOD'] == 'DELETE' ?: ( isset( $_POST['_method'] ) && $_POST['_method'] == 'DELETE' ) );

 define( 'IS_AJAX', isset( $_SERVER['HTTP_X_REQUIRESTED _WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ); //判断是否是AJAX请求

 define( 'IS_WEIXIN', strpos( $_SERVER['HTTP_USER_AGENT'], 'MicroMessenger' ) !== FALSE );	//判断是否是微信
 
 define( 'IS_HTTPS', isHttps() );	//判断是否是https协议请求
 
 //-----------------------------------------------------------------
 
 define( 'NOW', $_SERVER['REQUEST_TIME'] );

 define( 'NOW_MICROTIME', microtime( TRUE ) );

 define( '__ROOT__', trim( 'http://' . $_SERVER['HTTP_HOST'] . dirname( $_SERVER['SCRIPT_NAME'] ), '/\\' ) );

 define( '__URL__', trim( 'http://' . $_SERVER['HTTP_HOST'] . '/' . trim( $_SERVER['REQUEST_URI'], '/\\' ), '/' ) );

 define( "__HISTORY__", isset( $_SERVER["HTTP_REFERER"] ) ? $_SERVER["HTTP_REFERER"] : '' );
