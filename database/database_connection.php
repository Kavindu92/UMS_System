<?php
class database_connection {
	
	private $host= "";
	private $user= "";
	private $password= "";
	private $database= "";
	
	private $conn;
	private $query ;
	
	private $table = array ();
	
	
	private $_auto_commit_ = true;
	
 public	function __construct($host , $user , $password, $database){
	 
		$this->host = $host;
		$this->user = $user;
		$this->password = $password;
		$this->database = $database;
		
		
	}
	
	

	
	public function open_connection (){
		
	
		$this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
		
		$this->conn->autocommit($this->_auto_commit_);
		$error = $this->conn->connect_error;
		if ($error) {			
			return false;;
		}	
		return true;
	}
	
	function close_connection (){
		//$this->conn->close();	
		$this->conn=null;	
		
	}
	
	public function set_auto_commit_($boolean_value){
		$this->_auto_commit_ = $boolean_value;
		
	}
	
	
	public function __commit(){
		$this->conn->commit();	
		return true;
	}
	
	public function __rollback(){
		$this->conn->rollback();
		
	}
	
	public function insert ($table , $fieldsArray ){
			
			$fields = " (";
			$values = " (";
			$prefix = "";
			
			foreach($fieldsArray as $key=>$val){
				
				$fields .= $prefix.$key;
				$values .= $prefix."'".$this->get_sql_value_string($val)."'";
				$prefix = " , ";
			}
			$fields .= ")";
			$values .= ")";
			
			$this->query = "INSERT INTO ".$table.$fields." VALUES ".$values;
			//echo($this->query );
			$insert_id = $this->run_insertQuery($this->query);
			//$insert_id = $this->run_insertQuery($table, $fieldsArray );
			//echo($this->query);
			
		
			return  $insert_id;
	}
	
	public function replace  ($table , $fieldsArray ){
			
			$fields_insert = " (";
			$values_insert = " (";
			$prefix_insert = "";
			
			foreach($fieldsArray as $key=>$val){
				
				$fields_insert .= $prefix_insert.$key;
				$values_insert .= $prefix_insert."'".$this->get_sql_value_string($val)."'";
				$prefix_insert = " , ";
			}
			$fields_insert .= ")";
			$values_insert .= ")";
			
			$values = "";
			$prefix = "";
			
			foreach($fieldsArray as $key=>$val){
				$values .= $prefix.$key."='".$this->get_sql_value_string($val)."'";
				$prefix = " , ";
			}
			$fields .= "";
			$values .= "";
			
			$this->query = "INSERT INTO ".$table.$fields_insert." VALUES ".$values_insert." ON DUPLICATE KEY UPDATE ".$values;
			
			$returnVal = $this->run_query($this->query);
			
			
			return $returnVal;
	}
	
	public function update ($table , $fieldsArray, $where ){
			$fields="";
			$values = "";
			$prefix = "";
			
			foreach($fieldsArray as $key=>$val){
				$values .= $prefix.$key."='".$this->get_sql_value_string($val)."'";
				$prefix = " , ";
			}
			$fields .= "";
			$values .= "";
			
			$this->query = "UPDATE ".$table." SET ".$values." WHERE ".$where;
			
			$returnVal = $this->run_query($this->query);
			//echo($this->query);
			
			return $returnVal;
	}
	
	public function delete ($table , $where ){
			
			$this->query = "DELETE FROM ".$table." WHERE ".$where;
			
			$returnVal = $this->run_query($this->query);
			//echo($this->query);
			
			
			return $returnVal;
	}	
	
	
	public function get_record ($table, $where){
			
			
			
			$this->query = "SELECT * FROM ".$table." WHERE ".$where."";
			
			$result = $this->run_select_query($this->query);
			//echo($this->query);			
			return $result;
	}
	
	public function get_all_record ($table , $where="" , $fields="*"){
			
			if($fields == ""){
				$fields="*";
			}
			
			$this->query = "SELECT  ".$fields." FROM ".$table;
			
			if($where != ""){
				$this->query .= $where;
			}
			//echo($this->query);
			$result = $this->run_select_query($this->query);
			return $result;
	}
	
	public function select ($table , $fieldsArray, $where ){
			
			$fields = "";
			$prefix = "";
			
			foreach($fieldsArray as $val){
				$values .= $prefix."`".$val."`";
				$prefix = " , ";
			}
			$values .= "";
			
			$this->query = "SELECT ".$values." FROM ".$table." WHERE ".$where;
			
			$result = $this->run_select_query($this->query);
			return $result;
	}
	
