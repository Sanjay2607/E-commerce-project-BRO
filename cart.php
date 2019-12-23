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
    <link rel="stylesheet" href="styles/bootstrap.min.css" media="all">
    <link rel="stylesheet" href="styles/style.css" media="all"/>
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
       <?php
           
           if(isset($_SESSION['customer_email'])){
            echo"<span style='display:none;'><li class='nav-item active'><a class='nav-link' href='customer_register.php'>Sign Up</a></li></span>";
           
           }
            else{
                
                echo"<li class='nav-item active'><a class='nav-link' href='customer_register.php'>Sign Up</a></li>";
            }
                
           ?>
      <li class="nav-item active">
        <a class="nav-link" href="cart.php">Shopping Cart</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="contact.php">Contact Us</a>
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
                       
                       echo"<b>Welcome Guest</b><b style='color:yellow '>Shopping Cart:</b>";
                       
                   }
                else {
                    echo"<b>Welcome:" . $_SESSION['customer_email'] . "</b>" . "<b style='color:yellow;'> Your Shopping Cart:</b>";
                }
                    
                    
                    
                     ?>
                <span>Total Items:-<?php Items();?> -Total Price <?php total_price();?>-<a href="index.php" style="color:#FF0";>Back To Shopping</a>
                
               &nbsp; <?php
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
            
        
            <div id="product_box"><br>
            <form action="cart.php" method="post" enctype="multipart/form-data">
                
                <table width="740" align="center" bgcolor="#139187">
                
                
                <tr align="center">
                <td><b>Remove</b></td>
                    <td><b>Product(s)</b></td>
                    <td><b>Quantity</b></td>
                    <td><b>Total Price</b></td>
                    
                    
                    </tr>
                    <?php
                     $ip_add=getRealIpAddr();
    $total=0;
    
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price =mysqli_query($db,$sel_price);
    while($record=mysqli_fetch_array($run_price)){
        
        $prod_id=$record['p_id'];
        $prod_price="select * from products where product_id='$prod_id'";
        $run_pro_price=mysqli_query($con,$prod_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            
            
            $product_price=array($p_price['product_price']);
            $product_title=$p_price['product_title'];
              $product_image=$p_price['product_img1'];
               $only_price=$p_price['product_price'];
            $values=array_sum($product_price);
            $total = $total + $values; 
     
     
                    ?>
                <tr>            
                    <td><input type="checkbox" value="<?php echo $prod_id; ?>" name="remove[]"></td>
                    <td><?php echo $product_title; ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" height="80" width="80"></td>
                    <td><input type ="text" name="qty" value="" size="3"></td>
                    <?php 
                    if(isset($_POST['update']))
                    {
                        $qty=$_POST['qty'];
                        $insert_qty="update cart set qty='$qty' where ip_add='$ip_add'";
                        $run_qty=mysqli_query($con,$insert_qty);
                        $total=$total * $qty;
                    }
                    
                    ?>
                    <td><?php echo "INR".$only_price; ?></td>
                    
                    
                </tr>
                    <?php }} ?>
                    <tr>
                    
                    <td colspan="3" align="right"><b> Sub Total:</b></td>
                       
                        
                        
                        <td><b><?php echo "INR". $total; ?></b></td>
                    
                    </tr>
                    <tr>
                    
                    </tr>
                    <tr>
                    
                    <td colspan="2"><input class="btn btn-lg btn-dark text-uppercase" type="submit" name="update" value="Update cart"/></td>
                     <td><input class="btn btn-lg btn-dark text-uppercase" type="submit" name="continue" value="Continue Shopping"/></td>
                        <td><a class="btn btn-lg btn-dark text-uppercase" href="checkout.php" style="text-decoration:none;">Checkout</a></td>

                    </tr>
                
                
                
                </table>
                </form>
                <?php 
                function updatecart(){
                    global $con;
                if(isset($_POST['update']))
                {
                    
                    foreach($_POST['remove'] as $remove_id)
                        
                    {
                        $delete_products ="delete from cart where p_id='$remove_id'";
                        $run_delete=mysqli_query($con,$delete_products);
                        if($run_delete)
                        {
                            echo"<script>window.open('cart.php','_self')</script>";
                        }
                        
                    }
                              
                }
                
                      if(isset($_POST['continue']))
                                    {
                                        
                            echo"<script>window.open('index.php','_self')</script>";
                                    }
                }
                            echo @$up_cart=updatecart();

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