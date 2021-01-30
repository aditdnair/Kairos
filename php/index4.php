<?php
session_start();
require_once("dbcontroller.php");
require_once("configure.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	if(!isset($_POST['submit']) && !isset($_POST['reset'])){
	switch($_GET["action"]) {
	case "add":
        $productByCode = $db_handle->runQuery("SELECT * FROM images i INNER JOIN watches w ON i.ID=w.ID WHERE w.ID='". $_GET["ID"] ."' ");
        $itemArray = array($productByCode[0]["ID"]=>array('name'=>$productByCode[0]["Watch_Name"], 'ID'=>$productByCode[0]["ID"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["images"]));		
       echo $productByCode[0]["Quantity"];
        if($productByCode[0]["Quantity"]>=$_POST["quantity"]) {
        if(!empty($_SESSION["cart_item"])) {
            $id=array_column($_SESSION["cart_item"],"ID");
            if(in_array($productByCode[0]["ID"],$id)) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                        if($productByCode[0]["ID"] ==$v['ID']) {
                            if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                        }
                }
            } else {
                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
            }
        } else {
            $_SESSION["cart_item"] = $itemArray;
        }
    $sql="UPDATE watches SET Quantity=Quantity-'".$_POST["quantity"]."'WHERE ID='".$productByCode[0]["ID"]."'";
    mysqli_query($link,$sql);
  }
    else
    {?>
     <div class="no-records">Please enter a valid amount. <?php echo "Stock available is ".$productByCode[0]["Quantity"]."";?></div>
   <?php }
	break;
	case "remove":
		if(!empty($_SESSION["cart_item"])) {
			$cart=$_SESSION["cart_item"];
			foreach($cart as $k => $v) {
				$val=$v;
				if($_GET["ID"] == $v['ID'])
				{	
					unset($cart[$k]);
					$cart=array_values($cart);
					$sql="UPDATE watches SET Quantity=Quantity+'".$v['quantity']."'WHERE ID='".$v["ID"]."'";
					mysqli_query($link,$sql);
				}
				if(empty($cart))
				{
					unset($cart[0]);
				}	
			}
			$_SESSION["cart_item"]=$cart;
		}
	break;
	case "empty":
		if(!empty($_SESSION["cart_item"])) {
			$cart=$_SESSION["cart_item"];
			foreach($cart as $k => $v) {
				$val=$v;				
				$cart=array_values($cart);
				$sql="UPDATE watches SET Quantity=Quantity+'".$v['quantity']."'WHERE ID='".$v["ID"]."'";
				mysqli_query($link,$sql);
		}
	}
		unset($_SESSION["cart_item"]);
	break;	
}
}
}
?>
<?php   
$watches=array();
if(isset($_POST['submit']))
{//to run PHP script on submit

    if(!empty($_POST['name']))
    {
      $selected_brand=$_POST["name"];
      $brand=implode(", ",$selected_brand);
      foreach($selected_brand as $brand){     //run a loop through brand checkbox
        $sql = "SELECT * FROM watches WHERE Brand IN ('$brand')";
        $result = mysqli_query($link, $sql);
      
          while($row=mysqli_fetch_assoc($result))
          {
              $br=$row['ID'];
              array_push($watches,$br);
          }
        }
      }  
      if(!empty($_POST['movement'])){
      $selected_movement=$_POST["movement"];
      foreach($selected_movement as $movement){ //run a loop through movement checkbox
        $sql = "SELECT * FROM watches WHERE Movement IN ('$movement')";
        $result = mysqli_query($link, $sql);
       
        while($row=mysqli_fetch_assoc($result))
        {
            $mov=$row['ID'];
            array_push($watches,$mov);
        }
        }
      } 
      if(!empty($_POST['gender'])){
        $selected_gender=$_POST["gender"];
        foreach($selected_gender as $gender){ //run a loop through movement checkbox
          $sql = "SELECT * FROM watches WHERE Gender IN ('$gender')";
          $result = mysqli_query($link, $sql);
         
            while($row=mysqli_fetch_assoc($result))
            {
                $gen=$row['ID'];
                array_push($watches,$gen);
            }
          }
        } 

        if(!empty($_POST['material'])){
          $selected_material=$_POST["material"];
          foreach($selected_material as $material){ //run a loop through movement checkbox
            $sql = "SELECT * FROM watches WHERE Case_Material LIKE '$material%'";
            $result = mysqli_query($link, $sql);
           
            while($row=mysqli_fetch_assoc($result))
            {
                $mat=$row['ID'];
                array_push($watches,$mat);
            }
            }
          }   
          
          if(!empty($_POST['price'])){
            $selected_price=$_POST['price'];
            echo "<br>";
            $price=explode("-",$selected_price);
              $sql = "SELECT * FROM watches WHERE Price BETWEEN ('$price[0]') AND ('$price[1]')";
              $result = mysqli_query($link, $sql);
             
              while($row=mysqli_fetch_assoc($result))
              {
                  $pric=$row['ID'];
                  array_push($watches,$pric);
              }
			}  
			$watches=array_unique($watches);

    mysqli_close($link);
}
?>


