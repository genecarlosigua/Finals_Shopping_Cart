<?php
    session_start();
    require_once("header.php"); 
    if(isset($_SESSION['id']) && ($_SESSION['username'])) {

        if(isset($_GET['k']))
            $_SESSION['k'] = $_GET['k'];
?>

<?php 

        $con = openConnection();
        $strSql = "SELECT * FROM products_table WHERE product_ID =" . $_SESSION['k'];
        $recProduct = getRecord($con, $strSql);

        if($rs = mysqli_query($con, $strSql)){
            if(mysqli_num_rows($rs) > 0){
                $rec = mysqli_fetch_array($rs);
                mysqli_free_result($rs);
            }

            else{
                echo '<tr>';
                    echo '<td colspan="4" align="center"> No Record Found! </td>';
                echo '</tr>';
            }
        }

        if(isset($_POST['btnUpdate'])) {
            

            $name = sanitizeInput($con, $_POST['txtname']);
            $details = sanitizeInput($con, $_POST['txtdetails']);
            $sizes = sanitizeInput($con, $_POST['txtsizes']);
            $price = sanitizeInput($con, $_POST['txtprice']);
            $stocks= sanitizeInput($con, $_POST['txtstocks']);

            $err = [];

            if(empty($name))
                $err[] = "Product Name is required!";
            if(empty($details))
                $err[] = "Product Details is required!";
            if(empty($sizes))
                $err[] = "Product Sizes is required!";
            if(empty($price))
                $err[] = "Product Price is required!";
            if(empty($stocks))
                $err[] = "Product Stocks is required!";
            if(empty($err)){
            
                $strSql = "UPDATE products_table SET

                            product_name = '$name',
                            product_details = '$details',
                            product_sizes = '$sizes',
                            product_prices = '$price',
                            product_stock = '$stocks'

                            WHERE product_ID = " . $_SESSION['k'];
                
                if(mysqli_query($con, $strSql))
                    ;
                else
                echo 'Error: Failed to Insert Record!';
            }     
            closeConnection($con);

        }  
            
?>
        <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fa-regular fa-pen-to-square"></i> Edit Products</h1>
        </div>

        <form method="POST">

            <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Name:</h4></label>
                <div class="col-sm-10">
                    <input type="text" name="txtname" class="form-control" id="txtname" value="<?php echo $rec['product_name']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Details:</h4></label>
                <div class="col-sm-10">
                    <input type="text" name="txtdetails" class="form-control" id="txtname" value="<?php echo $rec['product_details']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Sizes:</h4></label>
                <div class="col-sm-10">
                    <input type="text" name="txtsizes" class="form-control" id="txtname" value="<?php echo $rec['product_sizes']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Price:</h4></label>
                <div class="col-sm-10">
                    <input type="text" name="txtprice" class="form-control" id="txtname" value="<?php echo $rec['product_prices']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Stocks:</h4></label>
                <div class="col-sm-10">
                    <input type="text" name="txtstocks" class="form-control" id="txtname" value="<?php echo $rec['product_stock']; ?>">
                </div>
            </div>
            
            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <a href="products.php" class="btn btn-primary"> Back </a>
                    <button type="submit" name="btnUpdate" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Edit Product</button>
                </div>
            </div>

        </form>
        </main>

<?php include("footer.php"); ?>

<?php

    }else{
        header("Location: index.php");
        exit();
    }
?>