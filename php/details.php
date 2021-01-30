<?php
    // Initialize the session
    session_start();
    require_once "configure.php";
    require_once "configure1.php";

    if(isset($_POST["submit"]))
    {
        $_SESSION['name']=$_POST['name'];
        $_SESSION['number']=$_POST['number'];
        $_SESSION['flat']=$_POST['flat'];
        $_SESSION['area']=$_POST['area'];
        $_SESSION['pin']=$_POST['pin'];
        $_SESSION['city']=$_POST['city'];
        $_SESSION['type']=$_POST['type'];
    }

    if(isset($_POST["name"]) && isset($_POST["number"]) && isset($_POST["flat"]) &&isset($_POST["area"]) && isset($_POST["pin"]) && isset($_POST["city"]) &&
    isset($_POST["type"]) )
    {
        echo "Out".'<br>';
        $email=trim($_SESSION['email']);
        $sql = "UPDATE details SET Name='".$_POST['name']."',Mobile='".$_POST['number']."',Flat='".$_POST['flat']."',Area='".$_POST['area']."',Pincode='".$_POST['pin']."',City='".$_POST['city']."',Type='".$_POST['type']."'WHERE email='".$email."'";
        $sql1="SELECT * FROM details";
        if(mysqli_query($link1,$sql))
        {
            echo "2";
            mysqli_query($link1,$sql);
            header("location: page.php");
        }
        else
        {
            echo "error";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Kairos - Shipping Details</title>
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
    <div class="txt-heading"><h2>Shipping Details</h2></div>

    <div class="spacer"></div>
    <div class="spacer"></div>


    <div class="row d-flex justify-content-around">
        <div class="col-3"></div>    
        <div class="details col-6">
	    	<form method="post">
                <label>Enter Full Name</label><input type="text" id="name" name="name" class="input float-right form-input"><br><br>
                <label>Enter Mobile Number</label><input type="text" id="number" name="number" class="input float-right form-input"><br><br>
                <label>Enter Flat, Building</label><input type="text" id="flat" name="flat" class="input float-right form-input"><br><br>
                <label>Enter Area</label><input type="text" id="area" name="area" class="input float-right form-input"><br><br>
                <label>Enter Pincode</label><input type="text" id="pin" name="pin" class="input float-right form-input"><br><br>
                <label>Enter City</label><input type="text" id="city" name="city" class="input float-right form-input"><br><br>
                <label>Enter Type of address</label>
                <select name="type" id="type" class="float-right custom-select">
                    <option class="custom-option" value="Home">Home</option>
                    <option class="custom-option" value="Office">Office</option>
                </select>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="spacer"></div>
                <div class="d-flex justify-content-center">
                    <input class="btn btn-outline-primary mx-4" type="button" onclick="location.href='checkout.php';" value="←  Check Purchased Items"/>
                    <input class="btn btn-outline-primary mx-4" type="submit" value="Go to Final Page   →"/>
                </div>  
	    	</form>
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