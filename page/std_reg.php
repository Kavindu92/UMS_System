<link rel="stylesheet" type="text/css" href="css/addnewstudent.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- --------------------------- Start User Registration------------------------------- -->

   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Add New Student</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->



<!-- --------------------------- End User Registration------------------------------- -->

    <!-- Main content -->
    <section class="content-header">
      <div class="container-fluid mw-100 mh-100">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-6">
            <!-- small box -->
            <div class="small-box">


               <div class="card">
                   <div class="col-lg-12 col-md-12 pt-3 card-header">
                    <a href="#"> <i class="fas fa-user-plus"></i> Register</a>
                     <?php 

                     $name="";
                     $tell="";
                     $email="";
                     $regno="";
                   
                     if($_arguments != null){
                      if($_arguments["_do"] =="save_student"){

                         $name=$_arguments["full_name"];
                         $tell=$_arguments["contact_number"];
                         $email= $_arguments["email"];
                         $regno= $_arguments["registration_number"];

                        if($_arguments["full_name"] == ""){
                          $message_obj->get_error_message(" Enter first name !");
                        }else if($_arguments["photo"] == ""){
                            $message_obj->get_error_message(" Select photo !");
                        }else if ($_arguments["registration_number"] == ""){
                          $message_obj->get_error_message(" Enter registration number !");
                        } else if (strlen($_arguments["registration_number"]) != 9){
                          $message_obj->get_error_message(" Incorrect registration number !");
                        } else if ($_arguments["cource_id"] == ""){
                          $message_obj->get_error_message(" Select program !");
                        }else{
                          set_auto_commit(false);
                          $fixed_data = fix_data(1,$_arguments);
                          $fixed_data["photo"] = "";
                          openConnection();
                          $result = insert(1,$fixed_data);
                         if($result > 0){
                           base64ToImage($_arguments["photo"],"img/".$result.".jpg");
                           $value_array["photo"]="img/".$result.".jpg";
                           $where_array["id"]= $result;
                           $result1 = update(1,$where_array,$value_array);
                           if($result1 > 0){
                             $message_obj->get_success_message(" Success !");
                             _commit();
                           }else{
                            // if does not update image and record
                            $message_obj->get_error_message(" Sorry try again !");
                           }
                         }else{
                          // if does not save student details
                          $message_obj->get_error_message(" Sorry try again !");
                         }

                        }
                      }
                     }

                    
                  ?>
                   <script type="text/javascript">
                     function validate_student(){
                      var return_val =true;
                      
                      document.getElementById("regno").style.borderColor = "#cccccc";
                      document.getElementById("full_name").style.borderColor = "#cccccc";
                      document.getElementById("contact_number").style.borderColor = "#cccccc";
                      document.getElementById("email").style.borderColor = "#cccccc";
                      document.getElementById("cource_id").style.borderColor = "#cccccc";

                      var regno= document.getElementById("regno").value.trim();
                      var full_name= document.getElementById("full_name").value.trim();
                      var contact_number= document.getElementById("contact_number").value.trim();
                      var email= document.getElementById("email").value.trim();
                      var cource_id= document.getElementById("cource_id").value.trim();
                     
                     


                      if(regno == ""){
                         document.getElementById("regno").style.borderColor = "red";
                         return_val = false;
                      }else{

                         if (/[a-z,A-Z]/.test(regno)) {
                         return_val = false;
                         document.getElementById("regno").style.borderColor = '#ff0000';
                       }
                     }

                      if(full_name == ""){
                         document.getElementById("full_name").style.borderColor = "red";
                         return_val = false;
                      
                      }
                      
                       if(cource_id == ""){
                         document.getElementById("cource_id").style.borderColor = "red";
                         return_val = false;
                      
                      }
                       if(contact_number == ""){
                         document.getElementById("contact_number").style.borderColor = "red";
                         return_val = false;
                      }
                       if(email == ""){
                         document.getElementById("email").style.borderColor = "red";
                         return_val = false;
                      }

                      var mobile = document.getElementById("contact_number").value.trim();

                       if (/[a-z,A-Z]/.test(mobile)) {
                        if(mobile != ""){
                         return_val = false;
                         document.getElementById("contact_number").style.borderColor = '#ff0000';
                       }

                     }
                     var aa =mobile.length;

                    if(aa != 10){
                       return_val = false;
                    document.getElementById("contact_number").style.borderColor = '#ff0000';
                   }

                     var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>   ()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                     var d =  re.test(email);
                     if(d == false){
                      return_val = false;
                      document.getElementById("email").style.borderColor = '#ff0000';
                    }
                      
                    return return_val;
                  }








                  </script>


                   </div>
                  
                      <div class="card-body ">
                        <form name="myform" onsubmit="return validate_student()" action="mainpage.php" method="post">

                                              <div class="form-group row">
                                                  <label  class="col-md-4 col-form-label text-md-right">Reg:number</label>
                                                  <div class="col-md-6">
                                                      <input type="text" value="<?php echo($regno); ?>" id="regno"  class="form-control" name="registration_number" maxlength="9" />
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="full_name" class="col-md-4 col-form-label text-md-right">Full name</label>
                                                  <div class="col-md-6">
                                                      <input type="text" id="full_name" value="<?php echo($name);  ?>" class="form-control" name="full_name" maxlength="100" />
                                                  </div>
                                              </div>

                                               
              
                                              <div class="form-group row">
                                                  <label for="user_name" class="col-md-4 col-form-label text-md-right">Contact number</label>
                                                  <div class="col-md-6">
                                                      <input type="text" maxlength="10" value="<?php echo($tell);  ?>" id="contact_number" class="form-control" name="contact_number"/>
                                                  </div>
                                              </div>
              
                                              
              
                                              <div class="form-group row">
                                                  <label for="present_address" class="col-md-4 col-form-label text-md-right">Email</label>
                                                  <div class="col-md-6">
                                                      <input type="text" value="<?php echo($email);  ?>" id="email" name="email" class="form-control">
                                                  </div>
                                              </div>
              
                                              <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Gender </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" name="gender">
                                                        <option value="Male">Male</option>
                                                        <option value="Fe-male">Fe-male</option>
                                                        <option value="Other">Other</option>
                                                     </select>
                                                  </div>
                                              </div>

                                               <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Program </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" id="cource_id" name="cource_id">
                                                      <option value="">Select</option>
                                                      <?php
                                                        $coursewhre["_status"]="1";
                                                        $cource_list = get_record(0,$coursewhre);
                                                          if($cource_list !=""){
                                                            while($row = $cource_list->fetch_assoc()) {
                                                             echo('<option value="'.$row["id"].'">'.$row["name"].'</option>');
                                                            }
                                                          }

                                                          close_connections();
                                                      ?>
                                                        
                                                     </select>
                                                  </div>
                                              </div>


                                              <div class="form-group row">
                                                  <label for="permanent_address" class="col-md-4 col-form-label text-md-right"> Regional center </label>
                                                  <div class="col-md-6">
                                                     <select class="form-control" name="regional_center">
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
              
                                            
              
                                                  <div class="col-lg-8 offset-md-2">
                                                      <button type="submit" class="btn btn-primary">
                                                      Register
                                                      </button>
                                                      <button type="button" onclick="getimage()" class=" mx-2 btn btn-success">
                                                       Open Camera
                                                      </button>

                                                       <button type="reset" class="btn btn-danger">
                                                      Reset
                                                      </button>
                                                  </div>
                                                  <input type="hidden" name="photo" id="myImg" />
                                                  <input type="hidden" name="_do" value="save_student" />
                                                  <input type="hidden" name="page" value="newstudent" />
                                                 
                                       
                                                      

         </form>
                       
                       </div> 
               </div>
            </div>
          </div>

          <!-- --------------------------- End User Registration------------------------------- -->

      <div class="col-lg-6">
      <div class="mx-4" id="my_camera"></div>
      <input class="btn btn-primary my-3 mx-4" type="button" value="Take Snapshot" onClick="take_snapshot()">
      
        <div class="mx-4" id="results" ></div>
       
        
      
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

        getimage();
      </script>

          </div>
    <!-- /.content -->
  </div> </div></section></div>