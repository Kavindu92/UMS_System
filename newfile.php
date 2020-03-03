<?php 
$stmt = $this->conn->prepare("INSERT INTO test_tb  (name, tell, _status) VALUES  (?, ?, ?) ");
$stmt->bind_param("sss", $name, $tell, $_status );
$name="hemarat$han"; 
$tell="0718339753"; 
$_status="active"; 
?> 
