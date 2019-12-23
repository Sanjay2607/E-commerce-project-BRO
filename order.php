<?php
include("includes/db.php");
include("functions/funtions.php");



// getting customer_id

if(isset($_GET['customer_id'])){
    
    $customer_id=$_GET['customer_id'];
    
}



//getting products and no. of items

$ip_add=getRealIpAddr();
    $total=0;

    $sel_price="select * from cart where ip_add='$ip_add'";
    $run_price =mysqli_query($con,$sel_price);

  $status='Pending';

  $invoice_no=mt_rand();
$count_pro=mysqli_num_rows($run_price);

    while($record=mysqli_fetch_array($run_price)){
        
        $product_id=$record['p_id'];
        $prod_price="select * from products where product_id='$product_id'";
        $run_pro_price=mysqli_query($con,$prod_price);
        while($p_price=mysqli_fetch_array($run_pro_price)){
            $product_price=array($p_price['product_price']);
            $values=array_sum($product_price);
            $total = $total + $values;
        }
    }

// getting quantity from thr cart
   

$get_cart="select * from cart where ip_add = '$ip_add'";
$run_cart=mysqli_query($con,$get_cart);
$get_qty=mysqli_fetch_array($run_cart);
$qty=$get_qty['qty'];

if($qty==0){
    $qty=1;
    
    $sub_total=$total;
    }

else{
      $qty=$qty;
    
    $sub_total=$total*$qty;
    
}

$insert_order="insert into customer_orders (customer_id,due_amount,invoice_no,total_products,order_date,order_status) 
values( '$customer_id','$sub_total','$invoice_no','$count_pro',NOW(),'$status')";

$run_order=mysqli_query($con,$insert_order);


//        if($run_order){
    
    echo "<script>alert('Order successfully submitted, Thanks!')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
    
    
    
    $insert_to_pending_orders="insert into pending_orders(customer_id,invoice_no,product_id,qty,order_status) 
    values('$customer_id','$invoice_no','$product_id','$qty','$status')";
        $run_pending_order=mysqli_query($con,$insert_to_pending_orders);

$empty_cart="delete from cart where ip_add='$ip_add'";
    $run_empty=mysqli_query($con,$empty_cart);

//    }
//    

?>