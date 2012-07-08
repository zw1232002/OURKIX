<?php

class CallAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
	}
	
	//处理上传图片,主要处理单张图片上传，只上传，不操作数据库
	public function upload() {
		//这里需要生成一张缩略图，同时要保留原图，在置顶显示轮播图片时使用
		
		$thumbArray=array();
		
		//上传图片
		$load=new FileUpload('Filedata');
		
		$thumbArray['big']=$load->getPath();
		
		//实例化图像处理类
		$imgResourse=new Image($load->getPath());
		
		//生出缩略图
		$imgResourse->thumb(240,160);
		
		//输出图像
		$imgResourse->out('_s');
		
		//小缩略图图片的路径
		$thumbArray['small']=$imgResourse->getPath();
		
		echo json_encode($thumbArray);
	}
}

?>