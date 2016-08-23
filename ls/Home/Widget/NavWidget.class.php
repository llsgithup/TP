<?php
namespace Home\Widget;
use Think\Controller;
class NavWidget extends Controller {
    public function def(){
        $nav = M('navbar');
		$ret=$nav->where("nav_isshow=1")->order('nav_index')->select();
		return $ret;
    }

}
?>