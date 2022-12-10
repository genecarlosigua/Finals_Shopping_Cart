<?php
    session_start();

    if(isset($_SESSION['id']) && ($_SESSION['username'])) {
?>
  
<?php include("header.php"); ?>

        <main class="col-md-9 ms-sm-auto col-lg-12 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2"><i class="fa-solid fa-gear"></i> Settings</h1>
            </div>
        </main>

<?php include("footer.php"); ?>

<?php

    }else{
        header("Location: index.php");
        exit();
    }
?>