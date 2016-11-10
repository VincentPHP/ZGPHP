<?php
/* +----------------------------------------------------------------
 * | Software: [ZGPHP framework]
 * |	 Site: www.gzibm.com
 * |----------------------------------------------------------------  
 * |   Author: 赵 港 < admin@gzibm.com | 847623251@qq.com >
 * |   WeChat: GZIDCW
 * |   Copyright (C) 2015-2020, www.gzibm.com All Rights Reserved.
 * +----------------------------------------------------------------*/
 namespace ZGPHP\Tool;
 use PDO;	//导入全局PDO类(注意) 
 
 class Model{
 		
 	private static $pdo = NULL;
	
	//构造方法实例化自动执行
	public function __construct(){
		
		//self::$pdo 第一次是NUll
		//self::$pdo 第二次就会保存数据库连接对象不是NUll了
		
		if( is_null( self::$pdo ) ){
			
			//连接数据库
			$dsn = 'mysql:host=' . C( 'DB_HOST' ) . ';dbname=' . C( 'DB_NAME' );
			try{
				
				$pdo = new PDO( $dsn, C( 'DB_USER' ), C( 'DB_PASSWORD' ) ); //用户名密码
				$pdo = query( "SET NAMES UTF8" );							//设置字符集
				$pdo = setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );//设置错误类型
				
				self::$pdo = $pdo;			//把链接好的信息存入到静态属性中
	
			} catch (PDOException $e ) {
				
				exit('<sapn style="color:red;">' . $e->getMessage() . '</span>');
				
			}
			
		}

	}
	
	//执行有结果集的方法
	public function q( $sql ){
		
		try{
			
			$num = self::$pdo->exec( $sql );
			return $num;
						
		} catch ( PDOException $e ) {
			
			//有错误 提示错误
			$this->errorMsg( $sql, $e->getMessage() );
			
		}
		
	}
	
	private function errorMsg( $sql, $error ){
		
		echo 'SQL:<span style="color:red;">' . $sql .'</span><br/>';
		echo '错误信息：<span style="color:red;">' . $error . '</span>';
		exit;
		
	}	
	
 }	