<?php
    session_start();
    require_once "configure.php";   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kairos - Checkout</title>
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
    <div class="txt-heading"><h2>Checkout</h2></div>

    
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>

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

<div class="row d-flex justify-content-around">
    <div class="col-1"></div>
    <div class="col-10">
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
        <tbody>
        <tr class='table-head'>
        <th class="font-weight-bold" style="text-align:left;">Name</th>
        <th class="font-weight-bold" style="text-align:left;">ID</th>
        <th class="font-weight-bold" style="text-align:right;" width="5%">Quantity</th>
        <th class="font-weight-bold" style="text-align:right;" width="20%">Unit Price</th>
        <th class="font-weight-bold" style="text-align:center;" width="20%">Price</th>
        </tr>	
        <?php		
            foreach ($var as $item){
                $item_price = $item["quantity"]*$item["price"];
        		?>
        				<tr>
        				<td><?php echo $item["name"]; ?></td>
        				<td><?php echo $item["ID"]; ?></td>
        				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
        				<td  style="text-align:right;"><?php echo "₹ ". number_format($item["price"],2); ?></td>
        				<td  style="text-align:right;"><?php echo "₹ ". number_format($item_price,2); ?></td>
        				</tr>
        				<?php
        				$total_quantity += $item["quantity"];
        				$total_price += ($item["price"]*$item["quantity"]);
        		}
        		?>

        <tr class="table-foot">
        <td colspan="2" align="right">Total:</td>
        <td align="right"><?php echo $total_quantity; ?></td>
        <td align="right" colspan="2"><strong><?php echo "₹ ".number_format($total_price, 2); ?></strong></td>
        <td></td>
        </tr>
        </tbody>
        </table>
    </div>
    <div class="col-1"></div>
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

    <div class="spacer"></div>
    <div class="spacer"></div>
    
    <div class="d-flex justify-content-center">
        <input class="btn btn-outline-primary mx-4" type="button" onclick="location.href='index4.php';" value="←  Pick Something Else"/>
        <input class="btn btn-outline-primary mx-4" type="button" onclick="location.href='details.php';" value="Enter Shipping Details  →"/>
    </div>


    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    
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