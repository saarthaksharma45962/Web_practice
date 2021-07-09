<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      <form  method="post">
        <div class="input-group mb-3">
          <input type="text" name= "username" id= "username" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email"  name="email" id="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" id="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name= "cpassword" id="cpassword" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="agreeTerms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit"  name="submit" id=" submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i>
          Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i>
          Sign up using Google+
        </a>
      </div>

      <a href="login.html" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>


<?php
  include"phfiles/dbconn.php";

  if(isset($_POST['submit'])){
      
      $name = mysqli_real_escape_string($connection, $_POST['username']);
      $email = mysqli_real_escape_string($connection, $_POST['email']);
      $password =  mysqli_real_escape_string($connection, $_POST['password']);
      $cpassword =  mysqli_real_escape_string($connection, $_POST['cpassword']);
   
#---------------validations for user entered fields-------------------------       
      if(preg_match("/^[A-za-z' ]+$/",$name)){
            if(filter_var($email,FILTER_VALIDATE_EMAIL)){
                if($password === $cpassword ){
                  $pass = md5($password);
                  $cpass = md5($cpassword); 
                  if(isset($_POST['agreeTerms'])){
                      $emailquery = "select* from users where Email= '$email' ";
                      $query_res = mysqli_query($connection,$emailquery);
                      $emailcount = mysqli_num_rows($query_res);
                      
                      if($emailcount>0){
                          echo"email already exists";
                      }
                      else{

                      
#-----------------------------------------------------------------------inserting data----------------------------
                  $a_query = "insert into users(Name, Email,Password,Cpassword) values ('$name','$email','$pass','$cpass')";
                  $query1 = mysqli_query($connection,$a_query);
                        if($query1){
                              header("location:login.php");                       
                        }
                      }
                  }
                  else{

                    echo"Agree to terms please";
                  }
                }
                else{
                  echo"Passwords do not match";
                }
             }
            else{
              echo"enter email properly";
            }
       }
      else{  
        echo"Enter name correctly"; 
      }
  }
  else{

  }

?>
