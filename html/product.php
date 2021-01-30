<?php
    // Initialize the session
    session_start();
    require_once("dbcontroller.php");
    require_once "configure.php";
    require_once "configure1.php";
    $db_handle = new DBController();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div id="product-grid">
        <div class="txt-heading">Products</div>
        <?php
        $product_array = $db_handle->runQuery("SELECT * FROM images i INNER JOIN watches w ON i.ID=w.ID");
        if (!empty($product_array)) { 
            foreach($product_array as $key=>$value){
        ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&ID=<?php echo $product_array[$key]["ID"]; ?>">
                <a href="display.php?ID=<?php echo $product_array[$key]["ID"]; ?>">
                <div class="product-image"><?php  echo '<img src="data:image/jpeg;base64,'.base64_encode($product_array[$key]['images']).'"/>'; ?></div></a>
                <div class="product-tile-footer">
                <div class="product-title"><?php echo $product_array[$key]["Watch_Name"]; ?></div>
                <div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
                </div>
                </form>
            </div>
        <?php
            }
        }
        ?>
    </div>
</body>
</html>