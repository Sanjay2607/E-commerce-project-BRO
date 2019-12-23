<?php
session_start();
include("includes/db.php");
include("functions/funtions.php")
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
   
        <!--Header Ends-->
    
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
            <div class="row">
<!--                <div class="col col-md-3">-->
            <section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <div class="row">

        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Your name</label>
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Your email</label>
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="">Subject</label>
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Your message</label>
                        </div>

                    </div>
                </div>
                <!--Grid row-->

            </form>

            <div class="text-center text-md-left">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Send</a>
            </div>
            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>San Francisco, CA 94126, USA</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 01 234 567 89</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@mdbootstrap.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->

            
            
<!--            </div>-->
                </div>
        </div>
          
           
       </div> 
       <div class="footer"> 
        
        </div>

        
        
        
        
        
        
        
        
        
        
        
        
        
        
    </div>
    
    
    
    </body>
</html>