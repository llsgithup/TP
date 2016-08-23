<?php
namespace Home\Widget;
use Think\Controller;
use Think\Model;
class InfoWidget extends Controller {
	
	public function load($id)
	{
		// 初始化缓存
		$cache = S(array('type'=>'file','prefix'=>'think','expire'=>600));
		//$cache->name = 'value'; // 设置缓存
		$get_wig_Conf=M("info_widget")->where("wig_id=".$id)->limit(1)->select();
		if($get_wig_Conf && count($get_wig_Conf)==1)
		{
			$get_wig_Conf=$get_wig_Conf[0];
			$get_news=array();
			$m=new Model();
			//eval('$get_news=$m->'.$get_wig_Conf["wig_model"].';');//读取数据库侧边栏
			if(!$cache->lastnews)
			{
				eval('$get_news=$m->'.$get_wig_Conf["wig_model"].';');
				$cache->lastnews=$get_news;
			}

			$this->assign("news",$cache->lastnews);
			$this->assign("wig_title",$get_wig_Conf["wig_title"]);
			$this->theme('3000')->display($get_wig_Conf["wig_tpl"]);
		}
	}
}