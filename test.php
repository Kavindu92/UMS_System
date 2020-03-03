 <?php
$myfile = fopen("newfile.csv", "w") or die("Unable to open file!");
$txt = "John,Doe\n";
fwrite($myfile, $txt);
$txt = "jjjj,kkkk\n";
fwrite($myfile, $txt);
fclose($myfile);
?> 