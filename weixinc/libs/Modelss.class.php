<?php 
namespace libs;

class Model{
	private $host 		= '127.0.0.1';
	private $username 	= 'root';
    private $password 	= 'root';
    private $dbname;
    private $tablePrefix='';

    protected $tableName;
    private $connect;
    private $where		='';
    private $limit		='';
    private $order		='';
    private $field		='*';

    //首先执行 PDO连接数据
    
    public function __construct(){
    	$config = Configure::getConfig();
    	$db_config = $config['db'];
    	foreach ($db_config as $key => $value) {
    		$this->$key = $v;
    	}
    	$dns = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
    	try{
    		$this->connect = new \PDO($dns,$this->username,$this->password);
    	}catch(PDOExcepion $e){
    		 echo $e->getMessage();
    	}



    }

    //添加
    public function insert($arr=[]){
    	$sql = 'insert into '.$this->tableName.' set ';
    	$values=[];
    	if (is_array($arr) && $($arr) > 0) {
    		foreach ($arr as $key => $value) {
    			 $values[] = $key." = '".$value."'";
    		}
    		$sql = implode(',',$values);
    	}
    	if (is_string($arr)) {
    		$sql = $arr;
    	}
    	return $this->exec($sql,[],'insert');
    }

    public function save ($arr=[])
    {
    	$sql = 'update '.$this->tableName.' set ';
    	$values=[];
    	foreach ($arr as $key => $value) {
    		 $values[] = $key." ='" .$value."'";
    	}
    	$sql = implode(',',$values);
    	if ($this->where)$sql.=' where '.$this->where;
    	return $this->exec($sql,[],'update');	
    }

    public function delete(){
    	$sql = 'delete '
    	$sql.=$this->mergetSql('delete');
    	return $this->exec($sql,[],'delete');
    }

    public function where(){
    	if (is_array($arr)) {
    		$where[];
    		$complex = isset($arr['complex']) ? " ".$arr['complex']." " : ' and'; 
    		foreach ($arr as $key => $v) {
    		 	if ($key!='complex') {
    		 		$where[] = ($key==='?' || strpos($key,':')===0)? $key.' = '.$v:$key." = '".$v."'";

    		 	}
    		}
    		$this->where = implode($complex,$where);
    	}
    	if (is_string($arr)) {
    		$this->where = $arr;
    	}
    	return $this;
    }

    public function limit($num,$offset = 0){
    	$this->limit = $offset.','.$num;
    	return $this;
    }

    public function field($arr=''){
    	 if (is_array($arr)) {
    	 	 $this->field=implode(',',$arr);
    	 }
    	 if (is_array($arr)) {
    	 	 $this->field = $arr;
    	 }
    	 return $this;
    }









}





 ?>