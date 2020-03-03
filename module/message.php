<?php
class  message{

	function set_access_error(){
	$this->get_error_message("Sorry please log with admin account first");

	
}
###########################################
function get_save_message(){
	$this->get_success_message(" Your data insert successfully");

}
#******************************************
function get_save_error_message(){
	$this->get_error_message('Sorry saving error ');

}

###########################################
function get_update_message(){
	$this-> get_success_message("Your data update successfully");

}
#####################
function get_send_message(){
	$this-> get_success_message("Your message sent");

}
#****************************************
function get_update_error_message(){
	$this->get_error_message("Sorry update error");

}
###########################################
function get_delete_message(){
	$this->get_success_message("Your data delete successfully");

}
#***************************************
function get_delete_error_message(){
	$this->get_error_message("Sorry delete error !");

}

###########################################
function get_upload_message(){
	$this->get_success_message("Your data delete successfully");

}
#***************************************
function get_upload_error_message($msg){
	$this->get_error_message($msg);

}
function get_log_error_message(){
	$this->get_error_message("email or password incorrect");

}
function get_order_success_message(){
	$this->get_success_message("Your order success");

}
function get_password_cahnge_success_message(){
	$this->get_success_message(" Password change success !");

}








########################################
function get_success_message($msg){

$a='<div class="alert alert-warning col-sm-12">';
		$a.=' <a href="#" class="close" data-dismiss="alert">&times;</a>';
			$a.=' <strong>succeed!</strong>'.$msg.'</div>';
			
			echo($a);

}
###########################################
function get_error_message($msg){

$a='<div class="alert alert-warning col-sm-12">';
		$a.=' <a href="#" class="close" data-dismiss="alert">&times;</a>';
			$a.=' <strong>Warning!</strong>'.$msg.'.</div>';
			
			echo($a);
}


function get_error($msg){
	$a='<div class="alert alert-danger col-sm-12">';
		$a.=' <a href="javascript:void(0)" class="close" data-dismiss="alert">&times;</a>';
			$a.=' <strong>Warning!</strong>'.$msg.'.</div>';
			
			echo($a);
	
}
}
?>