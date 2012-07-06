<?php

class CallAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		
	}
	
	//处理上传图片
	public function upLoad() {
		echo '我被执行到了';
		$upload=new FileUpload('filedata');
		$path=$upload->getPath();
		echo $_FILES['Filedata']['tmp_name'];
		
// 		if (isset($_POST['send'])) {
// 			$_fileupload = new FileUpload('pic',$_POST['MAX_FILE_SIZE']);
// 			$_path = $_fileupload->getPath();
// // 			$_img = new Image($_path);
// // 			$_img->thumb(300,300);
// // 			$_img->out();
// // 			$_fileupload->alertOpenerClose('图片上传成功！','.'.$_path);
// 		} else {
// 			exit('警告：文件过大或者其他未知错误导致浏览器崩溃！');
// 		}
	}
}

?>