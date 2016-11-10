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

include "./ZGPHP/Org/smarty/Smarty.class.php";
 
class SmartyView{
 	
    private static $smarty = NULL;
	
    public function __construct()
    {

        if( !is_null( self::$smarty ) ) return;

        $smarty = new \Smarty();	//实例化 Smarty 对象
        
        $Dir = array(

            'comDir'        =>	'./Storge/compile/'. MODULE,
            'cacheDir'      =>	'./Storge/cache/'  . MODULE,

        );

        foreach( $Dir as $k )
        {

            is_dir( $k ) || mkdir( $k , 0777, TRUE );

        }
        
        $tplDir = './Application/' . MODULE . '/View/' . CONTROLLER;	//模板目录
        
        $smarty -> template_dir    =  $tplDir;					//模板目录

        $smarty -> compile_dir     =  $Dir['comDir'];			//编译目录

        $smarty -> cache_dir       =  $Dir['cacheDir'];			//缓存目录

        $smarty -> caching         =  C( 'SMARTY_CACHING' );	//是否缓存

        $smarty -> cache_lifetime  =  C( 'SMARTY_LIFETIME' );  	//缓存时间

        $smarty -> left_delimiter  =  C( 'SMARTY_LEFT' );		//开始定界符

        $smarty -> right_delimiter =  C( 'SMARTY_RIGHT' );	 	//结束定界符

        //$smarty -> register_block( 'nocache', 'nocache', FALSE );	//局部不缓存
       
        self::$smarty = $smarty;	//存入静态属性
        
    }
    
    //载入模板
    protected function display()	
    {

        $path = './Application/' . MODULE . '/View/' . CONTROLLER .'/' . ACTION . '.html';  //组合模板路径

        if( !is_file( $path ) )		//判断模板是否存在
        {	

            halt( "{$path} 模板文件不存在 " );

        }
        
        self::$smarty->display( ACTION . '.html', $_SERVER['REQUEST_URI'] );

    }
    
    //分配数据到模板
    protected function assign( $name, $value )		
    {

        self::$smarty->assign( $name, $value );

    }
    
    //判断本地缓存是否失效
    protected function is_cached()	
    {

        return self::$smarty->is_cached( ACTION . '.html', $_SERVER['REQUEST_URI'] );

    }
    
    //删除缓存
    protected function clear_cache()
    {

            self::$smarty->clear_cache();

    }
	
}