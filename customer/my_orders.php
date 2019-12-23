<?php
include("includes/db.php");
//include("funtions/funtion.php");
//getting customer id
$c = $_SESSION['customer_email'];
    $get_c = "select * from customer where customer_email='$c'";
    $run_c = mysqli_query($db,$get_c);
    
$row_c = mysqli_fetch_array($run_c);
        
        $customer_id = $row_c['customer_id'];




?>
<h3>All Order Details</h3>
<table width = "1000px" align="center" >
    
    
    <tr>
        <th>Order No.</th>
        <th>Due Amount</th>
        <th>Invoice Number</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Paid/Unpaid</th>
        <th>Status</th>
        
    </tr>
    
    <?php
    
    $get_orders = "select * from customer_orders where customer_id ='$customer_id'" ;
    $run_orders = mysqli_query($con,$get_orders);
    $i=0;
    while($row_orders = mysqli_fetch_array($run_orders)){
        
        $order_id = $row_orders['order_id'];
        $due_amount = $row_orders['due_amount'];
        $invoice_no = $row_orders['invoice_no'];
        $product_no = $row_orders['total_products'];
        $status = $row_orders['order_status'];
        $date = $row_orders['order_date'];
        $i++;
        
        
        if($status=='Pending'){
            
          $status = 'Unpaid';
            
            
            
        }
        else {
            
            $status = 'Paid';
        }
        echo"
        <tr align='center'>
        <td>$i</td>
        <td>$due_amount</td>
        <td>$invoice_no</td>
        <td>$product_no</td>
        <td>$date</td>
        <td>$status</td>
        <td><a href='confirm.php?order_id=$order_id' target='_blank'>Confirm if paid</a></td>
        
        
        </tr>
        
        
        
        ";
        
        
    }
    
    
    
    ?>
    
    
</table>
