<?php
include("includes/db.php");
?>


    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({selector:'textarea'});
    </script>
    <link rel="stylesheet" href="styles/bootstrap.min.css" media="all"/>
    <link rel="stylesheet" href="styles/style.css" media="all"/>
</head>
<body bgcolor="#999999">
    <form action="" method="post" enctype="multipart/form-data">
        <h2 align="center">Products</h2>
        <table  bgcolor="#139187" align="center">
           
            <tr align="center">
                <td><b>Remove</b></td>
                    <td><b>Product No.</b></td>
                    <td><b>Product Title.</b></td>
                    <td><b>Product Image.</b></td>
                    <td><b>Product Description.</b></td>
                    <td><b>Product Price.</b></td>
                    
                    
                    
            </tr>
        <?php
            $get_products="select * from products";
                  $run_products=mysqli_query($con,$get_products);
                  $i = 0;
                while ($row_products=mysqli_fetch_array($run_products)){
                    
                     $pro_id=$row_products['product_id'];
             $pro_title=$row_products['product_title'];
                     $pro_cat=$row_products['cat_id'];
                     $pro_brand=$row_products['brand_id'];
                     $pro_desc=$row_products['product_desc'];
                     $pro_price=$row_products['product_price'];
                     $pro_image=$row_products['product_img1'];
                    $i++;
            
            ?>        
            <tr>
            <td align="center"><input type="checkbox" value="<?php echo $pro_id; ?>" name="remove[]"></td>
            <td align="center"><?php echo $i; ?></td>
            <td align="center"><?php echo $pro_title; ?></td>
            <td align="center"><img src="product_images/<?php echo $pro_image; ?>" height="100" width="100"></td>
            <td align="center"><?php echo $pro_desc; ?></td>
            
            <td align="center"><?php echo $pro_price; ?></td>
            
            </tr>
            <?php
                }
            
            ?>
            <td align="center"><input class="btn btn-dark text-uppercase" type="submit" name="update" value="Delete Selected Products"/></td>
        </table>
        
    </form>
    
</body>
</html>
   <?php 
                
                if(isset($_POST['update']))
                {
                    
                    foreach($_POST['remove'] as $remove_id)
                        
                    {
                        global $con;
                        $delete_products ="delete from products where product_id='$remove_id'";
                        $run_delete=mysqli_query($con,$delete_products);
                        if($run_delete)
                        {
                            echo"<script>alert('Product Deleted Sucessfully')</script>";
                            echo"<script>window.open('view_products.php','_self')</script>";
                        }
                        
                    }
                              
                }
                
                
                   
                ?>
           