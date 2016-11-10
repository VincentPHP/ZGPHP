<?php
return array(
    //'配置项'=>'配置值'
    'DB_NAME'           => '',		//数据库名
    'DB_HOST'           => '',		//数据库地址
    'DB_USER'           => '',		//数据库用户名
    'DB_PASSWORD'       => '',              //数据库密码
    'DB_PREFIX'         => '',		//数据库表前缀
    'DB_PORT'           => 3306,		//数据库端口
    'DB_CHARSET'        => 'utf8',          //数据库编码
    'DB_DEBUG'          => TRUE,		//是否开启调试模式
    'CODE_LEN'          => 4,		//验证码长度
    'CODE_SIZE'         => 20,		//验证码大小
    'TIMEZONE'          => 'PRC',		//设置时区
    'SMARTY_CACHING'    => FALSE,           //是否开启缓存
    'SMARTY_LIFETIME'   => 30,              //缓存时间（秒）
    'SMARTY_LEFT'       => "}>",             //标签开始定界符
    'SMARTY_RIGHT'      => "<{",             //标签结束定界符
);	