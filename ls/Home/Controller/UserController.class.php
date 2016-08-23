<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Home\Lib\PasswordHash;
class UserController extends Controller {
	public function reg()
	{
		if($_POST)
		{
			$a=new UserAPI();
			$a->reg();
		}
		if($a->actionInfo!="")
			{
				eval($a->actionInfo);
			}
		
		
		$this->theme('3000')->display();
	}
    public function login(){
			
		if($_POST)
		{
			$a=new UserAPI();
			$a->login();
			if($a->actionInfo!="")
			{
				eval($a->actionInfo);
			}
		}
		else
		{
			
		}
		$this->theme('3000')->display();
	}

}
