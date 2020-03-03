<!DOCTYPE html>
<html>
<?php
error_reporting(E_ALL); ini_set('display_errors', '1');
  include("config.php")


?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Title with favicon -->
  <link rel=icon href="dist/img/favicon.ico">
  <title>UMS</title>



  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- bootstrap -->
 
  <style type="text/css">
  	.table1{
  		 overflow: auto;
  	}
  	.content_outer{
  		margin-left:50px;
  	}
  </style>
</head>
<?php


 if($_SESSION["log_email"] == ""){

 header('Location:index.php');
  exit;
}
?>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- ===============================================================================Start navbar ================================================================ -->
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="mainpage.php?page=newstudent&_do=no" class="nav-link">Home</a>
      </li>
      
      
    </ul>

    <!-- SEARCH FORM -->
   <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>  -->
  </nav>
  <!-- ===============================================================================End navbar ================================================================ -->

  

  <!-- ===============================================================================Main Sidebar Container=============================================================================== -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <!-- <a href="#.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">University</span>
    </a> -->

    <!-- ===================================================================Start Sidebar============================= -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
<!--       <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Kavindu Gayanath</a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

<!--         <li class="nav-item has-treeview menu-open"> 
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="fas fa-palette nav-icon"></i>
                  <p>Dashbord</p>
                </a>
              </li>
            </ul>
          </li> -->
<!-- --------------------------- Start Manage Student------------------------------- -->
          <li class="nav-item has-treeview py-2">
            <a href="#" class="nav-link">
              <!-- <i class="nav-icon fas fa-user-graduate"></i>  -->
              <h4>
                Manage Student
                <!-- <i class="fas fa-angle-left right"></i> -->
              </h4>
            </a> 
            <hr>           
            <li class="nav nav-treeview my-2">
              <li class="nav-item">
                <a href="mainpage.php?page=newstudent&_do=no" class="nav-link">
                  <i class="nav-icon fas fa-user-graduate"></i>
                   <p>New Student </p> 
                </a>
              </li>
              <li class="nav-item my-2">
                <a href="mainpage.php?page=allstudent&_do=0&from=0" class="nav-link">
                  <i class="nav-icon fas fa-users"></></i>
                  <p>Student list</p>
                </a>
              </li>
              
              <li class="nav-item mb-2">
                <a href="mainpage.php?page=import_student&_do=no" class="nav-link">
                  <i class="nav-icon fas fa-file-upload"></i>
                  <p>Import From OMIF</p>
                </a>
              </li>
            </li>
          </li>
<!-- --------------------------- End Manage Student------------------------------- -->

<!-- --------------------------- Start Manage Employee------------------------------- -->
         <!--  <li class="nav-item has-treeview py-2">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Manage Employee
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add New Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Employee</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Repots</p>
                </a>
              </li>
            </ul>
          </li> -->
<!-- --------------------------- End Manage Employee------------------------------- -->

<!-- --------------------------- Start Manage Payments------------------------------- -->
         <!--  <li class="nav-item has-treeview py-2">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-dollar-sign"></i>
              <p>
                Payments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
            </ul>
          </li> -->
<!-- --------------------------- End Manage Payments------------------------------- -->

<!-- --------------------------- Start Manage Report------------------------------- -->
        <!--   <li class="nav-item has-treeview py-2">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Genarate Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Student Reports</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Reports</p>
                </a>
              </li>
            </ul>
          </li> -->

          <li class="nav-item has-treeview mb-2">
            <a href="Logout.php" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>Logout</p>
            </a>
          </li>
<!-- --------------------------- End Manage Report------------------------------- -->

        </ul>
      </nav>

      <!-- /.==========================================================End sidebar-menu======================= -->
    </div>
    <!-- /.===============================End sidebar===================================== -->




  </aside>


      <?php
        if($_arguments != null){
          
          if($_arguments["page"]== "newstudent"){
            include("page/std_reg.php");

          }else if($_arguments["page"]== "allstudent"){
            include("page/all_student.php");
          }else if($_arguments["page"]== "updatestudent"){
            include("page/updatestudent.php");
          }else if($_arguments["page"]== "import_student"){
            include("page/import_student.php");
          }else{

          }
        }else{
           include("page/std_reg.php");
            
        }

      ?>



  <!-- /.content-wrapper -->
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <!-- <strong>Copyright &copy; 2020 <a href="#">InTouch Software Solutions</a>.</strong> -->
    All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->



  </aside>
  <!-- /.control-sidebar -->



</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
