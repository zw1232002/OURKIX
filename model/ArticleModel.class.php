<?php

class ArticleModel extends Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'article');
		$this->_fields=array('id','parent_nav','nav','title','info','tags','author','count','content','top','comment','date','thumb','like','collect','share','src','pid');
		
		/*
		 * 在这里实例化navModel，查询出所有的主导航，获得第一个导航的id，防止没有获得get传值情况下报错
		* */
		$nav=new NavModel();
		$allNav=$nav->getMainNav();
		
		//如果get没有获取到，就用第一个主导航的id
		$this->_R['id']=isset($_GET['id']) ? $_GET['id'] : $allNav[0]->id;
	}
	
	public function returnGetId(){
		return $this->_R['id'];
	}
	
	//获取所有的文章
	public function getAllArticle(){
		$this->_tables=array(DB_PREFEX.'article n1 ,'.DB_PREFEX.'nav n2 ');
		return $this->select(array('n1.id','n1.title','n1.top','n1.date','n2.nav_name'),array('where'=>array('n1.parent_nav='.$this->_R['id'],'n2.id=n1.nav'),'order'=>'n1.top DESC,n1.date DESC'));
	}
	
	
	
	//添加文章
	public function addArticle(){
		$addData=Request::getInstance()->filter($this->_fields);
		$addData['author']=isset($_SESSION['admin']) && !Validate::isNullArray($_SESSION['admin']) ? $_SESSION['admin'] : null;
		$addData['date']=Tool::getDate();
		return $this->add($this->_tables, $addData);
	}
	
	
	//删除文章
	public function delArticle(){
		return $this->delete($this->_tables, array('id='.$this->_R['id']));
	}
	
	//ajax修改一个值的通用方法，通过get传值
	public function ajaxCommon($name,$id){
		return $this->update($this->_tables, array($name=>$_GET[$name]), array("$id=$_GET[$id]"));
	}
	
	//ajax设置置顶
	public function ajaxSetTop(){
		return $this->ajaxCommon('top','id');
	}
	
}

?>