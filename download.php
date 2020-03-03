<?php
	session_start();

$myfile = fopen("student_details.csv", "w") or die("Unable to open file!");
fwrite($myfile, $_SESSION["csv_file_data"]);
fclose($myfile);

?> 
<script type="text/javascript">
	window.location.replace('student_details.csv');
</script>