<?php

class UploadImgsModel extends Model{
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'content_imgs');
		$this->_fields=array('id','src_big','src_small','content','pid');
		$this->_R['id']=isset($_GET['id']) ? $_GET['id'] : null;
	}
	
	//获取下一个自增长id
	public function getNextImgId(){
		return parent::nextId();
	}
	
	//上传图片时，把图片添加到数据库
	public function addUploadImgs(){
		$dataArray=array();//存储要添加到数据库的数据的数组
		$returnActionArray=array();//返回给action的数组
		
		$dataArray['pid']=$_POST['time'];//用当前的时间生成pid，保证不会重复，而且可以排序
		
		
		$load=new FileUpload('Filedata');
		$dataArray['src_big']=$load->getPath();//大图的路径
		
		$img=new Image($dataArray['src_big']);
		
		$img->thumb(640,420);
		
		$img->out('_s');
		
		$returnActionArray['src_small']=$dataArray['src_small']=$img->getPath();//小图路径
		
		$returnActionArray['id']=$this->getNextImgId();
		
		if(parent::add($this->_tables, $dataArray)){
			return $returnActionArray;
		}
	}
	
	
	public function delImgs(){
		return $this->delFromId($this->_tables, $this->_R['id']);
	}
	
	
	
}

?>