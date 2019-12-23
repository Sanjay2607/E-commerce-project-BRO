<?php
$db = mysqli_connect("localhost","root","","Myshop");



function getRealIpAddr(){
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
return $ip_address;
}




function getDefault(){
    global $db;
     
                            
                            
    $c = $_SESSION['customer_email'];
    $get_c = "select * from customer where customer_email='$c'";
    $run_c = mysqli_query($db,$get_c);
    
$row_c = mysqli_fetch_array($run_c);
        
        $customer_id = $row_c['customer_id'];
                            
    if(!isset($_GET['my_orders'])){
            if(!isset($_GET['edit_account'])){
                    if(!isset($_GET['change_pass'])){
                        if(!isset($_GET['delete_account'])){
                            $get_orders = "SELECT * FROM customer_orders where customer_id='$customer_id' AND order_status='Pending'";
                            
                            $run_orders = mysqli_query($db,$get_orders);
//                            $row_orders = mysqli_fetch_array($run_orders);
                            $count_orders = mysqli_num_rows($run_orders);
                            
                       if ($count_orders > 0){
                           
                           echo"<div style='padding:10px;'>
                           
                           <h1 style='color:red;text-decoration:underline;'>Important!</h1>
                           <h2>You have $count_orders Pending orders</h2>
                           <h3>Please see your order details by clicking this <a href='my_account.php?my_orders'>link</a><br>
                           Or you can <a href='pay_offline.php'>Pay Offline</a>
                           
                           </h3>
                           
                           
                           </div>";
                           
                           
                       }     
                        else{
                            
                            
                            echo"<div style='padding:10px;'>
                           
                           <h1 style='color:red;text-decoration:underline;'>Important!</h1>
                           <h2>You have no pending orders</h2>
                           <h3>you can see you orders by clicking this <a href='my_account.php?my_orders'>link</a><br>
                           Or you can <a href='pay_offline.php'>Pay Offline</a>
                           
                           </h3>
                           
                           
                           </div>";
                        }
        
    }
                    }
            }
        }
    }
   



//creating the scroipt for cart
function cart(){
    
    global $db;
    if(isset($_GET['add_cart'])){
        
        $ip_add = getRealIpAddr();
        $p_id = $_GET['add_cart'];
        
        $check_pro= "select * from cart where ip_add='$ip_add' AND p_id='$p_id'";
         $run_check = mysqli_query($db,$check_pro);
        
        if(mysqli_num_rows($run_check)>0){
            
            echo "";
                    
        }
        else{
            $q= "insert into cart (p_id,ip_add) values ('$p_id','$ip_add')";
            
            $run_q = mysqli_query($db,$q);
            echo"<script>window.open('index.php','_self')</script>";
        }
        
    }
    
    
}
//getting the no. of items from cart
function items(){
    

if(isset($_GET['add_cart'])){
     global $db;
     $ip_add = getRealIpAddr();
    $get_items="select * from cart where ip_add='$ip_add' ";
    $run_items=mysqli_query($db,$get_items);
    $count_items=mysqli_num_rows($run_items);
    
}
    else{
           
          $ip_add = getRealIpAddr();
        global $db;
  
    $get_items="select * from cart where ip_add='$ip_add' ";
    $run_items=mysqli_query($db,$get_items);
    $count_items=mysqli_num_rows($run_items);
        
        
    }
    echo $count_items;
}
//Getting th total price of the items from cart
function total_price(){
    $ip_add=getRealIpAddr();
    $total=0;
    global $db;
    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price =mysqli_query($db,$sel_price);
    while($record=mysqli_fetch_array($run_price)){
        
        $prod_id=$record['p_id'];
        $prod_price="select * from products where product_id='$prod_id'";
        $run_pro_price=mysqli_query($db,$prod_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total = $total + $values;
        }
    }

     echo "INR " . $total;
}

//getting the product to display






