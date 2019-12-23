<?php
session_start();
include("includes/db.php");
include("functions/funtions.php");
//include("functions/funtions.php")


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>My Shop</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
   <!--Main Container Starts-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php">
    <img src="images/logo.png" width="90" height="60" alt="">
  </a>
  
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="all_products.php">All Products </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="customer/my_account.php">My Account </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="customer_register.php">Sign Up </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="cart.php">Shopping Cart</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Contact Us</a>
      </li>
    </ul>
    <form class="form-inline" method="get" action="results.php" enctype="multipart/form-data">
    <input class="form-control mr-sm-2" name="user_query" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0"  name="search" type="submit">Search</button>
  </form>
  </div>
</nav>
       
       <!--Navigation Ends-->
       
       <div class="content_wrapper"> 
       
       <div id="left_sidebar"> 
       <div id="sidebar_title">Categories</div>
       <ul id="cats">
          
           <?php
           getCategory();
           
           
           ?>
           
       </ul>
        <div id="sidebar_title">Brands</div>
          <ul id="cats">
           <?php
           getBrands();
           ?>
           </ul>
       </div>
       
        <div id="right_content"> 
            <?php
            cart();
            ?>
            <div id="headline">
            <div id="headline_content">
                <b>Welcome guest!</b>
                <b style="color:yellow;">Shopping Cart:</b>
                <span>Total Items:-<?php Items();?> -Total Price <?php total_price();?>-<a href="cart.php" style="color:#FF0";>Go to Cart</a>
                <?php
                    if(!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php' style='color:#F93;'>Login</a>";
                    
                    }
                    
                    else {
                        echo "<a href='logout.php' style='color:#F93;'>Logout</a>";
                    }
                ?>
                </span>
             </div>
            </div>
            
        
            <div id="product_box">
            
            
            <form action="customer_register.php" method="post" enctype="multipart/form-data">
          <div class="container register-form">
            <div class="form">
                <div class="note">
                    <p>Please fill in this form to create an account.</p>
                </div>

                <div class="form-content bg-secondary">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="c_name" placeholder="Your Name *" required/>
                            </div>
                            <div class="form-group">
                                <input type="email" name="c_email" class="form-control" placeholder="Your Email *" required/>
                            </div>
                            
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                                <input type="tel" pattern="[0-9]{10}" name="c_contact" class="form-control" placeholder="Phone Number *" required/>
                            </div>
                            
                            <div class="form-group">
                                <input type="password" name="c_pass" class="form-control" placeholder="Your Password *" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <select name="c_country" required class="form-control" >
                           <option>Select a Country</option>
                           <option>India</option>
                           <option>Afghanistan</option>
                           <option>Iran</option>
                           <option>Japan</option>
                           <option>China</option>
                           <option>UAE</option>
                           <option>Saudia Arabia</option>
                           <option> United Kingdom</option>
                           <option>Pakistan</option>
                       </select>
                            </div>
                            <div class="form-group">
                                <input type="city" name="c_city" class="form-control" placeholder="Your City *" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" name="c_address" class="form-control" placeholder="Your Address *" required/>
                            </div>
                            <div class="form-group">
                                <input type="file" name="c_image" class="form-control" placeholder="Your image *" required/>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="register" class="btnSubmit">Submit</button>
                </div>
            </div>
        </div>
            </form>
            
            
            </div>
        </div>
           
       </div> 
       <div class="footer"> 
        <h1 style="color:#000; padding-top:30px; text-align:center;">&copy;2019-By www.bro.com</h1>
        </div> 

        
        
        
        
        
    
        
        
        
        
        
        
        
        
    
    
    
    
    </body>
</html>
<?php

if(isset($_POST['register'])){
    
//    global $con;
    $c_name=$_POST['c_name'];
    $c_email=$_POST['c_email'];
    $c_pass=$_POST['c_pass'];
    $c_country=$_POST['c_country'];
    $c_city=$_POST['c_city'];
    $c_contact=$_POST['c_contact'];
    $c_address=$_POST['c_address'];
    $c_image=$_FILES['c_image']['name'];
    $c_image_tmp=$_FILES['c_image']['tmp_name'];
    
    $c_ip=getRealIpAddr();
    $insert_customer = "INSERT INTO `customer` ( `customer_name`, `customer_email`, `customer_pass`, `customer_country`, `customer_city`, `customer_contact`, `custoumer_address`, `customer_image`, `customer_ip`) VALUES ('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip');";
    
    
    $run_customer=mysqli_query($con,$insert_customer);
//    echo $run_customer;
    move_uploaded_file($c_image_tmp,"customer/customer_photos/$c_image");
    
     $sel_cart = "select * from cart where ip_add='$c_ip'";
     
     $run_cart = mysqli_query($con,$sel_cart);
     $check_cart=mysqli_num_rows($run_cart);
    if($check_cart>0){
        $_SESSION['customer_email']=$c_email;
        
       echo"<script>alert('Account Created Successfully,ThankYou')</script>";
        
        echo"<script>window.open('checkout.php','_self')</script>";
        
    }
    else{
        $_SESSION['customer_email']=$c_email;
            echo"<script>alert('Account Created Successfully,ThankYou')</script>";

        
                echo"<script>window.open('index.php','_self)'</script>";

    }
     
    
    
}



?>