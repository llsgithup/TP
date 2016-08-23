<?php
namespace Home\Behaviors;
use Think\Controller;
class NavBehavior extends Controller{
    //行为执行入口
    public function run(&$param){
    	$nav = M('navbar');
		$ret=$nav->where("nav_isshow=1")->order('nav_index')->select();
		$this->assign("navbar_g",$ret);
	
    }
}