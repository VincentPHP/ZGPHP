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

class Loader{
	
    public static function run()		//控制框架顺序初始化方法
    {
        self::checkEnivronment();		//调用系统环境检查方法 用于查看是否符合运行要求的

        if( !is_dir( 'Application' ) )  //判断是否初始化目录 如果目录不存在则创建该目录
        {					            
            self::createDir();			//调用创建应用目录及前台模块的方法

            self::copyFile();			//调用复制公共库文件的方法 用于复制文件到前台模块目录下

        }		

        self::loadCore();                       //载入核心文件

        \ZGPHP\Kernel\App::run();		//执行应用类

    }	
	
    private static function loadCore()	//载入Kernel 目录下的 核心文件
    {
		
        $file = array(

            './ZGPHP/Kernel/Function.php',	//载入核心函数文件
            
            './ZGPHP/Kernel/Constants.php',     //载入核心目录下的Constans常量库

            './ZGPHP/Kernel/SmartyView.php',	//载入核心目录下的Smarty与框架配置结合的文件 用于显示方法的分配数据的方法

            './ZGPHP/Kernel/Controller.php',	//载入核心目录下的总控制器文件 用于载入控制器公共方法

            './ZGPHP/Kernel/App.php',		//载入核心目录下的控制文件 用于初始化核心 及控制运行

        );

        //循环引入核心文件	
        foreach( $file as $k ){

            require_once $k;

        }

    }
		
    private static function copyFile()	//复制公共库里的文件到初始化创建的前台及公共目录
    {

        copy( './ZGPHP/Common/IndexController.php', './Application/Home/Controller/IndexController.php' );	//复制前台控制器到用户文件夹 显示前台演示用

        copy( './ZGPHP/Common/Index.html', './Application/Home/View/Index/index.html' ); 			//复制前台欢迎文件到 前台模块 IndexController控制器对应的 View 目录里

        copy( './ZGPHP/Common/Config.php', './Application/Home/Conf/Config.php' );				//复公共制配置文件到  对应模块的配置文件目录下 用作用户配置文件

        copy( './ZGPHP/Common/Config.php', './Application/Common/Conf/Config.php' );				//复制公共配置文件到 公共模块目录下 用作公共配置文件

    }
	
    private static function createDir()	//框架初始化 创建目录 方法 用于创建 公共配置器 前台控制器 等
    {

        $dir = array(

            './Application/Home/Controller',	//首页控制器目录

            './Application/Home/View/Index',	//显示首页Index方法显示的目录

            './Application/Home/Conf',		//创建用户配置文件的目录

            './Application/Common/Conf',	//创建公共配置文件的目录

        );

        //对数组里的目录进行循环判断 创建
        foreach( $dir as $k ){

            is_dir( $k ) || mkdir( $k, 0777, TRUE );	//判断数组里的目录循环 判断  创建

        }

    }
	
    private static function checkEnivronment()	//检查环境是否符合框架运行environment
    {

        if( version_compare( PHP_VERSION, '5.4.0', '<' ) ){

            die( 'ZGPHP 需要PHP版本大于PHP5.4,当前版本' . PHP_VERSION );

        }
        
    }

}

Loader::run();
