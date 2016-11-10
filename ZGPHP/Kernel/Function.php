<?php
/* +----------------------------------------------------------------
 * | Software: [ZGPHP framework]
 * |	 Site: www.gzibm.com
 * |----------------------------------------------------------------  
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.gzibm.com All Rights Reserved.
 * +----------------------------------------------------------------*/	

/**
 * 局部不缓存 函数
 * @param String $params 开始标识
 * @param String $content 不缓存的内容
 * @param String 调用Smarty内容
 */
function nocache( $params, $content, &$smarty )
	{
		
    	return $content;
	
	}

/*
 * 配置文件 加载函数 
 * 框架配置 公共配置 用户配置 
 * 后面传参 参数优先级高于前一个参数 
 */
function C( $var = NULL )	//加载配置项函数
	{
 	
		static $config = array();		//定义一个静态变量 赋值为空数组 第二个有值后存储配置
		
		if( is_array( $var ) )
		{
			
			//第一次框架配置项和空数组 合并完成之后把框架的配置项保存到静态变量中去
			//第二次是公共配置项 和框架配置项合并之后 把结果保存到静态变量里去
			//第三次是用户配置项和公共配置项合并后把结果保存的静态变量中去
			
			$config = array_merge( $config, $var );
				
		}
		
		if( is_string( $var ) )		//如果要获得指定的配置项时 传入需要获取的参数名就会返回其值 
		{
			
	        return $config[$var];
					
		}
		
		if( is_null( $var ) )		//如果没有传入参数，那么返回全部最终的配置项
		{
					
	        return $config;
			
		}
	}

/**
 * 实例化模型
 * @param String  需要实例化的表
 */
function M()	        //模型函数
	{
	 	
		$model = new \ZGPHP\Tool\Model;	//实例化模型
		
		return $model;					//返回实例化的结果
			
	} 

	
	
/**
 * 获取提交数据
 * @param 
 */
function I($method, $default, $anquan)
	{
		if(empty($method)){
			
			halt('请传入需要获取的数据提交方式 例如：POST，GET，SESSION');
			
		}	
	}


 function halt( $msg )	//停止方法 传参的参数是需要提示文字的
	{
	
		header( 'Content-type:text/html;charset=utf-8' );//页面编码
		
		echo $msg;	exit();//输出参数 停止运行
	
	}
 
 /**
  * 格式化打印数据 
  * @param String $Data
  */
 function P( $Data )
	{
		echo '<pre>';
		
		print_r( $Data );
		
		echo '</pre>';
		
	}

/**
 * 判断是否是https协议
 * @return Boolean TRUE OR FALSE
 */
function isHttps()
    {
        if ( ! empty($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off')
        {
            return TRUE;
        }
        elseif (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
        {
            return TRUE;
        }
        elseif ( ! empty($_SERVER['HTTP_FRONT_END_HTTPS']) && strtolower($_SERVER['HTTP_FRONT_END_HTTPS']) !== 'off')
        {
            return TRUE;
        }
  
        return FALSE;
    }

/**
 * 返回当前根网址
 * @return string 返回当前的根网址 包含http:// 或https://    
 */
function getHost()
    {
        if (IS_HTTPS)
        {
            return 'https://' . $_SERVER['SERVER_NAME'];
            
        } else {
            
            return 'http://' . $_SERVER['SERVER_NAME'];
            
        }
 
    }    
    
/**
 * 生成随机字符串
 * @param int       $length  要生成的随机字符串长度
 * @param string    $type    随机码类型：0，数字+大小写字母；1，数字；2，小写字母；3，大写字母；4，特殊字符；-1，数字+大小写字母+特殊字符
 * @return string
 */
function randCode($length = 5, $type = 0) 
	{
	    $arr = array(
	    	1 => "0123456789", 
	    	2 => "abcdefghijklmnopqrstuvwxyz", 
	    	3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 
	    	4 => "~@#$%^&*(){}[]|"
		);
		
	    if ($type == 0) 
	    {
	    	
	        array_pop($arr);
			
	        $string = implode("", $arr);
			
	    } elseif ($type == "-1") {
	    	
	        $string = implode("", $arr);
			
	    } else {
	    	
	        $string = $arr[$type];
			
	    }
		
	    $count = strlen($string) - 1;
		
	    $code = '';
		
	    for ($i = 0; $i < $length; $i++) 
	    {
	    	
	        $code .= $string[rand(0, $count)];
			
	    }
		
	    return $code;
		
    }


/**
 * 判断是否移动端
 * @return Boolean True
 */
function isMobile()
	{

		$mobilePlatform  = array('Android', 'iPhone','Windows Phone');
		
		foreach($mobilePlatform as $v ){
			
			if(strpos($_SERVER['HTTP_USER_AGENT'], $v)){
					
				return TRUE;
				
			}
			
		}
   
	}
