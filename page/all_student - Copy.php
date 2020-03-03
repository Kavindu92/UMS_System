<?php


?>
<link rel="stylesheet" type="text/css" href="css/colour.css">
<div class="content-wrapper">
 <section class="content-header">
  <div class="container-fluid">
   <div class="row ">
    <div class="col-lg-12 ">
      <h2><a>Student List</a></h2>

        <div class="container-fluid">
        <form name="myform" action="mainpage.php" method="post">

          <div class="row py-4">
          <div class="col-lg-6 col-md-4 py-2">
            <select name="filterby" class="form-control ">
              <option value="registration_number">Reg:number</option>
              <option value="full_name">Full name</option>
              <option value="contact_number">Contact number</option>
            </select>
          </div>
          <div class="col-lg-4 md-4 sm-6 py-2">
            <input type="text" name="search_value" type="search" placeholder="Search" aria-label="Search" class="form-control" required="required" />
          </div>
          <div class="col-lg-4 md-4 sm-6 py-2">
            <button type="submit" class="btn btn-dark btn-outline-primary text-white mr-2">Search</button>
          <a href="download.php?" target="blank" type="submit" class="btn btn-info text-white">CSV</a>
          </div>
          <input type="hidden" name="page" value="allstudent" />
          <input type="hidden" name="_do" value="search" />
        </form>
        </div>
  
      <div class="col-sm-12 table1"> 
        <table class="table table-hover">
          <thead>
            <tr class="table-info">
              <th>Reg:number</th>
              <th>Full name</th>
              <th>program</th>
              <th>Center</th>
              <th>Photo</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            
            openConnection();

            if($_arguments["_do"] == "delete"){
              $action_where["id"] = $_arguments["id"];
              
              
              if($_arguments["del"]=="0"){
                  $action_val["_status"] =1;
                 update(1,$action_where,$action_val);  
              }else{
                  $action_val["_status"] =0;
                  update(1,$action_where,$action_val); 
              }

             
             
              
           //  echo(getsql());

            }
            
            $limit = 20;
            if($_arguments["_do"] == "search"){
               $where_data["_status"]="1";
               $where_data[$_arguments["filterby"]]=$_arguments["search_value"];
               $student_result = get_record_with_order(1,$where_data," ORDER BY id DESC LIMIT 20");
            }else{
                $from =  $_arguments['from'];
                $_SESSION["from1"]= $from;
                $list = $GLOBALS['fix_object']->getField_list(1);
                $student_result = get_all_record($list,$limit,$from,"student");
                $record_count =get_record_count_(1,"id > 0");
                $next = $from + $limit;
                $back = $from-$limit;



              // $where_data["_status"]="1";
             //  $student_result = get_record_with_order(1,$where_data," ORDER BY id DESC LIMIT 20");
                
            }
            $csv_data="Registration number,Full name,Program,regional_center,Photo\n";
            if($student_result != ""){
              while($row = $student_result->fetch_assoc()) {
                echo('<tr>');
                echo('<td>');
                echo('<a href="mainpage.php?page=updatestudent&_do=no&id='.$row["id"].'">'.$row["registration_number"].' &nbsp; <i class="fas fa-pencil-alt pencileforedit"></a>');
                $csv_data .=$row["registration_number"].",";
                 echo('</td>');

                echo('<td>'.$row["full_name"].'</td>');
                 $csv_data .=$row["full_name"].",";

                $where["id"] = $row["cource_id"];
                $data = get_field(0,"name",$where);
                echo('<td>'.$data.'</td>');
                $csv_data .=$data.",";

                echo('<td>'.$row["regional_center"].'</td>');
                 $csv_data .=$row["regional_center"].",";


                if($row["photo"]== ""){
                    echo('<td><a class="text-danger"> No </a></td>');
                     $csv_data .="No\n";
                }else{
                    $csv_data .="Yes\n";
                    echo("<td>Yes</td>");

                }
                echo('<td>');
                if($row["_status"] == "1"){
                  echo('<a href="mainpage.php?page=allstudent&del=1&_do=delete&from=0&id='.$row["id"].'">');
                  echo('<button type="button" class="btn btn-sm btn-success text-center"> &nbsp; Active &nbsp;</button>');
                  echo('<a/>');
                }else{
                  echo('<a href="mainpage.php?page=allstudent&del=0&_do=delete&from=0&id='.$row["id"].'">');
                  echo('<button type="button" class="btn btn-sm btn-danger text-center">Deactive</button>');
                  echo('<a/>');
                }
                echo('</td>');
                echo('</tr>');
              }

               $_SESSION["csv_file_data"] = $csv_data; 
            }

            ?>

          </tbody>
        </table>



         <?php
        
      if($_arguments["_do"] != "search"){
      if($from > 1){
      ?>
        <a href="mainpage.php?_do=no&page=allstudent&from=<?php echo($back); ?>&option=all">
        <button type="button" class="btn btn-info btn-sm">
          <span class="glyphicon glyphicon-backward" aria-hidden="true"></span> Back
      </button>
            </a>
            <?php } ?>
    
        <?php
      if($record_count > $next){
      ?>
        <a href="mainpage.php?_do=no&page=allstudent&from=<?php echo($next); ?>&option=all">
        <button type="button" class="btn btn-info btn-sm mr-2">
          <span class="glyphicon glyphicon-forward" aria-hidden="true"></span> Next
      </button>
            </a>
            <?php }
      echo('Total '.$record_count." | ");
      $presernt_page = $from / $limit;
      $total_page = ceil($record_count/$limit);
      $presernt_page++;
      echo('Page '.$presernt_page.' of '.$total_page);
    
      }
        
       
       ?>




      </div>
    </div>
  </div>
</div>
</section>
</div>


<?php



?> 