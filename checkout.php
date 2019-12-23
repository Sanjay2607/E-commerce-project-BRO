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
    <div class="main_wrapper">
           <!--Header Starts-->
          
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
                        echo "<a href='logout.php' style='color:#67E6DC;'>Logout</a>";
                    }
                ?>
                </span>
             </div>
            </div>
            
        
            <div id="product_box">
            
            <?php
                
            
                if(!isset($_SESSION['customer_email'])){
                include("customer/customer_login.php");
                }
                    else{
                        include("payment_options.php");
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