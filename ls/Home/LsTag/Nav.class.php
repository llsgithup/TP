<?php    
    namespace Home\LsTag;
    use Think\Template\TagLib;
	   // 标签定义
	class Nav extends TagLib {
    protected $tags   =  array(
    
		"load"=>array()
	);
	function _load($tag,$content)
	{

		$str='<?php ';
		$str.='$nav = M("navbar");';
		$str.=' $ret=$nav->where("nav_isshow=1")->order("nav_index")->select();';
		$str.=' foreach($ret as $r)';
		$str.=' {';
		$str.=' echo "<li><a href=".$r["nav_href"].">".$r["nav_title"]."</a></li>";';
		$str.=' };';
		
		
		$str.=' ?>';
		
		return $str;
	}
	}
   