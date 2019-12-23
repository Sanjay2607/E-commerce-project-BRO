<?php
include("includes/db.php");
include("functions/funtions.php")
//include("functions/funtions.php")


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html" charset="UTF-8">
    <title>My Shop</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="styles/style.css" media="all"/>
    <link type="text/css" rel="stylesheet" href="magiczoomplus/magiczoomplus.css"/>
<script type="text/javascript" src="magiczoomplus/magiczoomplus.js"></script>
</head>
<body>
   <!--Main Container Starts-->
    <div class="main_wrapper">
           <!--Header Starts-->
           
        <!--Navigation Starts-->
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
            
                 if(isset($_GET['pro_id'])){
                    $product_id=$_GET['pro_id'];
                  $get_products="select * from products where product_id='$product_id'";
                  $run_products=mysqli_query($db,$get_products);
                while ($row_products=mysqli_fetch_array($run_products)){
                    
                     $pro_id=$row_products['product_id'];
                     $pro_title=$row_products['product_title'];
                     $pro_cat=$row_products['cat_id'];
                     $pro_brand=$row_products['brand_id'];
                     $pro_desc=$row_products['product_desc'];
                     $pro_price=$row_products['product_price'];
                     $pro_image1=$row_products['product_img1'];
                    $pro_image2=$row_products['product_img2'];
                    $pro_image3=$row_products['product_img3'];
                    
                    echo"
                    <div id='single_product'>
                    <h3 class='text-white'>$pro_title</h3>
                    <img src='admin_area/product_images/$pro_image1' class='rounded' width='270' height='270' /> 
                    <img src='admin_area/product_images/$pro_image2' class='rounded' width='270' height='270' />
                    <img src='admin_area/product_images/$pro_image3' class='rounded' width='270' height='270' /><br>
                    <p class='text-white'><b>Price: INR $pro_price</b></p>
                    <p class='text-white'><b>$pro_desc</b></p>
                    <a href='index.php' class='btn btn-lg btn-primary text-uppercase' style='float:left;'>Go Back</a>
                    <a href='index.php?add_cart=$pro_id' class='btn btn-lg btn-dark style='float:right;'>Add to Cart</a>
                    </div>
                    ";
                    
                }
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