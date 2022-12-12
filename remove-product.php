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

    if(isset($_POST['btnRemove'])) {
         
        $strSql = "DELETE FROM products_table WHERE product_ID = " . $_SESSION['k'];
        
        if(mysqli_query($con, $strSql))
            ;
        else
        echo 'Error: Failed to Insert Record!';

        closeConnection($con);
    }      
?>
        <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"><i class="fa fa-trash"></i> Remove Products</h1>
        </div>

        <form method="POST">

            <h1>Are you Sure you want to Remove this Product?</h1>

            <ul>
                <?php 
                    if(isset($rec)){
                        echo '<h2><li>Product: ' . $rec['product_name'] . '</h2></li>';
                        echo '<h2><li>Details: ' . $rec['product_details'] . '</h2></li>';
                        echo '<h2><li>Sizes: ' . $rec['product_sizes'] . '</h2></li>';
                        echo '<h2><li>Price: ' . $rec['product_prices'] . '</h2></li>';
                        echo '<h2><li>Stock: ' . $rec['product_stock'] . '</h2></li>';
                    }  
                ?>
            </ul>

            <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                    <a href="products.php" class="btn btn-primary"> Back </a>
                    <button type="submit" name="btnRemove" class="btn btn-primary"><i class="fa fa-trash"></i> Remove Product</button>
                </div>
            </div>

        </form>
<?php include("footer.php"); ?>

<?php

    }else{
        header("Location: index.php");
        exit();
    }
?>