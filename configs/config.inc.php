<?php

/*开始定义smarty*/

define('SMARTY_FRONT', 'front/');//前台皮肤路径
define('SMARTY_ADMIN', 'admin/');//后台皮肤目录
define('SMARTY_TEMPLATE_DIR', ROOT_PATH.'view/');//模板目录
define('SMARTY_COMPILE_DIR', ROOT_PATH.'compile/');//编译文件目录
define('SMARTY_CONFIG_DIR', ROOT_PATH.'configs/');//配置文件目录
define('SMARTY_CACHE_DIR', ROOT_PATH.'cache/');//缓存目录
define('SMARTY_CACHING', 0);//是否开启缓存，0代表关闭，1代表开启。网站开发阶段，关闭缓存
define('SMARTY_CACHE_LIFETIME', 60*60*24);//缓存的存在周期，以秒为单位，默认设置成1天
define('SMARTY_LEFT_DELIMITER', '{_');//定义定界符，防止把js、css之类的代码，也当成smarty解析,左定界
define('SMARTY_RIGHT_DELIMITER', '_}');//定义定界符，防止把js、css之类的代码，也当成smarty解析,右定界

/*结束定义smarty*/


/*开始配置数据库连接参数*/
define('DB_NAME', 'ourkix');//数据库名
define('DB_URL', 'localhost');//数据库地址
define('DB_DNS', 'mysql:host='.DB_URL.';dbname='.DB_NAME);//数据库连接的地址和数据库名（pdo的连接）
define('DB_USER', 'root');//数据库的用户名
define('DB_PWD', 'ZHANGWEI');//数据库的密码
define('DB_CHARSET', 'utf8');//数据库的编码
define('DB_PREFEX', 'ourkix_');//数据库表的前缀

/*结束配置数据库连接参数*/

/*提示信息配置*/
define('ADD_SUCCESS', '新增成功');
define('ADD_FAILED', '新增失败');
define('UPDATE_SUCCESS', '更新成功');
define('UPDATE_FAILED', '更新成功');
define('DEL_SUCCESS', '删除成功');
define('DEL_FAILED', '删除成功');

/**/
define('UPLOAD_DIR','uploads/');//上传文件的保存路径


?>