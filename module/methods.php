<?php 
function fix_data($index,$data_array){
	$result = $GLOBALS['fix_object']->fix_data($index,$data_array);
	return $result;
}
/*
 *  call below function to open database connection
 */
function openConnection(){
	 $GLOBALS['main_module_obj']->open_connection();
}
/*
 *  call below function to close database connection
 */
function close_connections (){	
	 $GLOBALS['main_module_obj']->close_connection();	
}

/*
 *  below function can use to set auto commit. you should provide boolean (true / false)value as a argument.
 *  when you set this value as a false, you shuld call _commit(); functin you self. 
 */
function set_auto_commit($boolean_value){	
	$result = $GLOBALS['main_module_obj']->set_auto_commit($boolean_value); 
}


/*
 *  below _commit(); function can useto commit when you set auto commit false.
 */	
function _commit(){
	$result = $GLOBALS['main_module_obj']->_commit();	
	return $result;
}
/*
 *  Below function can use to rolback 
 */	
function _rollback(){
	$GLOBALS['main_module_obj']->__rollback();
}
/*
 *  This function can call to insert record to database. 
 *  the value of index means table index that in "fix_data" file that in module folder
 *  data_array means values as a array like below.
 *  $data["name "] = "example";
 *  the function return last insert id. 
 */	
function insert($index,$data_array){	
	$result = $GLOBALS['main_module_obj']->insert($index ,$data_array );
	return $result;
}
/*
 * Below function can use for update records and it will return 0 or 1.  
 * the value of index means table index that in "fix_data" file that in module folder
 * $where_array["id"] =1;
 * $where_array["age"] =10;
 * 
 * $value_array["name"]="example";
 * $value_array["tell"]="0123456789";
 * 
 */
function update($index , $where_array, $value_array){
	$result = $GLOBALS['main_module_obj']->update($index, $where_array, $value_array );
	return $result;
}
/*
 * Below function can use for delete a record and it will return 0 or 1.  
 * the value of index means table index that in "fix_data" file that in module folder
 * $where_array["id"] =1;
 * $where_array["age"] =10;
 * 
 */
function delete($index, $where_array){
	$data =$GLOBALS['main_module_obj']->delete($index , $where_array);
	return $data;
}
/*
 * Below function can use for get a records from database and it will return mysql object.  
 * the value of index means table index that in "fix_data" file that in module folder
 * $where_array["id"] =1;
 * $where_array["age"] =10;
 * 
 */	
function get_record($index , $where_array){
	$data =$GLOBALS['main_module_obj']->get_record($index , $where_array);
	return $data;
}
/*
 * Below function can use for get a records from database within order and it will return mysql object.  
 * the value of index means table index that in "fix_data" file that in module folder
 * $where_array["id"] =1;
 * $where_array["age"] =10;
 * 
 *  "ORDER BY id DESC"  // thirdargument should be like this
 */		
function get_record_with_order($index , $where_array,$order_string){
	$data =$GLOBALS['main_module_obj']->get_record_with_order($index , $where_array,$order_string);
	return $data;
}

function getsql(){
	$data =$GLOBALS['main_module_obj']->getsql();
	return $data;
}


 function get_field ($index , $field, $where_array){
		$data =$GLOBALS['main_module_obj']->get_field($index , $field, $where_array);
		return $data;
		
}

function get_all_record($fiels_array,$limite,$OFFSET,$table_name){
		// $table = $GLOBALS['fix_object']->get_table($index);
		
			$data =$GLOBALS['main_module_obj']->get_all_record($fiels_array,$limite,$OFFSET,$table_name);
		
		return $data;
	}


 function get_record_count_ ($index ,$where){
		$table = $GLOBALS['fix_object']->get_table($index);
		$data =$GLOBALS['main_module_obj']->get_record_count_($table,$where);
		return $data;
	}
	
	
	function get_single_record_array($sql_string){
	
		$data =$GLOBALS['main_module_obj']->get_single_record_array($sql_string);
		return $data;
	}


	function upload_file($file){
		$data =$GLOBALS['main_module_obj']->upload_file($file);
		return $data;
	}
	/*
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
	*/
	function upload_single_image($files){
	
		$data =$GLOBALS['main_module_obj']->upload_single_image($files);
		return $result;
	}

	 function base64ToImage($base64_string, $output_file) {
                          $file = fopen($output_file, "wb");
                          $data = explode(',', $base64_string);
                          fwrite($file, base64_decode($data[1]));
                          fclose($file);
                           return $output_file;
                  }
 ?>

