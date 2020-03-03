<?php
$_arguments = array();
if(count($_POST) > 0){
	$_arguments = $_POST;
}else if(count($_GET) > 0){
	$_arguments = $_GET;
}
session_start();

$servername = "localhost";
$username = "root";
$password = "123456789";
$dbname = "ums";



require_once("database/database_connection.php");
$GLOBALS['obj_db']  = new database_connection($servername , $username, $password , $dbname );



require_once("module/main_module.php");
require_once("module/fix_data.php");
require("module/message.php");
require_once("module/methods.php");


//$main_module_obj= new main_module();
//$fix_obj= new fix_data();
$message_obj = new message();
$GLOBALS['fix_object']=new fix_data();
$GLOBALS['main_module_obj']=new main_module();


?>