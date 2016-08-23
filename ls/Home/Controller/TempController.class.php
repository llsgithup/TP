<?php
namespace Home\Controller;
use Home\API\UserAPI;
use Think\Controller;
use Think\Model;
class TempController extends Controller {

	public function test() {
		//$test=new Model();
		//$re=$test->table("3000_info a")->join("3000_info_meta b on a.info_id=b.info_id ",'left ')->field('a.*,b.im_key,b.im_value')->where("a.info_type=1")->order("a.info_id desc")->select();
		//echo $test->getLastSql();
		//var_export($re);
		$news=M('info');
		$count=$news->where('info_type=1')->count();
		$Page=new \Think\Page($count,1);// 实例化分页类 传入总记录数和每页显示的记录数(25)
		$info_data=M("info")->where("info_type=1")->order("info_id")->limit($Page->firstRow.','.$Page->listRows)->select();
		$info_id_set="";
		foreach($info_data as $info_id)
		{
			if($info_id_set!='')
			$info_id_set.=',';
			$info_id_set.=$info_id['info_id'];
			
		}
		
		$list=M("info_meta")->where("info_id in(".$info_id_set.")")->order('info_id desc')->select();
		$show= $Page->show();// 分页显示输出
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->theme('3000')->display(); // 输出模板

	}

	public function verify() {
		$config = array('fontSize' => 20, // 验证码字体大小
		'length' => 3, // 验证码位数
		'useNoise' => false, // 关闭验证码杂点
		);
		$Verify = new \Think\Verify($config);
		$Verify -> entry();
	}

}