	public function get_field ($table , $field, $where){
			$this->query = "SELECT ".$field." from ".$table." WHERE ".$where;
			//echo($this->query);
			$result = $this->run_select_query($this->query);
			if(!empty($result)){
				if ($row = $result->fetch_row()) {
					return $row[0];
				}else{
					return "";
				}
			}else{
				return "";
			}
	}
	
	public function get_sum ($table , $field, $where){
			$this->query = "SELECT SUM(".$field.") from ".$table." WHERE ".$where;
			$result = $this->run_select_query($this->query);
			if(!empty($result)){
				if ($row = $result->fetch_row()) {
					return $row[0];
				}else{
					return 0;
				}
			}else{
				return 0;
			}
	}
	
	public function get_record_count ($table ,$where){
			$this->query = "Select COUNT(*) as totle from ".$table." WHERE ".$where;
			//echo($this->query);
			$result = $this->run_select_query($this->query);
			if(!empty($result)){
				$row = $result->fetch_assoc();
				return $row["totle"];
			}else{
				return 0;	
			}
	}
	public function getrecord_count ($table ){
			$this->query = "Select COUNT(*) as totle from ".$table;
			
			$result = $this->run_select_query($this->query);
			if(!empty($result)){
				$row = $result->fetch_assoc();
				return $row["totle"];
			}else{
				return 0;	
			}
	}
	
	public function is_record ($table , $where){
			$this->query = "SELECT * from ".$table." WHERE ".$where;
			return $this->is_record_by_sql($this->query);
	}
	
	public function is_record_by_sql ($sql){
			$returnVal = false;
			$result = $this->run_select_query($sql);
			if ($row = $result->fetch_row()) {
				$returnVal = true;
			}
			return $returnVal;
	}
	
	public function run_insertQuery ($sql){
	//	echo ("[SQL:".$sql."]");
		//$_SESSION["out"] .= "<br/>[SQL:".$sql."]";
		$insert_id = -1;
		if($this->_auto_commit_ == true){
			$this->open_connection();
		}
		if ($this->conn->query($sql) === TRUE) {
			$insert_id =  $this->conn->insert_id;
		}else{
			
		} 
		if($this->_auto_commit_ == true){
			$this->close_connection();
		}
		return $insert_id;
	}
	
	public function run_insertQuery_ ($table, $fieldsArray){
		
		try {

			$fields = " (";
			$prefix = "";
			$val_1=" (";
			$key_2='$stmt->bind_param("sss", ';
				foreach($fieldsArray as $key=>$val){
					$fields .= $prefix.$key;
					$val_1.= $prefix."?";
					$key_2 .=$prefix."$".$key;
					$prefix = ", ";
				}
			$fields .= ")";
			$key_2.=" );";
			$val_1 .=") \")";
	
				
		$sqlc =	"\"INSERT INTO ".$table." ".$fields." VALUES ".$val_1.";";
		$insert_id = -1;
		if($this->_auto_commit_ == true){
			$this->open_connection();
		}

		
		$myfile = fopen("newfile.php", "w") or die("Unable to open file!");
		$write_data ="";
		$write_data .= "<?php \n";
		$write_data .= "\$stmt = \$this->conn->prepare(";
		$write_data .= "".$sqlc."\n";
		$write_data .= $key_2."\n";
		foreach($fieldsArray as $key=>$val){

			$write_data .= "$".$key."=\"".$val."\"; \n";
		}
		$write_data .="?> \n";
		fwrite($myfile,$write_data);
		fclose($myfile);

		include("newfile.php");
		$stmt->execute();
		$insert_id = $stmt->insert_id;
		if($this->_auto_commit_ == true){
			$this->close_connection();
		}
		

		}catch(PDOException $e)  {
   			 echo "Error: " . $e->getMessage();
   		 }
   		 return $insert_id;
	}
	
	public function run_query ($sql){
		//echo ("[SQL:".$sql."]");
		//$_SESSION["out"] .= "<br/>[SQL:".$sql."]";
		$returnVal = false;
		if($this->_auto_commit_ == true){
			$this->open_connection();
		}
		if ($this->conn->query($sql) === TRUE) {
			$returnVal =  true;
		}else{
			
		} 
		if($this->_auto_commit_ == true){
			$this->close_connection();
		}
		return $returnVal;
	}
	
	public function run_select_query ($sql){
		if($this->_auto_commit_ == true){
			$this->open_connection();
		}
		$result = $this->conn->query($sql);
		if($this->_auto_commit_ == true){
			$this->close_connection();
		}
		return $result;
	}
		
	public function get_sql_value_string($theValue) 
	{
		/*
	  if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	  }
	
	  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
		*/  
	  return $theValue;
	}	

	function getsql(){
		return $this->query;
	}	
		
}
?>