<!DOCTYPE html>
<html lang="en">
<head>

    <title>Payment Option</title>
</head>
<body>
   <?php
    include("includes/db.php");

    ?>
    

  <div align= "center" style="padding=20px;">
   
   <h2>Payment Options for you</h2>
   
   <?php
      $ip=getRealIpAddr();
    
    $customer_email = $_SESSION['customer_email'];
    $get_customer = "select * from customer where customer_email='$customer_email'";
    $run_customer = mysqli_query($con,$get_customer);
    $row = mysqli_fetch_array($run_customer);
    
    $customer_id = $row['customer_id'];
      ?>
  <a href="https://paytm.com" target="_blank">  <img src="images/paytm-logo.jpg" width="600" height="100"> </a><br>
    
    <b>Or</b> <a class="btn btn-lg btn-primary btn-block text-uppercase" href="order.php?customer_id=<?php echo $customer_id; ?>"> pay offline</a>
    

</div>
</body>
</html>