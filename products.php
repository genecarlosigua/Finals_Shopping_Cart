<?php
    session_start();
    require_once("header.php"); 
    if(isset($_SESSION['id']) && ($_SESSION['username'])) {
?>

<?php 

        if(isset($_POST['btnAdd'])) {
            $con = openConnection();

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
            
                $strSql = "INSERT INTO products_table (product_name, product_details, product_sizes, product_prices, product_stock) VALUES ('$name', '$details', '$sizes', '$price', '$stocks')";

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
                <h1 class="h2"><i class="fa-regular fa-pen-to-square"></i> Add Products</h1>
            </div>

            <form method="POST">

                <div class="form-group row">
                    <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Name:</h4></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtname" class="form-control" id="txtname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Details:</h4></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtdetails" class="form-control" id="txtname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Sizes:</h4></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtsizes" class="form-control" id="txtname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Price:</h4></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtprice" class="form-control" id="txtname">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="txtname" class="col-sm-2 col-form-label"><h4>Product Stocks:</h4></label>
                    <div class="col-sm-10">
                        <input type="text" name="txtstocks" class="form-control" id="txtname">
                    </div>
                </div>
                
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" name="btnAdd" class="btn btn-primary"><i class="fa-regular fa-pen-to-square"></i> Add Product</button>
                    </div>
                </div>

            </form>
        </main>
            <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><i class="fa fa-clipboard"></i> Products</h1>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Details</th>
                            <th scope="col">Sizes</th>
                            <th scope="col">Price</th>
                            <th scope="col">Stock</th>
                            <th scope="col">options</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php 
                                $con = openConnection();
                                $strSql = "SELECT * FROM products_table ORDER BY product_name, product_details, product_sizes, product_prices, product_stock";
                                $rec = getRecord($con, $strSql);

                                if(!empty($rec)) {
                                    foreach ($rec as $key => $value) {


                                       echo '<tr>';
                                            echo '<td>' . $value['product_name'] .'</td>';
                                            echo '<td>' . $value['product_details'] .'</td>';
                                            echo '<td>' . $value['product_sizes'] .'</td>';
                                            echo '<td>' . $value['product_prices'] .'</td>';
                                            echo '<td>' . $value['product_stock'] .'</td>';
                                            echo '<td>';
                                            echo '<a href="update-product.php?k=' . $value['product_ID'] . '" class="btn btn-success"><i class="fa-regular fa-pen-to-square"></i> Edit</a>';
                                            echo '<a href="remove-product.php?k=' . $value['product_ID'] . '" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i> Remove</a>';
                                            echo '</td>';
                                       echo '</tr>';

                                    }

                                }else{

                                }
                                  
                                closeConnection($con);
                            ?>
                    </table>
                </div>
            </main>

<?php include("footer.php"); ?>

<?php

    }else{
        header("Location: index.php");
        exit();
    }
?>