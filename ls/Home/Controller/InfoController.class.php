<?php
namespace Home\Controller;
use Think\Controller;
use Home\API\InfoAPI;
class InfoController extends Controller {
    public function index(){

		$get_info_type=I("get.type",'1','/^\d+$/');
		
		$info=new InfoAPI($get_info_type,1);
		$info->loadMaindata();
		$this->assign("main_data",$info->_main_data);
		$this->assign("detail_data",$info->_detail_data);
		$this->assign("pagebar",$info->_page_bar);
		if($get_info_type==1)
		{
		$this->theme('3000')->display();
		}
		elseif($get_info_type==2)
			{
				$this->theme('3000')->display('prod');
			}
	}
	public function detail()
	{
		$info_id=I("get.pid",'0','/^\d+$/');
		if($info_id<=0) exit("没有这个商品");
		$info=new InfoAPI(2);
		$info->loadMaindata("info_id=".$info_id);
		$this->assign("main_data",$info->_main_data);
		$this->assign("detail_data",$info->_detail_data);
		$this->theme('3000')->display('prod_detail');
	}
//	function getdetail($info_id,$detail_data)
//	{
//		$ret=array();
//		foreach($detail_data as $d)
//		{
//			if($d['info_id']==$info_id)
//			{
//				$ret[$d["im_key"]]=$d["im_value"];
//			}
//		}
//		return $ret;
//	}

}
