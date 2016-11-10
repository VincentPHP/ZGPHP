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

class Code{
	
	private $width;		//验证码宽度
	private $height; 	//验证码高度
	
	private $bgColor;	//背景颜色
	private $img; 		//图片资源
	
	private $size;		//文字大小 
	private $len;		//验证码长度
	
	private $seed = 'QWERTYUIOPASDFGHJKLZXCVBNMqwertyuiopasdfghjklzxcvbnm1234567890';	//验证码种子
	private $fontFile = './ZGPHP/Tool/Font/font.ttf';									//验证码字体
	
	public  function __construct( $width=200, $height=80, $bgColor='#fff', $size=NULL, $len=NULL )
	{
		
		$this -> width   = $width;
		
		$this -> height  = $height;
		
		$this -> bgColor = $bgColor;
		
		$this -> size    = is_null( $size ) ? C( 'CODE_SIZE' ) : $size ;
		
		$this -> len     = is_null( $len ) ? C( 'CODE_LEN' ) : $len ;
		
	}
	
	public 	function show()		//显示验证码
	{
		
		header( 'Content-type:image/png' );		//发送头部
		
		$this -> createBg();					//创建并填充画布
		
		$this -> write();						//写字
		
		$this -> makeTrouble();					//干扰
		
		imagepng( $this->img );					//输出
		
		imagedestroy( $this->img );				//销毁

	}
	
	private function write()	//创建干扰
	{
		
		$font = '';
		
		for ( $i=0; $i < $this->len; $i++ )
		{
			
			
			$x = $this->width / $this->len * $i + 10;	//X,Y 坐标
			$y = ( $this->heihgt + $this->size ) / 2;
			
			//颜色
			$color = imagecolorallocate( $this->img, mt_rand( 0, 200 ), mt_rand( 0, 200 ), mt_rand( 0, 200 ) );
			
			//随机字体
			$text = $this->seed[ mt_rand( 0, strlen( $this->seed ) -1 ) ];
			$font .= $text;
			imagettftext( $this->img, $this->size, mt_rand( -45, 45 ), $x, $y, $color, $this->fontFile, $text );
			
			$_SESSION['code'] = strtolower( $font );	//把验证码存到SESSION 方便对比
			 
		}
	
	}
	
	private function createBg()	//创建背景
	{

		$img = imagecreatetruecolor( $this->width, $this->height );	 //创建画布
		
		$bgColor = hexdec( $this->bgColor );//把16进制的#fffff 转换为10进制的数字
		
		imagefill( $img, 0, 0, $bgColor );	//填充的颜色需要用10进制的数字
		
		$this -> img = $img;				//赋值给属性 这样各个方法都可以共用
		
	}
	
}
	
	
	
	