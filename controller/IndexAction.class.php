<?php

class IndexAction extends Action{
	private $nav;
	private $article;
	
	public function __construct(){
		parent::__construct();
		$this->nav=new NavModel();//引入nav模型，方便注入
		$this->article=new ArticleModel();//引入文章模型
		$this->commonInvoke();
	}
	
	
	public  function index(){
		
		$this->_tpl->assign('topArticle',$this->article->getTopArticle());
		
		$this->_tpl->assign('allArticle',$this->article->getArticleById());
		
		$this->_tpl->display(SMARTY_FRONT.'index.tpl');
	}
	
	
	public function column(){
		
		$this->_tpl->assign('allArticle',$this->article->getArticleByColumnId());
		
		$this->_tpl->assign('nav_infos',$this->nav->getOneChildNav());
		
		$this->_tpl->display(SMARTY_FRONT.'column.tpl');
	}
	
	public function article(){
		
		$this->_tpl->assign('oneArticle',$this->article->getOneArticle());
		
		echo $this->article->setCount();
		
		$this->_tpl->display(SMARTY_FRONT.'article.tpl');
	}
	
	
	public function commonInvoke(){
		//注入所有主导航
		$this->_tpl->assign('mainNav',$this->nav->getMainNav());
		
		//把当前页面的id顺便注入到页面中，方便打开子栏目时获取id
		$this->_tpl->assign('curId',$this->article->returnGetId());
		
		//注入所有二级导航
		$this->_tpl->assign('subNav',$this->nav->ajaxGetChildNav());
		
		
		
		
	}
}

?>