<?php
    // Initialize the session
    session_start();
    require_once "configure.php";
    require_once "configure1.php";
?>
<?php 
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;

        $var=$_SESSION['cart_item'];
        foreach ($var as $key => $subArr) {
            unset($subArr['image']);
            $var[$key] = $subArr;  
        }
?>

<?php		
    foreach ($var as $item){
        $item_price = $item["quantity"]*$item["price"];
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"]*$item["quantity"]);
    }   
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Kairos - Payment Gateway</title>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../svg/logo.svg" type="image/gif" sizes="16x16"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body class="fluid-container">
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

    <div id="shopping-cart">
    <div class="txt-heading"><h2>Payment Gateway</h2></div>

    <div class="spacer"></div>
    <div class="spacer"></div>

    <div class="row">
        <div class="col-3"></div>    
        <div class="details col-6">
            <div class="details">
                <form action="confirm.php" method="post">
                    <label>Name on Credit Card</label><input type="text" id="cname" name="cname" class="float-right form-input input"><br><br>
                    <label>Credit Card number</label><input type="text" id="credit" name="credit" class="float-right form-input input"><br><br>
                    <label>CVV</label><input type="password" id="cvv" name="cvv" size="3" class="float-right input"><br><br>
                    <br>
                    <div class="d-flex justify-content-center">
                        <div class="d-flex flex-column  ">
                        <h3>Total Amount</h3>
                        <div class="spacer"></div>
                        <?php
                            echo '<br><h4><span class="price-font mx-4">₹ '.number_format($total_price, 2).'</span></h4>';
                        ?>
                        </div>
                    </div>
                    <br><br>
                    <div class="d-flex justify-content-center">
                        <input class="btn btn-outline-primary mx-4" type="button" onclick="location.href='page.php';" value="←  Check Order Details"/>
                        <input class="btn btn-outline-primary mx-4" type="submit" value="Confirm Payment  →"/>
                    </div>
	        	</form>
            </div>
        </div>
        <div class="col-3"></div>    
    </div>
  <?php
        }else{
            ?>
    <div class="no-records">Your Cart is Empty</div>
    <?php 
    }
?>  

    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>

    <footer class="row mx-n4 mb-n4 footer position-relative">
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
    if(isset($_POST['submit']))
    {
        $_SESSION['cname']=$_POST['cname'];
        $_SESSION['credit']=$_POST['credit'];
        $_SESSION['cvv']=$_POST['cvv'];
    }
?>