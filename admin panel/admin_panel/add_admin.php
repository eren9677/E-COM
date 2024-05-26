<?php
include("config.php");

include("logged_in_check.php");


if(isset($_POST["add_admin"]) && !empty($_POST["admin_name"]) && !empty($_POST["admin_surname"]) && !empty($_POST["admin_username"]) && !empty($_POST["admin_password"])){

   //echo "<pre>"; print_r($_POST); die(); //okayy our data collected is right.

   $admin_name = $_POST["admin_name"];
   $admin_surname = $_POST["admin_surname"];
   $admin_username = $_POST["admin_username"];
   $admin_password = $_POST["admin_password"];
   $admin_status = $_POST["admin_status"];


   $query = " INSERT INTO admin_table (admin_name, admin_surname, admin_username, admin_pass, admin_status) VALUES ('$admin_name','$admin_surname','$admin_username','$admin_password','$admin_status')";

   //berkhoca_query_parser($query); bu query parser hata verio



    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "e-ticaret";

   
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $conn->query($query);

   header('Location: add_admin.php?correct=1');
   exit;



}









?>

<?php include('header.php'); ?>

<html>
    <form action="add_admin.php" method="post">
        <body>
        
        <div id="wrapper">
        
        
            <?php include('top_bar.php'); ?>
        
            <?php include('left_sidebar.php'); ?>
                <div id="content">
        
                    <div id="content-header">
                        <h1>ADD NEW ADMIN</h1>
                    </div> <!-- #content-header -->

                    <div id="content-container">
                        <div class="row">

                        <?php 

                        if(!empty($_GET['correct']) && $_GET['correct'] == 1) {

                     ?>
                        <div class="alert alert-danger">
                            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
                            <strong>Congrts!</strong> Data successfully injected!
                        </div>
                    <?php 
                    } 

                    ?>
                            <div class="portlet">
        
                                <div class="portlet-header">
        
                                    <h3>
                                        <i class="fa fa-tasks"></i>
                                        ADMIN INFO
                                    </h3>
        
                                </div> <!-- /.portlet-header -->
        
                                <div class="portlet-content">
        
                                    <div class="row">
        
                                        <div class="col-sm-4">
        
                                            <div  class="form-group">
                                                <label for="text-input">ADMIN NAME</label>
                                                <input name="admin_name" type="text" id="text-input" class="form-control">
                                            </div>
                                        <div class="form-group">
                                                <label for="text-input">ADMIN SURNAME</label>
                                                <input  name = "admin_surname"  type="text" id="text-input" class="form-control">
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">ADMIN USERNAME</label>
                                                <input  name="admin_username" type="text" id="text-input" class="form-control">
                                            </div>
                                        <div  class="form-group">
                                                <label for="text-input">ADMIN PASSWORD</label>
                                                <input name="admin_password" type="text" id="text-input" class="form-control">
                                            </div>
        
        
                                        </div> <!-- /.col -->
        
                                    </div> <!-- /.row -->
        
                                    <div class="row">
        
                                        <div class="col-sm-4">
                                            <label>Admin Status</label>
                                            <div class="form-group" name="admin_status">
                                                <label class="radio-inline">
                                                    <input type="radio" name="admin_status" id=1 value="1">
                                                    Active
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="admin_status" id=0 value="0" checked="">
                                                    Passive
                                                </label>
                                            </div>
                                        </div>
                                    </div> <!-- /.row -->
                                    <button name="add_admin" type="submit" class="btn btn-default">ADD ADMIN</button>
        
        
                                </div> <!-- /.portlet-content -->
        
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /#content-container -->
        
                </div> <!-- #content -->
        
        
        </div> <!-- #wrapper -->
        
        <?php include('footer.php'); ?>
        
        </body>
    </form>
</html>




