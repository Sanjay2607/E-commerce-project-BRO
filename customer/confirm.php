<?php
session_start();
include("includes/db.php");

if(isset($_GET['order_id'])){
    
    $order_id = $_GET['order_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>confirm</title>
</head>
<body bgcolor="#47535E">
    <form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post">
        
        
        <table width="500" align="center" border="2">
            <tr align="center">
                <td colspan="5"><h2>Confirm the payment</h2></td>
                
                
            </tr>
            <tr>
                
                <td>Invoice No:</td>
                <td><input type="text" name="invoice_no" /></td>
            </tr>
               <tr>
                
                <td>Amount deposited:</td>
                <td><input type="text" name="amount"/></td>
            </tr>
               <tr>
                
            <td>Select Payment Mode No:</td>
        <td><select name="payment_method">
            <option>Select Payment</option>
            <option>Bank Transfer</option>
            <option>PayTm</option>
            
        </select></td>
            </tr>
            
            <tr>
                
                <td> Transaction id</td>
                <td><input type="text" name="tr" /></td>
            </tr>
            <tr>
                
                <td>Paytm/bank reference :</td>
                <td><input type="text" name="pbr" /></td>
            </tr>
            <tr>
                
                <td>Payment Date :</td>
                <td><input type="date" name="date" /></td>
            </tr>
            <tr align="center">
                
                
                <td colspan="5"><input type="submit" name="confirm"  value="Confirm Payment"/></td>
            </tr>
        </table>
    </form>
</body>
</html>

<?php
if(isset($_POST['confirm'])){
    
    $update_id = $_GET['update_id'];
    $invoice = $_POST['invoice_no'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $ref_no = $_POST['tr'];
    $pbr_no = $_POST['pbr'];
    $date = $_POST['date'];
    $complete = 'complete';
    $insert_payments = "insert into payment (invoice_id,amount,payment_mode,ref_no,code,payment_date) values('$invoice','$amount','$payment_method','$ref_no','$pbr_no','$date')";
    
    $run_payment = mysqli_query($con,$insert_payments);
    
    $update_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";
        
        $run_order = mysqli_query($con ,$update_order);
        
    if($run_payment){
        
        echo"<h2 style='text-align:center;color:white' >Payment received ,your order will be completed within 24 hours</h2>";
        
        
    }
    
}


?>
