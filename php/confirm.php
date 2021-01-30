<?php
    // Initialize the session
    session_start();
    require_once "configure.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Kairos - Payment Confirmation</title>
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
    <div class="txt-heading"><h2>Payment Confirmation</h2></div>

    <div class="spacer"></div>
    <div class="spacer"></div>

    <div class="row">
        <div class="col-3"></div>    
        <div class="details col-6">
            <div class="spacer"></div>
            <div class="d-flex justify-content-center"><h5>Please verify your payment details before proceeding.</h5></div>
            <div class="spacer"></div>
            <div class="spacer"></div>
            <?php
                $cvv = $_POST['cvv'];
                $len = strlen($cvv);
                $str = "";
                for ($x = 0; $x < $len; $x++) {
                    $str .= "•";
                }
                echo '<h3>Name on Card: <span class="float-right">',$_POST['cname'],'</span></h3><br>';
                echo '<h3>Card Number: <span class="float-right">',$_POST['credit'],'</span></h3><br>';
                echo '<h3>CVV: <span class="float-right">',$str,'</span></h3><br>';
            ?>
            <div class="d-flex justify-content-center"><h4>Do you wish to place your order?</h4></div>    
            <div class="spacer"></div>
            <div class="d-flex justify-content-center">
            <input type="button" onclick="location.href='payement.php';" class="btn btn-outline-danger mx-4" value="←  No, Edit Order"/>
            <input type="button" onclick="location.href='end.php';" class="btn btn-outline-primary mx-4" value="Yes, Place Order  →"/>
            </div>
        </div>
        <div class="col-3"></div>    
    </div>

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