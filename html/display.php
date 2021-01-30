<?php
    // Initialize the session
    session_start();
    require_once "../html/configure.php";
?>
<?php

	$id = $_GET["ID"];

	$sql = "SELECT * FROM images i INNER JOIN watches w ON i.ID=w.ID WHERE w.ID='$id'";
    $result = mysqli_query($link, $sql);         
	while($rows = mysqli_fetch_array($result))
	{
        $img_id = $rows['ID'];
        $img_name = $rows['Watch_Name'];
        $img_brand = $rows['Brand'];
        $img_src = $rows['images'];
        $img_price = $rows['price'];
        $img_features = $rows['Features'];
        $img_quant = $rows['Quantity'];
	?>


<!DOCTYPE html>
<html>
<head>
  <title>Kairos - <?php echo $img_name ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../svg/logo.svg" type="image/gif" sizes="16x16"> 
  <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600" rel="stylesheet">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/index.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

  <nav class="navbar nav-bar">
      <a href="../html/home.html"><img src="../svg/name_logo.svg" class="logo"></a>  
      <div>
        <ul class="m-auto">
            <li class="menu"><a href="../html/login.php" class="nav-links isdisabled"><?php echo $_SESSION['email']; ?></a></li>
            <li class="menu"><a href="../html/logout.php" class="nav-links">Logout</a></li>
        </ul>
      </div>
  </nav>

  <div class="spacer"></div>
  <div class="spacer"></div>  
  <div class="spacer"></div>  
  <div class="spacer"></div>  

  <div class="row mt-4">
    <div class="col-4 d-flex justify-content-around">
      <img class="h-75" src="../images/watch-image.jpg"/>
    </div>
    <div class="col-8">
      <?php echo '<h2 class="mb-4"> ',$img_name,'</h2>';?>
      <form method="post" action="index4.php?action=add&ID=<?php echo $img_id; ?>">
        <h3>Price</h3><h5><?php echo "₹ ". number_format($img_price,2); ?></h5><br>
        <?php if($img_quant<=0)
	    			{
	    				echo '<h4 class="stock-out mb-3 font-weight-bold">Out of Stock</h4>';
            ?>
              <script>
                $(document).ready(function(){
                    $(".cart-action.<?php echo $img_id;?>").hide();
                });
              </script>
            <?php
            }
            elseif ($img_quant > 0 && $img_quant < 20){
              echo '<span class="stock-lim mb-3 font-weight-bold">Stock Limited</span>';
            }
	    			else{
	    				echo '<h5 class="stock-in mb-3 font-weight-bold">In Stock</h5>';
	    			}
        ?>
        <div class="cart-action <?php echo $img_id;?>"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction btn btn-outline-primary" /></div><br>
      </form>
        <h3>Brand</h3><h6><?php echo $img_brand; ?></h6><br>
        <h3>Features</h3><h6><?php echo $img_features; ?></h6><br>
    </div>
  </div>

<?php
}
?>

    <footer class="row footer position-relative">
        <div class="col">
            <ul>
                <li class="text-left foot_links font-weight-bold"><a><span class="text-left foot_links font-weight-bold text-white">Company</span></a></li>
                <li class="text-left foot_links"><a target="_blank" href="">Assistance</a></li>
                <li class="text-left foot_links"><a href="../html/policies.html" target="_blank">Policies</a></li>
                <li class="text-left foot_links"><a href="../html/about.html">About Us</a></li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li class="text-left foot_links font-weight-bold"><a><span class="text-left foot_links font-weight-bold text-white">Social Media</span></a></li>
                <li class="text-left foot_links"><a target="_blank" href="https://www.facebook.com/">Facebook</a></li>
                <li class="text-left foot_links"><a target="_blank" href="https://www.instagram.com/">Instragram</a></li>
                <li class="text-left foot_links"><a target="_blank" href="https://twitter.com/">Twitter</a></li>
            </ul>
        </div>
        <div class="col">
            <ul>
                <li class="text-left foot_links font-weight-bold"><a><span class="text-left foot_links font-weight-bold text-white">Newsletter</span></a></li>
                <li class="text-left foot_links"><span class="text-white">Sign Up <a href="../html/newsletter.html" target="_blank" class="font-weight-bold">here</a></span></li>
            </ul>
        </div>
        <span class="text-white text-center position-absolute fixed-bottom">© Kairos Watches</span>
    </footer>

</body>
</html>
<?php
    $_SESSION['pid']=$img_id;
?>