<?php
return array(
	//'配置项'=>'配置值'
	'DEFAULT_FILTER'        =>  'strip_tags,stripslashes',
//	'DEFAULT_V_LAYER'       =>  'Template', // 设置默认的视图层名称
//	'TMPL_ENGINE_TYPE' =>'PHP' //只使用原生标签，不使用{}这类形式
    'DB_TYPE'   => 'mysql', // 数据库类型
    'DB_USER'   => 'root', // 用户名
    'DB_PWD'    => '', // 密码
    'DB_PREFIX' => '3000_', // 数据库表前缀
    'DB_DSN'    => 'mysql:host=localhost;dbname=tp;charset=utf8',
    'URL_ROUTER_ON'   => true,
    'URL_ROUTE_RULES'=>array(
			
		'login'=>'User/login', //路由 控制器/方法名
		'reg'=>'User/reg', //路由 控制器/方法名
		'test'=>'Temp/test' //路由 控制器/方法名
),
'LOAD_EXT_CONFIG'=>'c_login',
'ENCRPY_KEY'=>'rewite112',
);