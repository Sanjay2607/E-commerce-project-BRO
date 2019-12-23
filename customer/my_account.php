<?php
session_start();
include("includes/db.php");

include("funtions/funtion.php")


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>My Shop</title>
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body>
   <!--Main Container Starts-->
    <div class="main_wrapper">
          
       
        <!--Navigation Starts-->
       <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="../index.php">
    <img src="../images/logo.png" width="90" height="60" alt="">
  </a>
  
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="../all_products.php">All Products </a>
      </li>
       <li class="nav-item active">
        <a class="nav-link" href="my_account.php">My Account </a>
      </li>
       <?php
           
           if(isset($_SESSION['customer_email'])){
            echo"<span style='display:none;'><li class='nav-item active'><a class='nav-link' href='../register.php'>Sign Up</a></li></span>";
           
           }
            else{
                
                echo"<li class='nav-item active'><a class='nav-link' href='../register.php'>Sign Up</a></li>";
            }
                
           ?>
      <li class="nav-item active">
        <a class="nav-link" href="../cart.php">Shopping Cart</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="../contact.php">Contact Us</a>
      </li>
    </ul>
    <form class="form-inline" method="get" action="../results.php" enctype="multipart/form-data">
    <input class="form-control mr-sm-2" name="user_query" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0"  name="search" type="submit">Search</button>
  </form>
  </div>
</nav>
        
       
       <!--Navigation Ends-->
       
       <div class="content_wrapper"> 
       
       <div id="left_sidebar" style="float:right;"> 
       <div id="sidebar_title">Manage Account</div>
       <ul id="cats">
          <?php
           
               
               $user_session=$_SESSION['customer_email'];
               $get_customer_pic = "select * from customer where customer_email = '$user_session'";
               
               
               $run_customer = mysqli_query($con,$get_customer_pic);
               
               
               $row_customer = mysqli_fetch_array($run_customer);
               
               
               $customer_pic = $row_customer['customer_image'];
               
               
               echo "<img src='customer_photos/$customer_pic' width='170' height='170' ><br>";
               
          
    
    
    
           ?>
           <li><a href="my_account.php?my_orders">My Orders</a></li>
            <li><a href="my_account.php?edit_account">Edit Account</a></li>
             <li><a href="my_account.php?change_pass">Change Password</a></li>
              <li><a href="my_account.php?delete_account"> Delete Account</a></li>
               <li><a href="logout.php">Logout</a></li>
           
       </ul>
        
       </div>
       
        <div id="right_content" > 
            <?php
            cart();
            ?>
            <div id="headline">
            <div id="headline_content">
                <?php
                   if(!isset($_SESSION['customer_email'])){
                       
                       echo"<b>Welcome Guest</b> <b style='color:#FF3E4D '>Shopping Cart:</b>";
                       
                   }
                else {
                    echo"<b>Welcome:" . $_SESSION['customer_email'] . "</b>" . "<b style='color:#FF3E4D;'> Your Shopping Cart:</b>";
                }
                    
                    
                    
                     ?>
<!--                <b style="color:yellow;">Shopping Cart:</b>-->
                <span>Total Items:-<?php Items();?> -Total Price <?php total_price();?>-<a href="cart.php" style="color:#FF3E4D";>Go to Cart</a>
                
                &nbsp; <?php
                    
                    
                    if(!isset($_SESSION['customer_email'])){
                    echo "<a href='checkout.php' style='color:#67E6DC;'>Login</a>";
                    
                    }
                    
                    else {
                        echo "<a href='../logout.php' style='color:#67E6DC;'>Logout</a>";
                    }
                ?>
                </span>
             </div>
            </div>
            
        
            <div>
            
           <h1 style="background:#000; color:#Fc9; padding:20px;text_align:center;border-top:2px solid #FFF;">Manage Your Account</h1>
            
            <?php
                
                
                getDefault();
                
                
                ?> 
                <?php
                if(isset($_GET['my_orders']))
                    
                {
                    include("my_orders.php");
                    
                    
                }
                if(isset($_GET['edit_account']))
                    
                {
                    include("edit_account.php");
                    
                    
                }
                if(isset($_GET['change_pass']))
                    
                {
                    include("change_pass.php");
                    
                    
                }
                if(isset($_GET['delete_account']))
                    
                {
                    include("delete_account.php");
                    
                    
                }
                
                
                
                
                ?>
                
            
            </div>
        </div>
           
       </div> 
       <div class="footer"> 
        <h1 style="color:#000; padding-top:30px; text-align:center;">&copy;2019-By www.bro.com</h1>
        </div> 

        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </div>
    
    
    
    </body>
</html>