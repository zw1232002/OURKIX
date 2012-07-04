<?php

class NavModel extends Model{
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'nav');
		$this->_fields=array('id','nav_name','nav_title','nav_info','pid','sort');
		$this->_R['id']=$_GET['id'] ? $_GET['id'] : null;
	}
	
	//获取所有的导航，不区分主导航和次级导航
	public function getAllNav(){
		//存储得到的结果集
		$allResult=parent::select($this->_fields,array('order'=>'SORT ASC'));
		
		/*
		 * 遍历结果集，根据得到结果集中的pid再查找一次数据库，得出改导航的pid=其他导航id的导航的名字
		 * 如果有，则存储在数组第一个元素的nav_name方法中
		 * 如果找不到，则返回空数组，在模板文件中，通过对nav_name进行判断，来进行显示
		 * */
		foreach ($allResult as $key=>$value){
			$allResult[$key]->pid=parent::select(array('nav_name'),array('where'=>array($value->pid.'=id')));
		}
		return $allResult;
	}
	
	//获取主导航
	public function getMainNav(){
		return parent::select(array('id','nav_name'),array('where'=>array("pid=0")));
	}
	
	//新增导航
	public function addNav(){
		
		//通过request类进行过滤，得到一个和数据库中的字段相符的一些值组成的数组
		$addData=$this->getRequest()->filter($this->_fields);
		
		$this->add($this->_tables, $addData);
	}
	
	//获取某个导航的信息
	public function getOneNav(){
		return parent::select($this->_fields,array('where'=>array('id='.$this->_R['id']),'limit'=>'1'));
	}
	
	
	//修改导航
	public function updateNav(){
		
		//通过request类进行过滤，得到一个和数据库中的字段相符的一些值组成的数组
		$addData=$this->getRequest()->filter($this->_fields);
		$this->update($this->_tables,$addData,array('id='.$addData['id']));
	}
	
	//删除导航
	public function delNav(){
		$this->delete($this->_tables, array('id='.$this->_R['id']));
	}
	
}

?>