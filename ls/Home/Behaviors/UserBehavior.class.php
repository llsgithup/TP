<?php
namespace Home\Behaviors;
use Home\API\UserAPI;
use Think\Controller;
class UserBehavior extends BaseBehavior{
    //行为执行入口
    public function run(&$param){
    	
		
		$user=new UserAPI();
		$get_login_config=C("need_login");//获取需要登录配置节
	
		if(array_key_exists(CONTROLLER_NAME,$get_login_config )&& in_array(ACTION_NAME , $get_login_config[CONTROLLER_NAME])&&!$user->is_login())
		{
			
		
			redirect('/tp/Home/login?from='.urldecode(__SELF__).'',2,'正在跳转通行证......');	
			
		}
		if($user->is_login())
		{
		
		
			$this->assign("user_login", $user->getUser());
		}
	
    }
}