<?php

class ArticleModel extends Model{
	public $allNav;
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'article');
		$this->_fields=array('id','parent_nav','nav','title','info','tags','author','count','content','top','comment','date','thumb_s','thumb_b','img_id');
		
		/*
		 * 在这里实例化navModel，查询出所有的主导航，获得第一个导航的id，防止没有获得get传值情况下报错
		* */
		$nav=new NavModel();
		$this->allNav=$nav->getMainNav();
		
		
		//如果get没有获取到，就用第一个主导航的id
		$this->_R['id']=isset($_GET['id']) ? $_GET['id'] : $this->allNav[0]->id;
		$this->_R['columnId']=isset($_GET['columnId']) ? $_GET['columnId'] :$this->_R['id'];
	}
	
	public function returnGetId(){
		return $this->_R['id'];
	}
	
	//获取所有的文章
	public function getAllArticle(){
		$this->_tables=array(DB_PREFEX.'article n1 ,'.DB_PREFEX.'nav n2 ');
		return parent::select(array('n1.id','n1.title','n1.top','n1.date','n2.nav_name'),array('where'=>array('n1.parent_nav='.$this->_R['id'],'n2.id=n1.nav'),'order'=>'n1.top DESC,n1.date DESC'));
	}
	
	//获取所有的文章,前台显示用,通过id来获值
	public function getArticleById(){
		return parent::select($this->_fields,array('where'=>array('parent_nav='.$this->_R['id']),'order'=>'date DESC'));
	}
	
	//前台显示文章时使用
	public function getOneArticle(){
		$this->_tables=array(DB_PREFEX.'article n1 ,'.DB_PREFEX.'content_imgs n2');
		return parent::select(array('n1.id','n1.parent_nav','n1.nav','n1.title','n1.info','n1.tags','n1.content','n1.thumb_s','n1.thumb_b','n1.img_id','n2.id pic_id','n2.src_big','n2.content imgs_content','n2.src_small'),array('where'=>array('n1.id='.$_GET['articleId'],'n2.pid=n1.img_id')));
	}
	
	
	public function getArticleByColumnId(){
		return parent::select($this->_fields,array('where'=>array(' nav='.$this->_R['columnId']),'order'=>'date DESC'));
	}
	
	//获取所有置顶的文章
	public function getTopArticle(){
		return parent::select($this->_fields,array('where'=>array('parent_nav='.$this->_R['id'],'top=1'),'order'=>'date DESC'));
	}
	
	
	//添加文章
	public function addArticle(){
		$addData=Request::getInstance()->filter($this->_fields);
		$addData['author']=isset($_SESSION['admin']) && !Validate::isNullArray($_SESSION['admin']) ? $_SESSION['admin'] : null;
		$addData['date']=Tool::getDate();
		return parent::add($this->_tables, $addData);
	}
	
	
	//修改文章
	public function updateArticle(){
		return parent::update($this->_tables, Request::getInstance()->filter(array('parent_nav','nav','title','info','tags','content','thumb_s','thumb_b')) ,array('id='.$_POST['id']));
	}
	
	
	public function getArticleAndImgsById(){
		$this->_tables=array(DB_PREFEX.'article n1 ,'.DB_PREFEX.'content_imgs n2');
		return parent::select(array('n1.id','n1.parent_nav','n1.nav','n1.title','n1.info','n1.tags','n1.content','n1.thumb_s','n1.thumb_b','n1.img_id','n2.id pic_id','n2.src_small'),array('where'=>array('n1.id='.$this->_R['id'],'n2.pid=n1.img_id')));
	}
	
	//删除文章
	public function delArticle(){
		return parent::delFromId($this->_tables, $this->_R['id']);
	}
	
	
	//ajax修改一个值的通用方法，通过get传值
	public function ajaxCommon($name,$id){
		return parent::update($this->_tables, array($name=>$_GET[$name]), array("$id=$_GET[$id]"));
	}
	
	//ajax设置置顶
	public function ajaxSetTop(){
		return $this->ajaxCommon('top','id');
	}
	
}

?>