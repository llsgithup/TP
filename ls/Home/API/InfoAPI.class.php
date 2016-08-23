<?php
namespace Home\API;
class InfoAPI {
	
	public $_info_type=1;//1代表新闻 2代表商品 3表其他
	public $_pagesize=2;//分页数
	public $_page_bar="";//分页的内容
	public $_main_data=array();//主表数据
	public $_detail_data=array();//子表数据
	function __construct($info_type=1,$pagesize=2)
	{
		$this->_info_type=$info_type;
		$this->_pagesize=$pagesize;
	}
	function loadMaindata($where_main="",$where_detail="")//加载主表数据
	{
		
		if($where_main!='')
		{
			$where_main=$where_main.' and info_type='.$this->_info_type;
			
		}
		else
			{
				$where_main='info_type='.$this->_info_type;
			}
		$info_count=M("info")->where($where_main)->count();
		$Page=new \Think\Page($info_count,$this->_pagesize);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$this->_page_bar=$Page->show();//把分页的内容进行赋值
		$info_data=M("info")->where($where_main)->order("info_id")->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->_main_data=$info_data;//主表数据
		
		$info_id_set="";
		
		foreach($info_data as $info_id)
		{
			if($info_id_set!='')
			$info_id_set.=',';
			$info_id_set.=$info_id['info_id'];
			
		}
		if($where_detail!='')$where_detail.='and'.$where_detail;
		$list=M("info_meta")->where("info_id in(".$info_id_set.")".$where_detail)->order('info_id desc')->select();
		$this->_detail_data=$list;//加载子表数据
		
	}
		function loadDetail($info_id,$detail_data)
	{
		$ret=array();
		foreach($detail_data as $d)
		{
			if($d['info_id']==$info_id)
			{
				$ret[$d["im_key"]]=$d["im_value"];
			}
		}
		return $ret;
	}
}