<html>
<head>
<title>Kairos - Products</title>
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

<div id="shopping-cart">
  <div class="txt-heading"><h4>Shopping Cart</h4></div>
  <input class="btn btn-outline-primary float-right m-2" type="button" onclick="location.href='checkout.php';" value="Checkout"/>
  <a class="btn btn-outline-danger float-right m-2" href="index4.php?action=empty">Empty Cart</a>
  <?php
  if(isset($_SESSION["cart_item"])){
      $total_quantity = 0;
      $total_price = 0;
  ?>	
  <table class="tbl-cart" cellpadding="10" cellspacing="1">
  <tbody>
  <tr class='table-head'>
  <th class="font-weight-bold" style="text-align:left;">Name</th>
  <th class="font-weight-bold" style="text-align:left;">ID</th>
  <th class="font-weight-bold" style="text-align:right;" width="5%">Quantity</th>
  <th class="font-weight-bold" style="text-align:right;" width="20%">Unit Price</th>
  <th class="font-weight-bold" style="text-align:center;" width="20%">Price</th>
  <th class="font-weight-bold register-link" style="text-align:center;" width="10%">Remove</th>
  </tr>	
  <?php		
      foreach ($_SESSION["cart_item"] as $item){
          $item_price = $item["quantity"]*$item["price"];
  		?>
  				<tr>
  				<td><?php #echo '<img src="data:image/jpeg;base64,'.base64_encode($item["image"]).'class="cart-item-image"/>'?> <?php echo $item["name"]; ?></td>
  				<td><?php echo $item["ID"]; ?></td>
  				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
  				<td style="text-align:right;"><?php echo "₹ ". number_format($item["price"],2); ?></td>
  				<td style="text-align:right;"><?php echo "₹ ". number_format($item_price,2); ?></td>
  				<td style="text-align:center;"><a href="index4.php?action=remove&ID=<?php echo $item["ID"]; ?>" class="btnRemoveAction"><img height="20" width="15" src="../images/icon-delete.png" alt="Remove Item" /></a></td>
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
    <?php
  } else {
  ?>
  <div class="no-records">Your Cart is Empty</div>
  <?php 
  }
  ?>
</div>

<div class="row px-4">
  <div class="col-3">
    <div class="txt-heading mb-2"><h4>Filter</h4></div>
    <form name="form" action="" method="post">
      <h5>Brand</h5>
      <div class='brand'>
        <input type="checkbox" name="name[]" value="TAG Heuer" /> TAG Heuer<br />
        <input type="checkbox" name="name[]" value="OMEGA" /> OMEGA<br/>
        <input type="checkbox" name="name[]" value="Calvin Klein" /> Calvin Klein<br/>
        <input type="checkbox" name="name[]" value="Claude Bernard" /> Claude Bernard<br/>
        <input type="checkbox" name="name[]" value="Casio" /> Casio<br/>
        <input type="checkbox" name="name[]" value="Victorinox" /> Victorinox<br/>
        <input type="checkbox" name="name[]" value="Apple" /> Apple<br/>
        <br>
      </div>

      <h5>Movement Type</h5>
      <div class='movement'>
        <input type="checkbox" name="movement[]" value="Automatic" /> Automatic<br />
        <input type="checkbox" name="movement[]" value="Quartz" /> Quartz<br/>
        <br>
      </div>

      <h5>Gender</h5>
      <div class='gender'>
        <input type="checkbox" name="gender[]" value="Men" /> Men<br />
        <input type="checkbox" name="gender[]" value="Women" /> Women<br/>
        <input type="checkbox" name="gender[]" value="Unisex" /> Unisex<br/>
        <br>
      </div>

      <h5>Material</h5>
      <div class='material'>
        <input type="checkbox" name="material[]" value="Titanium" /> Titanium<br />
        <input type="checkbox" name="material[]" value="Steel" /> Steel<br/>
        <input type="checkbox" name="material[]" value="Aluminium" /> Aluminium<br/>
        <br>
      </div>

      <h5>Price</h5>
      <div class='price'>
        <input type="checkbox" name="price" value="10000-50000" /> ₹10,000-₹50,000<br />
        <input type="checkbox" name="price" value="50000-100000" /> ₹50,000-₹1,00,000<br/>
        <input type="checkbox" name="price" value="100000-500000" /> ₹1,00,000-₹5,00,000<br/>
        <input type="checkbox" name="price" value="500000-1000000" /> ₹5,00,000-₹10,00,000<br/>
        <input type="checkbox" name="price" value="1000000-1500000" /> ₹10,00,000-₹15,00,000<br/>
        <br>
      </div>
      <input class="btn btn-outline-primary" type="submit" name="submit" value="Submit"/>
      <input class="btn btn-outline-primary" type="submit" name="reset" value="Reset"/>
    </form>
  </div>

  <div class="col-9 float-right mb-4">
	    <div class="txt-heading"><h4>Products</h4></div>
	    <?php
	    $product_array = $db_handle->runQuery("SELECT * FROM images i INNER JOIN watches w ON i.ID=w.ID");
	    if (!empty($product_array)) { 
	    	foreach($product_array as $key=>$value){
	    ?>
      <div class="product_item <?php echo $product_array[$key]["ID"];?>">
	    	<div class="product-item d-flex p-2 justify-content-around <?php echo $product_array[$key]["ID"];?>">
	    		<form method="post" action="index4.php?action=add&ID=<?php echo $product_array[$key]["ID"]; ?>">
	    		<a href="display.php?ID=<?php echo $product_array[$key]["ID"]; ?>">
	    		<div class="product-image d-flex justify-content-around"><img width="170" height="200" src="../images/watch-image.jpg"/></div></a>
          <div class="product-tile-footer">
	    		<div class="product-title d-flex justify-content-around"><?php echo $product_array[$key]["Watch_Name"]; ?></div>
	    		<div class="product-price d-flex justify-content-around"><?php echo "₹". number_format($product_array[$key]["price"],2); ?></div>
          <div class="quant d-flex justify-content-around"><?php if($product_array[$key]["Quantity"]<=0)
	    			{
	    				echo '<span class="stock-out mb-3 font-weight-bold">Out of Stock</span>';
	    				?>
	    			<script>
	    				$(document).ready(function(){ 
	    						$(".cart-action.<?php echo $product_array[$key]["ID"];?>").hide();
	    				});
	    			</script>
            <?php }
            elseif ($product_array[$key]["Quantity"] > 0 && $product_array[$key]["Quantity"] < 20){
              echo '<span class="stock-lim mb-3 font-weight-bold">Stock Limited</span>';
            }
	    			else{
	    				echo '<span class="stock-in mb-3 font-weight-bold">In Stock</span>';
	    			}
          ?>
          </div>
          <div class="cart-action <?php echo $product_array[$key]["ID"];?>"><div class="cart-action d-flex justify-content-around <?php echo $product_array[$key]["ID"];?>"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction btn btn-outline-primary" /></div></div>
	    		</div>
	    		</form>
	    	</div>
        </div>
	    	<?php
	    	if(isset($_POST['submit'])){
	    	if(in_array($product_array[$key]["ID"],$watches)) {?>
	    		<script>
	    			$(document).ready(function(){
	    					$(".product_item.<?php echo $product_array[$key]["ID"];?>").show();
	    			});
	    	</script>
	    <?php
	    	}
	    	else{?>
	    		<script>
	    			$(document).ready(function(){
	    					$(".product_item.<?php echo $product_array[$key]["ID"];?>").hide();
	    			});
	    	</script>
	    <?php	}
	    }
	    }
	    }
	    ?>
      <?php
        if(isset($_POST['reset'])){
          ?>
	    		<script>
	    			$(document).ready(function(){
	    					$(".product_item.<?php echo $product_array[$key]["ID"];?>").show();
	    			});
	    	</script>
	    <?php
        }
      ?>

  </div>
</div>

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