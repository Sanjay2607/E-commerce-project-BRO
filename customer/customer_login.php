<?php

@session_start();
include("includes/db.php");
//include("funtions/funtion.php");

?>
<div>
<!--    <h2>Login or Register</h2>-->
<form action="checkout.php" method="post">
   
   <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>
            <form class="form-signin">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="c_email" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" id="inputPassword" name="c_pass" class="form-control" placeholder="Password" required>
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
<!--                <br><a style="float:right;"  href="forgot_pass.php">Forgot Password?</a>-->
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" name="c_login" type="submit">Sign in</button>
              <a href="customer_register.php" style="margin-top:10px;" class="btn btn-secondary text-white"> New?Register Here!</a>
              
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
   
   
   
    </form>



</div>


<?php
 if(isset($_POST['c_login'])){
     
     $customer_email =$_POST['c_email'];
     $customer_pass =$_POST['c_pass'];
     $sel_customer="select * from customer where customer_email='$customer_email' AND customer_pass='$customer_pass'";
     
     $run_customer=mysqli_query($con,$sel_customer);
     
     $check_customer=mysqli_num_rows($run_customer);
     $get_ip=getRealIpAddr();
     $sel_cart = "select * from cart where ip_add='$get_ip'";
     
     $run_cart = mysqli_query($con,$sel_cart);
          $check_cart=mysqli_num_rows($run_cart);
     
     
     
     if($check_customer==0 ){
         
         echo"<script>alert('Password or Email id is incorrect,try again')</script>";
         exit();
         
         
         
     }
      if($check_customer==1 AND $check_cart==0){
          $_SESSION['customer_email'] = $customer_email;
          
          echo"<script>window.open('customer/my_account.php','_self')</script>";
      }
     
     else {
         $_SESSION['customer_email'] = $customer_email;
         echo"<script>alert('you have sucessfully logged in')</script>";
         include("payment_options.php");
     }
 }

?>