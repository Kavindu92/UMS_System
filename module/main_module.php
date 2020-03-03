<?php
class main_module {
	


	public function open_connection (){
	
		$result = $GLOBALS['obj_db']->open_connection();
		return $result;
	}
	
	function close_connection (){
		
		$GLOBALS['obj_db']->close_connection();	
	}
	
	public function set_auto_commit($boolean_value){
		
		$GLOBALS['obj_db']->set_auto_commit_($boolean_value);
		
	}
	
	
	public function _commit(){
		$result = $GLOBALS['obj_db']->__commit();	
		return $result;
	}
	
	public function _rollback(){
		$GLOBALS['obj_db']->__rollback();
	}

	
	function insert($index,$data_array){
			$table_name = $GLOBALS['fix_object']->get_table($index);		
		
		$result = $GLOBALS['obj_db']->insert($table_name ,$data_array );
		return $result;
	}
	
	
	function update($index , $where_array, $value_array){
		$table = $GLOBALS['fix_object']->get_table($index);
		
		$prefix = "";
		$where="";
		foreach($where_array as $key => $value){
			$where .= $prefix . $key . "= '".$value."' ";
			$prefix =" AND ";
		}
		$result = $GLOBALS['obj_db']->update($table, $value_array, $where );
		return $result;
		
	}
	
	function delete($index, $where_array){
	   $table = $GLOBALS['fix_object']->get_table($index);
		$prefix = "";
		$where="";
		foreach($where_array as $key => $value){
			$where .= $prefix . $key . "= '".$value."' ";
			$prefix =" AND ";
		}
		
		$data =$GLOBALS['obj_db']->delete($table , $where);
		return $data;
	}
	
	function get_record($index , $where_array){
		$table = $GLOBALS['fix_object']->get_table($index);
		$prefix = "";
		$where="";
		foreach($where_array as $key => $value){
			$where .= $prefix . $key . "= '".trim($value)."' ";
			$prefix =" AND ";
		}
	
		$data =$GLOBALS['obj_db']->get_record($table , $where);
		return $data;
	}
	
	function get_record_with_order($index , $where_array,$order){
		$table = $GLOBALS['fix_object']->get_table($index);
		$prefix = "";
		$where="";
		foreach($where_array as $key => $value){
			$where .= $prefix . $key . "= '".$value."' ";
			$prefix =" AND ";
		}
	
		$data =$GLOBALS['obj_db']->get_record($table , $where.$order);
		return $data;
	}
	
	function get_single_record_array($sql_string){

		 $data =$GLOBALS['obj_db']->run_select_query($sql_string);
		 $data_array;
		if($data != ""){
			while($row = $data->fetch_assoc()){
				foreach ($row as $key => $value) {
					$data_array[$key]=$value;
					//echo($key);
				}
			}
				
		}
		return $data_array;
	}
	
	function get_more_record_array($sql_string){
	
		 $data =$GLOBALS['obj_db']->run_select_query($sql_string);
		 $data_array;
		if($data != ""){
			$count =0;
			while($row = $data->fetch_assoc()){
				foreach ($row as $key => $value) {
					$data_array[$key][$count]=$value;
					$count++;
				}
			}
				
		}
		return $data_array;
	}
	
	
	
	function get_all_record($fiels_array,$limite,$OFFSET,$table_name){
		// $table = $GLOBALS['fix_object']->get_table($index);
		
		$row = "";
		$prifix="";
		foreach($fiels_array as $a){
			$row .=$prifix.$a;
			//$row .=" , ";
			$prifix = ",";
		}

		//$row =  substr($row, "0", strlen($string) - 2); 
		$whre =" LIMIT ".$limite ." OFFSET ".$OFFSET;
		$data =$GLOBALS['obj_db']->get_all_record($table_name ,$whre, $row );
		return $data;
	}
	function get_all_record_with_order($fiels_array,$limite,$OFFSET,$table_name,$order_){
		// $table = $GLOBALS['fix_object']->get_table($index);
		
		$row = "";
		foreach($fiels_array as $a){
			$row .=$a;
			$row .=" , ";
		}
		$row =  substr($row, 0, strlen($string) - 2); 
		$whre ="SELECT ".$row." FROM ".$table_name." ".$order_." LIMIT ".$limite ." OFFSET ".$OFFSET;
		$data =$GLOBALS['obj_db']->run_select_query($whre );
		return $data;
	}
	
