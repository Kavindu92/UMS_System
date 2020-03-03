<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
	include("config.php")
?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>User Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link href="/css/logingPage.css" rel="stylesheet">
  

  <!-- Bootstrap Scripts -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>

<body class="bg-primary">

  <div class="container mt-5 pt-5">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5 ">
          <div class="card-body py-4 border border-success">

            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img class="col-lg-12 p-0 m-5" src="image/login.jpg" alt="">
              </div>

              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-5 font-weight-bold">User Login</h1>
                    <?php
                     if($_arguments != null){
                    if($_arguments["_do"] =="save"){
                    	openConnection();  
                    	$user_data["name"]=$_arguments["Username"];
                    	$user_data["password"]=md5($_arguments["password"]);  
                    	$result = get_record(2,$user_data);
                    	
                    		if($result !=""){
                    			$Username="";
                    			$password="";
      								while($row = $result->fetch_assoc()) {
      										$Username=$row["name"];
      										$password=$row["password"];
      								}

								if($Username != $_arguments["Username"] | $password != md5($_arguments["password"])){
									$message_obj->get_error_message(" Incorrect user name or password !");
								}
							} 
							close_connections();
						}
					}
                    ?>
              	
                  </div>

                  <form class="user" method="post" action="login.php" target="_self">
                    <div class="form-group py-3 ">
                      <input type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Your Username..." name="Username">
                    </div>
                    <div class="form-group mb-4">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>

                    <div class="form-group mb-5">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block py-3 my-4" >Login</button>
                    <hr>
                    <input type="hidden" name="_do" value="save" id="_do" />
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="sticky-footer text-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; InTouch Software Solution 2020</span>
      </div>
    </div>
  </footer>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
