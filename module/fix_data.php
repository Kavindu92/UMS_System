<?php
class fix_data {
	
	var $table = array();
	var $table_name=array();
	
	function __construct(){
		
	$this->table[0] = array('id','name','description','_status');
	$this->table[1] = array('id', 'registration_number', 'full_name', 'contact_number', 'email', 'gender','medium' ,'photo', '_status','regional_center', 'cource_id' );
	$this->table[2] = array('id', 'name', 'email', 'password', 'contact_number', '_status'  );
		 	 
	
	$this->table_name[0]="program";
	$this->table_name[1]="student";
	$this->table_name[2]="user";
	
	
	}


	public function fix_data($index,$fieldsArray){
		
		$data;
		$count2 =0;
		$count3 =0;
		$count = sizeof($this->table[$index]);
		for($x = 0; $x < $count; $x++){
			$name = $this->table[$index][$x];
			foreach($fieldsArray as $y_key=>$y_value){
				
  				if($y_key ==$name){
					$data[$y_key] = $y_value;	
								
				}
  			}
		}
		return $data;
	}	

	public 	function getField_list($index){
					
			return $this->table[$index];
	}

	public function get_table($index){
		
		return $this->table_name[$index];
	}


}
?>
