<?php
namespace Home\Behaviors;
use Think\Controller;
class BaseBehavior extends Controller{
	
		public function __construct()
		{
			parent::__construct();

			$get_do=I('get.do');
			if(trim($get_do))
			{
				if(method_exists($this, $get_do))
				{
					$this->$get_do();
				}
			}
		}
	  public function logout(){
	  	
	  	setcookie('userin',null,time()-3600,'/');
		redirect('/tp/Home/index',2,'注销成功......');	
		exit();
		
		
	  }	
		
}
	