	function all_record_($table){
		// $table = $GLOBALS['fix_object']->get_table($index);
		
		$data =$GLOBALS['obj_db']->get_all_record($table ,"", "" );
		return $data ;
	}
	
	function get_record_count($table){
		// $table = $GLOBALS['fix_object']->get_table($index);
		$data =$GLOBALS['obj_db']->getrecord_count($table);
		return $data;
	}
	
	function get_single_record($index,$value_){
		// need to test
	
		$table=$GLOBALS['fix_object']->get_table($index);
		$fild_name=$GLOBALS['fix_object']->getField_list($index);
		$sql= "SELECT * FROM ".$table." WHERE ".$fild_name[0]." ='".$value_."'";
		$data =$this->run_select_sql($sql);
		return $data;
	}
	
	
	function run_select_sql($sql){
	
	 $data =$GLOBALS['obj_db']->run_select_query($sql);
		
		return $data;
	}
	
	public function get_record_count_ ($table ,$where){
		// $table = $GLOBALS['fix_object']->get_table($index);
		$data =$GLOBALS['obj_db']->get_record_count($table,$where);
		
		return $data;
	}
	
	public function get_field ($index , $field, $where_array){
		$table = $GLOBALS['fix_object']->get_table($index);
		
		$prefix = "";
		$where="";
		foreach($where_array as $key => $value){
			$where .= $prefix . $key . "= '".$value."' ";
			$prefix =" AND ";
		}
	
		$data =$GLOBALS['obj_db']->get_field($table , $field,$where);
		return $data;
		
	}

	function getsql(){
		return $GLOBALS['obj_db']->getsql();
	}
	
	function run_query($sql){
		$data =$GLOBALS['obj_db']->run_query($sql);
		return $data;
	}
	function print_sql($sql){
		echo($sql);
	}
	
	function send_email($address,$subject,$content){
		//echo($content);
	//	mail("someone@example.com","My subject",$msg);
	}
	function upload_single_image($files){
	
	$result[0] = 0;
	$file = $files["fileInput"];
	$name = $_FILES["file"]["name"];
	$size = $_FILES["file"]["size"];
	$type = $_FILES["file"]["type"];
	$tmpname = $_FILES["file"]["tmp_name"];
	$max = 31457280;
	$extention = strtolower(substr($name, strpos($name, ".")+ 1));
		$filename = date("Ymjhis");
		$filename.="T";
	
		
	if(! empty($name)){
	 	if(($extention == "jpg" || $extention == "jpeg" ) && $size < $max){
		 	if(move_uploaded_file($tmpname, "images/".$filename.".".$extention)){

				//$result[1] =  "post/".$files["user_id"].".".$extention;
				$result[1] =  "images/".$filename.".".$extention;
				$result[0] = 1;
				$result[2] = $extention;
				
			}else{
				$result[0] = "cant upload";	
			}
		}else{
			$result[0] ="invalid file format or file is larg" ;
		}
		
	}
	
		return $result;
	}
	


	function upload_file($files){
	
	$result[0] = 0;
	//$file = $files["fileInput"];
	$name = $_FILES["file"]["name"];
	$size = $_FILES["file"]["size"];
	$type = $_FILES["file"]["type"];
	$tmpname = $_FILES["file"]["tmp_name"];
	$max = 31457280;
	$extention = strtolower(substr($name, strpos($name, ".")+ 1));
		$filename = date("Ymjhis");
		$filename.="T";
	
		
	if(! empty($name)){
	 	if(($extention == "csv" || $extention == "xls" ) && $size < $max){
		 	if(move_uploaded_file($tmpname, "csv/".$filename.".".$extention)){

				//$result[1] =  "post/".$files["user_id"].".".$extention;
				$result[1] =  "csv/".$filename.".".$extention;
				$result[0] = 1;
				$result[2] = $extention;
				
			}else{
				$result[0] = "cant upload";	
			}
		}else{
			$result[0] ="invalid file format or file is larg" ;
		}
		
	}
	
		return $result;
	}
	

//////////
}
?>