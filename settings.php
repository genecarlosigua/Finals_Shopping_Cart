<?php
    session_start();
    if (isset($_SESSION['id'])&& isset($_SESSION['username'])) {
?>

<?php require_once("header.php"); 

    if(isset($_POST['btnchange'])) {
                
        $userpass = sanitizeInput($con, $_POST['txtpass']);  

        $err = [];

        if(empty($userpass))
            $err[] = "Product Name is required!";  
        if(empty($err)){
            
            $strSql = "UPDATE user_table SET

                                password = '$userpass',  

                        WHERE product_ID = " . $_SESSION['k'];

            if(mysqli_query($con, $strSql))
                ;
            else
                echo 'Error: Failed to Update Record!';          
        }              
        closeConnection($con);         
    }

    ?>
                <main class="col-md-6 ms-sm-auto col-lg-12 px-md-4">
                    <h2><i class="fa-solid fa-gear"></i> Settings</h2>

                        <div class="form-group row">
                            <label for="txtname" class="col-sm-2 col-form-label"><h4><b> Change Password</b></h4></label>
                            <div class="col-sm-10">
                                <input type="text" name="txtpass" class="form-control" id="txtname" value="">
                            </div>
                        </div>

                        <div class="form-group row">
                                <div class=" col-sm-10">
                                    <a href="home.php" class="btn btn-primary"><i class="fa-solid fa-arrow-left-long"></i> Back </a>
                                    <button type="submit" name="btnchange" class="btn btn-danger"> Change Password</button>
                                </div>
                        </div>
                </main>


<?php require_once("footer.php"); ?>

<?php
    }else{
        header("Location: index.php");
        exit();
    }
?>