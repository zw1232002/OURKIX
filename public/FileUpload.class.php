<?php

class FileUpload{
	private $name;//上传时，文件在用户硬盘上的名字.
	private $tmp;//上传时生成的临时文件完整路径
	private $path;//服务器上传文件保存的总路径
	private $type;	//上传得到的文件类型
	private $typeArr = array('image/jpeg','image/pjpeg','image/png','image/x-png','image/gif');//允许上传的类型组成的数组
	private $error;//错误代码
	private $todayDate;//今天的日期(年月日)
	private $todayPath;//以今天日期创建的目录名
	private $maxSize;//规定的上传文件最大值
	private $linkPath;//上传之后，可以放在图片src属性的路径
	
	public function __construct($file,$maxSize=null){
		$this->name=$_FILES[$file]['name'];
		$this->tmp=$_FILES[$file]['tmp_name'];
		$this->path=ROOT_PATH.UPLOAD_DIR;
		$this->type=$_FILES[$file]['type'];
		$this->error=$_FILES[$file]['error'];
		$this->maxSize=$maxSize / 1024;
		$this->todayDate=date('Ymd');
		$this->todayPath=$this->path.$this->todayDate.'/';
		$this->checkError();//检查错误类型
		$this->checkType();
		$this->checkPath();//检查上传文件目录是否存在且是否可写
		$this->moveUpload();//移动文件，把文件从临时目录移动过来
		
	}
	
	//在类外获得图片路径的方法
	public function getPath(){
		return $this->linkPath;
	}
	
	
	//生成新的文件名
	//命名规则：当前日期+100到1000之间的随机数+扩展名.
	private function setNewName(){
		//获取上传文件的扩展名
		$extraName=explode('.', $this->name);
		$extraName=$extraName[count($extraName)-1];
		//生成新的名字，不带路径的，如20120505122345256.jpg
		$newName=date(YmdHis).mt_rand(100, 1000).'.'.$extraName;
		$this->linkPath=UPLOAD_DIR.$this->todayDate.'/'.$newName;//设置可以用来在页面中链接图片的路径，即可以放在src中的路径,如uploads/20120716/....
		return $this->todayPath.$newName;
	}
	
	
	//移动文件
	private function moveUpload() {
		if (is_uploaded_file($this->tmp)) {
			if (!move_uploaded_file($this->tmp,$this->setNewName())) {
				Tool::alertBack('警告：上传失败！');
			}
		} else {
			Tool::alertBack('警告：临时文件不存在！');
		}
	}
	
	
	//检查上传文件目录是否存在且是否可写
	private  function checkPath(){
		
		if (!is_dir($this->path) || !is_writeable($this->path)) {
			if (!mkdir($this->path)) {
				Tool::alertBack('警告：主目录创建失败！');
			}
		}
			
		if (!is_dir($this->todayPath) || !is_writeable($this->todayPath)) {
			if (!mkdir($this->todayPath)) {
				Tool::alertBack('警告：子目录创建失败！');
			}
		}
	} 
	
	//验证错误
	private function checkError() {
		if (!empty($this->error)) {
			switch ($this->error) {
				case 1 :
					Tool::alertBack('警告：上传值超过了约定最大值！');
					break;
				case 2 :
					Tool::alertBack('警告：上传值超过了'.$this->maxSize.'KB！');
					break;
				case 3 :
					Tool::alertBack('警告：只有部分文件被上传！');
					break;
				case 4 :
					Tool::alertBack('警告：没有任何文件被上传！');
					break;
				default:
					Tool::alertBack('警告：未知错误！');
			}
		}
	}
	
	
	//验证文件类型
	private function checkType(){
		if(empty($this->type) ||  !in_array($this->type, $this->typeArr)){
			Tool::alertBack('上传文件类型必须是'.implode(',', $this->typeArr).'中的一种！');
		}
	}
	
}

?>