function getProduct(){
    global $db;
    if(!isset ($_GET['product_cat'])){
        
        
            if(!isset($_GET['product_brand'])){
                  $get_products="select * from products order by rand() LIMIT 0,6";
                  $run_products=mysqli_query($db,$get_products);
                while ($row_products=mysqli_fetch_array($run_products)){
                    
                     $pro_id=$row_products['product_id'];
             $pro_title=$row_products['product_title'];
                     $pro_cat=$row_products['cat_id'];
                     $pro_brand=$row_products['brand_id'];
                     $pro_desc=$row_products['product_desc'];
                     $pro_price=$row_products['product_price'];
                     $pro_image=$row_products['product_img1'];
                    
                    echo"
                    <div class='card' style='width: 18rem;'>
                    <img class='card-img-top' src='admin_area/product_images/$pro_image' >
                    <div class='card-body'>
                    <h5 class='card-title'>$pro_title</h5>
                    <p class='card-text'><b>Price: INR $pro_price</b></p>
                    <a href='details.php?pro_id=$pro_id' class='btn btn-primary' style='float:left;'>Details</a>
                    <a href='index.php?add_cart=$pro_id' class='btn btn-primary' style='float:right;'>Add To Cart</a>
                    </div>
                    </div>
                    ";
                    
                }
                
            }

    }

}

function getCatProduct(){
    global $db;
    if(isset ($_GET['product_cat'])){
             
        
        
                $cat_id=$_GET['product_cat']   ;
                  $get_cat_products="select * from products where cat_id='$cat_id'";
                  $run_cat_products=mysqli_query($db,$get_cat_products);
        
        $count = mysqli_num_rows($run_cat_products);
        
        if($count==0){
            echo "<h2>No products Found in this Category!</h2>";
        }
        
                while ($row_cat_products=mysqli_fetch_array($run_cat_products)){
                    
                     $pro_id=$row_cat_products['product_id'];
             $pro_title=$row_cat_products['product_title'];
                     $pro_cat=$row_cat_products['cat_id'];
                     $pro_brand=$row_cat_products['brand_id'];
                     $pro_desc=$row_cat_products['product_desc'];
                     $pro_price=$row_cat_products['product_price'];
                     $pro_image=$row_cat_products['product_img1'];
                    
                    echo"
                    <div id='single_product'>
                    <h3>$pro_title</h3>
                    <img src='admin_area/product_images/$pro_image' width='180' height='180'> <br>
                    <p><b>Price: INR $pro_price</b></p>
                    <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                    <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                    </div>
                    ";
                    
                }
                
            }

    

}

function getBrandProduct(){
    global $db;
    if(isset ($_GET['product_brand'])){
             
        
        
                $brand_id=$_GET['product_brand']   ;
                  $get_brand_products="select * from products where brand_id='$brand_id'";
                  $run_brand_products=mysqli_query($db,$get_brand_products);
        
        $count = mysqli_num_rows($run_brand_products);
        
        if($count==0){
            echo "<h2>No products Found in this Brand!</h2>";
        }
        
                while ($row_brand_products=mysqli_fetch_array($run_brand_products)){
                    
                     $pro_id=$row_brand_products['product_id'];
             $pro_title=$row_brand_products['product_title'];
                     $pro_cat=$row_brand_products['cat_id'];
                     $pro_brand=$row_brand_products['brand_id'];
                     $pro_desc=$row_brand_products['product_desc'];
                     $pro_price=$row_brand_products['product_price'];
                     $pro_image=$row_brand_products['product_img1'];
                    
                    echo"
                    <div id='single_product'>
                    <h3>$pro_title</h3>
                    <img src='admin_area/product_images/$pro_image' width='180' height='180'> <br>
                    <p><b>Price: INR $pro_price</b></p>
                    <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                    <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
                    </div>
                    ";
                    
                }
                
            }

    

}
function getCategory(){
        global $db;

           $get_cats = "select * from category";
           $run_cats = mysqli_query($db ,$get_cats);
     while ($row_cats=mysqli_fetch_array($run_cats)){
                
                $cat_id = $row_cats['cat_id'];
                 $cat_title = $row_cats['cat_title'];
               
          echo "<li><a href='index.php?product_cat=$cat_id'>$cat_title</a></li>";
               }
        
    
    
}


function getBrands(){
    global $db;
    $get_brands = "select * from brands";
           $run_brands = mysqli_query($db ,$get_brands);
     while ($row_brands=mysqli_fetch_array($run_brands)){
                
                $brand_id = $row_brands['brand_id'];
                 $brand_title = $row_brands['brand_title'];
               
          echo "<li><a href='index.php?product_brand=$brand_id'>$brand_title</a></li>";
               }
}



?>