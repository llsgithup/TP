<?php
namespace Home\API;
use Home\Lib\PasswordHash;
class UserAPI {
	public $actionInfo = "";
	function reg() {
		$getUserName = I("post.txtUsername", '', "/^\w{6,20}$/");
		$getUserPwd = I("post.txtPwd", '', "/^\w{6,20}$/");
		if ($getUserName == '' || $getUserPwd == '') {
			$this -> actionInfo = '$this->assign("errorinfo","注册失败，用户名、密码格式不正确");';
			return;
			//下面程序不运行

		}
		$user=D("User");
		
		try{
		
		$ph=new PasswordHash(8, FALSE);
		$user->user_name=$getUserName;
		$user->user_pwd=$ph->HashPassword($getUserPwd);
		$user->startTrans();//开启事务
		$regid=$user->add();
		if($regid)
		{
			$m_user=M('user_meta');
			$m_user->user_id=$regid;
			$m_user->umeta_key='regdate';
			$m_user->umeta_value=date("Y-m-d h:i:s");
			$mregid=$m_user->add();
			if($mregid)
			{
				$user->commit();//提交事务
				$this -> actionInfo = "header('location:/tp/Home/login');";
			}
			else
				{
					$user->rollback();//回滚事务
					$this -> actionInfo = '$this->assign("errorinfo","属性表插入失败");';
				}
			
		}
		else
			{
				$this -> actionInfo = '$this->assign("errorinfo","主表插入失败");';
			}
		}
		catch(\Think\exception $ex)
		{
			//$ex->getMessage();
			$user->rollback();//回滚事务
			$this -> actionInfo = '$this->assign("errorinfo","用户名被占用");';
		}
		
	}

	function getUser()//获取用户登录对象
	{
		$get_cookie = $_COOKIE['userin'];
		
		if (!$get_cookie)
			return false;
		$get_cookie=think_decrypt($get_cookie,C(ENCRPY_KEY));
		if(!$get_cookie || trim($get_cookie)<0) return FALSE;
		$get_cookie_log = unserialize($get_cookie);
		if (!$get_cookie_log)

			return false;
		if ($get_cookie_log -> user_id && intval($get_cookie_log -> user_id) > 0) {
			
			return $get_cookie_log;
		}
		return false;
	}

	function is_login() {
		//判断用户是否登录
		$u = $this -> getUser();

		if ($u -> user_id && intval($u -> user_id) > 0) {
		
			return true;
		}
	}

	function login() {
		$getUserName = I("post.txtUsername", '', "/^\w{6,20}$/");
		$getUserCode = I("post.txtCode", '');
		$getUserPwd = I("post.txtPwd", '', "/^\w{6,20}$/");
		$getSaveUser=I("post.saveUser", '');

		
		if ($getUserName == '' || $getUserPwd == '') {
			$this -> actionInfo = '$this->assign("errorinfo","用户名或密码不合规范");';
			return;
			//下面程序不运行

		}
		 $verify = new \Think\Verify();
   		if(!$verify->check($getUserCode, $id))
		{
			$this -> actionInfo = '$this->assign("errorinfo","验证码输入不正确");';
		
			return;
		}
		$result = M("user") -> where("user_name='" . $getUserName . "'") -> limit(1) -> select();

		if ($result && count($result) == 1) {
			$user_pwd = $result[0]["user_pwd"];
				$ph=new PasswordHash(8, FALSE);
			
			if ($ph->CheckPassword($getUserPwd, $user_pwd)) {
				//$this->actionInfo='$this->assign("errorinfo","登录成功");';
				$user_log = new \stdClass();
				$user_log -> user_id = $result[0]["user_id"];
				$user_log -> user_name = $result[0]["user_name"];
				if($getSaveUser)
				{
				setcookie("userin", think_encrypt(serialize($user_log),C(ENCRPY_KEY)) , time() + 3600*7*24, '/');
				}
				else
					{
				setcookie("userin", think_encrypt(serialize($user_log),C(ENCRPY_KEY)), time() + 3600, '/');
					}
				if (I("get.from") != '') {
					$this -> actionInfo = "gotoUrl('" . I("get.from") . "');";
				} else {
					$this -> actionInfo = "header('location:/tp/Home/index');";
				}

				return;
			} else {
				$this -> actionInfo = '$this->assign("errorinfo","密码错误");';
				return;
			}
		} else {
			$this -> actionInfo = '$this->assign("errorinfo","用户名不存在");';
			return;
		}

	}

}
