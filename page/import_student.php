<!-- --------------------------- Start User Registration------------------------------- -->

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Import Student Details</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <div class="col-sm-12">
              <form name="myform"  action="mainpage.php" method="post" enctype="multipart/form-data">
        <input type="file" value="Select" name="file" required="" accept="xls,csv,xlsx">
        <input type="hidden" name="page" value="import_student" />
        <input type="hidden" name="_do" value="import_student" />
        <div class="col-sm-12 mt-1 mb-1">
        <button type="Submit" class="btn btn-sm my-2 btn-info">Submit</button>  
        <a class="btn btn-sm ml-2 btn-secondary px-2 btn-outline-warning text-white" href="mainpage.php?page=import_student&_do=no" class="nav-link">Cancel</a>    
       </div>
      </form>

    <?php
    $uploaded_file_name="";
      if ($_arguments["_do"] == "import_student"){

         $data = upload_file($_arguments);
         $uploaded_file_name =$data[1];

      if($uploaded_file_name != ""){

         echo('<a class="btn btn-warning l-2" href="mainpage.php?page=import_student&_do=savedata">Save to database</a> <br/><br/>');

         $_SESSION["file_name_"] = $uploaded_file_name;
        $file = fopen($uploaded_file_name,"r");
        $a;
        echo('<table class="table">');
        $count_ =1;
        while(! feof($file)){
         $a =fgetcsv($file);
         echo('<tr>');
         echo('<td>'.$count_.'</td>');
         for ($g =0; $g < 4; $g++) {
            echo('<td>'.$a[$g].'</td>');
             }
          $count_++;
           echo('</tr>');

        }

        echo('</table>');
         
            
    
      }
  } else if ($_arguments["_do"]== "savedata"){

        openConnection();

         $uploaded_file_name =$_SESSION["file_name_"];

        $file = fopen($uploaded_file_name,"r");
        $a;
       
        $count_ =1;
        $databaseresult =1;
        while(! feof($file)){
         $a =fgetcsv($file);
         echo('<tr>');
         $id;
          $name;
           $branch; 
           $medium;
         for ($g =0; $g < 4; $g++) {
           // echo('<td>'.$a[$g].'</td>');
            if($g == 0){
              $id=$a[$g];
            }

             if($g == 1){
              $name=$a[$g];
            }

             if($g == 2){
              $medium=$a[$g];
            }

             if($g == 3){
              $branch=$a[$g];
            }
           }
          $count_++;
       
          if(trim($id) != ""){
           $insert_std_data["registration_number"]=$id;
           $insert_std_data["full_name"]=$name;
           $insert_std_data["medium"]=$medium;
           $insert_std_data["regional_center"]=$branch;
           $insert_std_data["cource_id"]=1;
           $insert_result = insert(1,$insert_std_data);
           if($insert_result < 1){
            $databaseresult =0;
           }
         } 
        }
        if($databaseresult == 0){
              echo('<div>');
              $message_obj->get_save_error_message();
                echo('</div>');
        }else{
            echo('<div class="col-lg-4 col-md-4 col-sm-6">');
            $message_obj->get_save_message();
              echo('</div>');
        }
     
  }



    ?>

  

 


    </div>

  </div>




   