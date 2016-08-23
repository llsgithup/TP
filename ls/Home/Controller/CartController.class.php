<?php
namespace Home\Controller;
use Think\Controller;
use  Home\API\UserAPI;
class CartController extends Controller {
    public function add_cart(){

	$cart=S(array(
    'type'=>'memcache',
    'host'=>'127.0.0.1',
    'port'=>'11211',)
	);
	$user_api=new UserAPI();
	$get_user=$user_api->getUser();
	if($get_user)
	
		$userid=$get_user->user_id;
	else
	exit('-1');
	//判断商品ID是否符合类型同时判断属性id
	
	$pid=I("post.pid",0,'/^\d+$/');
	$pmeta=I("post.pmeta","","/^(\d+_)+$/");
	if($pid>0)
	{
		exit("ok");
	}
	else
		{
			exit("提交数据不符合规范");
		}
	
		//echo "购物车提交地址";
	}

}