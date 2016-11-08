<?php

//命名空间 防止命名冲突
namespace Home\Controller;
use Think\Controller;

//三级联动控制器
//Controller ://Think/Controller
class AreaController extends Controller{

	//展示联动页面的模版
	public function index(){
		//实例化数据表模型
		$model = M('Areas');
		//查询省份/直辖市信息
		$province = $model -> where(array('parent_id' => 1)) -> select();
		//传递数据给模版展示
		$this -> assign('province',$province);
		$this -> display();
	}

	//专门定一个方法用来处理ajax请求（通过地区id获取指定地区下的下属地区）
	public function getAreaByAreaId(){
		//接收地区id
		$pid = I('post.pid');
		//先实例化数据表模型
		$model = M('Areas');
		$data = $model -> where(array('parent_id' => $pid)) -> select();
		//以json格式输出地区信息
		//echo json_encode($data);
		$this -> ajaxReturn($data);
	}
}