<?php
/*
 * class DB 数据库连接类，使用单例模式，且不能使用继承，因为PDO的__construct是public，子类不能重写成private
 * 因此采用组合模式来实现封装
 * DB类不直接使用，让Model类来继承，进而实现封装
 * */

class DB{
	//创建一个静态属性，用于存放实例化的对象，为了保持只实例化一次
	static private $_instance;
	
	//存储pdo对象句柄
	private $_pdo=null;
	
	//私有构造方法，进行封装
	private function __construct(){
		try {
			$this->_pdo=new PDO(DB_DNS,DB_USER,DB_PWD,array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES '.DB_CHARSET));
			$this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			echo $e->getMessage();
		}
	}
	
	//一个静态方法，用来获得实例化后的对象
	static protected function getInstance(){
		if (!self::$_instance instanceof self){
			self::$_instance=new self;
		}
		return self::$_instance;
	}
	
	//私有化克隆，也是为了保持单例模式
	private function __clone(){
	}
	
	/*
	 * protected method select 数据库查询的通用方法
	* @param(Array) $_tables 要查询的所有的表组成的数组，如果只有一个，就写第一个
	* @param(Array) $_fields 要查询所有字段
	* @param(Array) $_params 查询语句中的其他参数，如where，orderby，limit等
	* @return Object Array
	* */
	protected function select(Array $_tables,Array $_fields,Array $_params=array()){
		//初始化table，如果有第二张表，把两张表联合起来，否则用第一张表
		$selectTable=isset($_tables[1]) ? $_tables[0].','.$_tables[1] : $_tables[0];
	
		//初始化要查询的字段,讲字段数组用","连接起来
		$selectFieds=implode(',', $_fields);
	
		//初始化param中的参数
		if(Validate::isArray($_params) && !Validate::isNullArray($_params)){
			//初始化where,whrer是一个条件数组
			if(isset($_params['where'])){
				foreach ($_params['where'] as $key =>$value){
					$where.=$value.' AND ';//用and把条件连接起来
				}
				$where=' WHERE '.substr($where,0,-4);//把最后一个and和空格去掉
			}
				
			//初始化order,默认没有排序
			$order=isset($_params['order']) ? ' ORDER BY '.$_params['order'] : '';
				
			//初始化limit
			$limit=isset($_params['limit']) ? ' LIMIT '.$_params['limit'] : '';
				
			//初始化like，like存放的是一个数组，key存放要like的对象，value存放like的样子
			if(isset($_params['like'])){
				foreach($_params['like'] as $key=>$value){
					$like=' WHERE '.$key.' LIKE '.'%'.$value.'%';
				}
			}
		}
	
		//生成sql语句
		$_sql="SELECT $selectFieds FROM $selectTable $where $like $order $limit";
	
		//执行sql语句
		$pdosm=$this->execute($_sql);
	
		//存储查询结果的一个数组
		$result=array();
	
		//将结果集赋值给数组
		while (!!$_obj=$pdosm->fetchObject()){
			$result[]=$_obj;
		}
	
		return Tool::setHtmlString($result);
	
	}
	
	
	/*
	 * protected method add  新增数据的通用方法
	* @param(Array) $_tables 要查询的所有的表组成的数组，如果只有一个，就写第一个
	* @param(Array) $_fields 要新增数据组成的键值对数组，key是字段名，value是值
	* @return int   影响的行数
	* */
	protected function add($_tables, Array $_addData) {
		$_addFields = array();
		$_addValues = array();
		foreach ($_addData as $_key=>$_value) {
			$_addFields[] = $_key;
			$_addValues[] = $_value;
		}
		$_addFields = implode(',', $_addFields);
		$_addValues = implode("','", $_addValues);
		$_sql = "INSERT INTO $_tables[0] ($_addFields) VALUES ('$_addValues')";
		return $this->execute($_sql)->rowCount();
	}
	
	/*
	 * protected method update      更新数据的通用方法
	* @param(Array) $_tables        要更新的所有的表组成的数组，如果只有一个，就写第一个
	* @param(Array) $_updateData    要更新数据组成的键值对数组，key是字段名，value是值
	* @param(Array) $_where         更新条件，$_where是一个数组，可以书写很多个条件
	* @return int                   影响的行数
	* */
	protected function update(Array $_tables,Array $_updateData,$_where){
		$updateTable=$_tables[0];
		
		//初始化where
		foreach ($_where as $_key=>$_value) {
			$_wheredata .= $_value.' AND ';
		}
		$_wheredata = 'WHERE '.substr($_wheredata, 0, -4);
		
		//初始化要更新的字段数组，其中key代表字段，value代表值
		foreach ($_updateData as $key=>$value){
			if(Validate::isArray($value)){
				$data.=$key.'=\''.$value[0].'\',';
			}else{
				$data.=$key.'=\''.$value.'\',';
			}
		}
			
		$data=substr($data, 0,-1);//把最后一个,号截掉
		//生成sql语句
		$_sql="UPDATE $updateTable SET $data $_wheredata LIMIT 1";
	
		//返回影响的行数
		return $this->execute($_sql)->rowCount();
	}
	
	//删除数据的通用方法
	protected function delete($_tables,$_where){
		$deleteTable=$_tables[0];
		
		//初始化where
		foreach ($_where as $_key=>$_value) {
			$_wheredata .= $_value.' AND ';
		}
		$_wheredata = 'WHERE '.substr($_wheredata, 0, -4);
		
		//生成sql语句
		$_sql="DELETE FROM $deleteTable $_wheredata LIMIT 1";
		
		//返回影响的行数
		return $this->execute($_sql)->rowCount();
	}
	
	
	
	//执行SQL
	private function execute($_sql) {
		try {
			$_stmt = $this->_pdo->prepare($_sql);
			$_stmt->execute();
		} catch (PDOException  $e) {
			exit('SQL语句：'.$_sql.'<br />错误信息：'.$e->getMessage());
		}
		return $_stmt;
	}
}

?>