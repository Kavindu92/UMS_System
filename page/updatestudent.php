<!-- --------------------------- Start User Registration------------------------------- -->

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Student Details</h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<!-- --------------------------- End User Registration------------------------------- -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box">


               <div class="card">
                   <div class="col-12 pt-3 card-header">
                    <a href="#"> <i class="fas fa-user-edit"></i> Update student</a>
                     <?php
                   
                     if($_arguments != null){
                      if($_arguments["_do"] =="update_student"){
                        if($_arguments["full_name"] == ""){
                          $message_obj->get_error_message(" Enter first name !");
              
                        } else if ($_arguments["cource_id"] == ""){
                          $message_obj->get_error_message(" Select program !");
                        }else{
                          
                          $fixed_data["full_name"] =$_arguments["full_name"]; 
                          $fixed_data["contact_number"] =$_arguments["contact_number"]; 
                          $fixed_data["email"] =$_arguments["email"]; 
                          $fixed_data["gender"] =$_arguments["gender"]; 
                          $fixed_data["regional_center"] =$_arguments["regional_center"]; 
                          $fixed_data["cource_id"] =$_arguments["cource_id"]; 
                          

                         $upd_where["id"] = $_arguments["id"];
                          openConnection();

                          $result = update(1,$upd_where,$fixed_data);
                         
                         
                         if($result > 0){
                           if($_arguments["photo"] != ""){

                             base64ToImage($_arguments["photo"],"img/".$result.".jpg");
                             $value_array["photo"]="img/".$_arguments["id"].".jpg";
                             $where_array["id"]= $_arguments["id"];
                             $result1 = update(1,$where_array,$value_array);
                             if($result1 > 0){
                               
                               
                             }else{
                              // if does not update image and record
                              $message_obj->get_error_message(" Sorry upload error try again!");
                             }

                          }
                          $message_obj->get_success_message(" Success !");
                         }else{
                          // if does not save student details
                          $message_obj->get_error_message(" Sorry try again !");
                         }  

                       }

                        
                      }
                     }


                     $student = get_single_record_array('SELECT * FROM student WHERE id="'.$_arguments["id"].'"');
                     $course = get_single_record_array('SELECT * FROM program WHERE id="'.$student["cource_id"].'"');

                  ?>
                   </div>
                                    
                      <div class="card-body">
                        <form name="myform" onsubmit="return validform()" action="mainpage.php" method="post">

                                              <div class="form-group row">
                                                  <label for="full_name" class="col-md-4 col-form-label text-md-right">Reg:number</label>
                                                  <div class="col-md-6">
                                                      <input type="text"  class="form-control" name="registration_number" maxlength="9" value="<?php echo($student["registration_number"]); ?>" disabled="" />
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="full_name" class="col-md-4 col-form-label text-md-right">Full name</label>
                                                  <div class="col-md-6">
                                                      <input type="text" id="full_name" value="<?php echo($student["full_name"]); ?>" class="form-control" name="full_name" maxlength="100" />
                                                  </div>
                                              </div>

                                               
              
                                              <div class="form-group row">
                                                  <label for="user_name" class="col-md-4 col-form-label text-md-right">Contact number</label>
                                                  <div class="col-md-6">
                                                      <input type="text" value="<?php echo($student["contact_number"]); ?>" maxlength="12" id="contact_number" class="form-control" name="contact_number"/>
                                                  </div>
                                              </div>
              
                                              
              
                                              <div class="form-group row">
                                                  <label for="present_address" class="col-md-4 col-form-label text-md-right">Email</label>
                                                  <div class="col-md-6">
                                                      <input type="text" value="<?php echo($student["email"]); ?>" id="email" name="email" class="form-control">
                                                  </div>
                                              </div>
              
                                              <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Gender </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" name="gender">
                                                      <?php
                                                        if($student["gender"] == "Male"){
                                                          echo('<option value="Male">Male</option>');
                                                          echo('<option value="Fe-male">Fe-male</option>');
                                                          echo('<option value="Other">Other</option>');
                                                        }else if($student["gender"] == "other"){
                                                          echo('<option value="Other">Other</option>');
                                                           echo('<option value="Male">Male</option>');
                                                          echo('<option value="Fe-male">Fe-male</option>');
                                                        }else{
                                                          echo('<option value="Fe-male">Fe-male</option>');
                                                           echo('<option value="Other">Other</option>');
                                                           echo('<option value="Male">Male</option>');
                                                        }
                                                      ?>
                                                        
                                                     </select>
                                                  </div>
                                              </div>

                                               <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Program </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" name="cource_id">
                                                      
                                                      <?php
                                                      echo('<option value="'.$course["id"].'">'.$course["name"].'</option>');
                                                       
                                                        $coursewhre["_status"]="1";
                                                        $cource_list = get_record(0,$coursewhre);
                                                          if($cource_list !=""){
                                                            $cource_list1 = $cource_list;
                                                            while($row = $cource_list->fetch_assoc()) {
                                                              if($course["id"] != $row["id"]){
                                                                 echo('<option value="'.$row["id"].'">'.$row["name"].'</option>');
                                                               }
                                                            }
                                                          }

                                                          close_connections();
                                                      ?>
                                                        
                                                     </select>
                                                  </div>
                                              </div>


                                              <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Regional center  </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" name="regional_center">
                                                        <option value="<?php  echo($student["regional_center"]);  ?>"><?php  echo($student["regional_center"]);  ?></option>
                                                        <option value="Colombo">Colombo</option>
                                                        <option value="Kandy">Kandy</option>
                                                        <option value="Matara">Matara</option>
                                                        <option value="Gampaha">Gampaha</option>
                                                        <option value="Badulla">Badulla</option>
                                                        <option value="Kurunegala">Kurunegala</option>
                                                        <option value="Jaffna">Jaffna</option>
                                                     </select>
                                                  </div>
                                              </div>
                                              
                                            
              
                                                  <div class="col-md-6 offset-md-4">
                                                      <button type="submit" class="btn btn-primary">
                                                      Update
                                                      </button>
                                                      <button type="button" onclick="getimage()" class="btn btn-success">
                                                       Open camera
                                                      </button>
                                                  </div>
                                                  <input type="hidden" name="photo" id="myImg" />
                                                  <input type="hidden" name="_do" value="update_student" />
                                                  <input type="hidden" name="id" value="<?php echo($student["id"]); ?>" />
                                                  <input type="hidden" name="page" value="updatestudent" />
                                                 
                                        
                                                      

         </form>
                       
                       </div> 
               </div>
            </div>
          </div>

          <!-- --------------------------- End User Registration------------------------------- -->

      <div class="col-lg-6">
      <div id="my_camera"></div>
      <input class="btn btn-primary my-3" type="button" value="Take Snapshot" onClick="take_snapshot()">
      
        <div id="results" >
          <img src="<?php echo($student["photo"]);    ?>" />
          
        </div>
       
        
      
      <!-- Webcam.min.js -->
        <script type="text/javascript" src="webcamjs/webcam.min.js"></script>
    
      <!-- Configure a few settings and attach camera -->
      <script language="JavaScript">
      // Configure a few settings and attach camera



       
        Webcam.set({
          width: 320,
          height: 240,
          image_format: 'jpeg',
          jpeg_quality: 90
        });

        function getimage(){
        Webcam.attach( '#my_camera' );
        }
        // preload shutter audio clip
        var shutter = new Audio();
        shutter.autoplay = true;
        shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';
        


        function take_snapshot() {



            // play sound effect
            shutter.play();
        
            // take snapshot and get image data
            Webcam.snap( function(data_uri) {
        
                // display results in page
                document.getElementById('results').innerHTML = '<input type="image" name="image" src="'+data_uri+'"/>';
                document.getElementById("myImg").value = data_uri; 
            } );
        }

        
      </script>

          </div>
    <!-- /.content -->
  </div>
</div>
</section>
</div>

   
