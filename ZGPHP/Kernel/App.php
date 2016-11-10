<?php
/* +----------------------------------------------------------------
 * | Software: [ZGPHP framework]
 * |	 Site: www.gzibm.com
 * |----------------------------------------------------------------  
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.gzibm.com All Rights Reserved.
 * +----------------------------------------------------------------*/	
namespace ZGPHP\Kernel;

class App{
	
    public static function run()		//进行框架初始化
    {

        self::init();				//初始化框架 加载配置文件

        spl_autoload_register( array( __CLASS__, 'aload') );		//注册一个自动执行方法 aload 引入控制器或者函数文件

        self::appRun();				//执行应用 组合路径 实例化 执行类里的指定方法

    }
	 
    private static function aload( $className )		//自动载入方法 找不到文件时才会启用
    {

        if( substr( $className, -10 ) == 'Controller' )		//对传参的值进行截取后10位 判断是否是控制器 是则进行控制器组合
        {

                //传入参数 值类似于 Home\Controller\IndexController 对符号进行替换组合成文件路径
                $path = './Application/' . str_replace( '\\', '/', $className ) . '.php' ;	

        } else {									

                $path = './' . str_replace( '\\', '/', $className ) . '.php' ;	//如果不是控制器 则组合普通的路径

        }

        require $path;	//引入函数或者控制器文件

    }
	
    private static function appRun()	//执行应用 方法
    {

        //定义变量 并把常量的内容赋值给变量

        $m = MODULE;  	 //模块名

        $c = CONTROLLER; //控制器名

        $a = ACTION;	 //方法名  


        $cName =  "\\{$m}\Controller\\{$c}Controller";		//调用类里的方法

        $obj   =  new $cName;								//实例化类

        $obj  ->  $a();										//调用类里的方法

    }
	
    private static function init()		//初始化方法  载入配置文件内容
    {

        $m = isset( $_GET['m'] ) ? ucfirst( $_GET['m'] ) : 'Home' ;	//定义一个变量$m 用于判断访问的模块

        $c = isset( $_GET['c'] ) ? ucfirst( $_GET['c'] ) : 'Index' ;	//定义一个变量 $c 用于判断访问的控制器

        $a = isset( $_GET['a'] ) ? $_GET['a']  : 'index' ;		//定义一个变量 $a 用于判断方法名

        define( 'MODULE',     $m );     //定义常量	 用于储存$m的模块名

        define( 'CONTROLLER', $c ); 	//定义常量	 用于储存$c的控制器名

        define( 'ACTION',     $a ); 	//定义常量	 用于储存$a的方法名


        $frameConfig  =  './ZGPHP/Conf/Config.php';				//定义变量 引入框架的配置文件

        $commonConfig =  './Application/Common/Conf/Config.php';		//定义变量 引入公共的配置文件	

        $userConfig   =  './Application/' . MODULE . '/Conf/Config.php';	//定义变量 引入用户的配置文件	


        if(file_exists($frameConfig))
        {

            $frameConfig = include $frameConfig; 

            C($frameConfig);

        }

        if(file_exists($commonConfig))
        {

            $commonConfig = include $commonConfig;	
            C($commonConfig);

        }
        if(file_exists($userConfig))
        {

            $userConfig = include $userConfig;
            C($userConfig);                 //使用C函数加载配置文件的内容

        }


        session_id() || session_start();		//开启SESSION

        date_default_timezone_get( C('TIMEZONE') );	//设置时区	

    } 
	
}