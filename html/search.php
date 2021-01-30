<?php
    // Initialize the session
    session_start();
    require_once "configure.php";

    /*$watches="select * from pc_cpu";
    $watchesquery=mysqli_query($link,$watches);*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/search.css">
</head>
<body>

    <form name="form" action="" method="post">
    <div class='brand'>
      <label>Brand<label><br>
      <input type="checkbox" name="name[]" value="TAG Heuer" />TAG Heuer<br />
      <input type="checkbox" name="name[]" value="OMEGA" />OMEGA<br/>
      <input type="checkbox" name="name[]" value="Calvin Klein" />Calvin Klein<br/>
      <input type="checkbox" name="name[]" value="Claude Bernard" />Claude Bernard<br/>
      <input type="checkbox" name="name[]" value="Casio" />Casio<br/>
      <input type="checkbox" name="name[]" value="Victorinox" />Victorinox<br/>
      <input type="checkbox" name="name[]" value="Apple" />Apple<br/>
      <br>
    </div>

    <div class='movement'>
      <label>Movement Type<label><br>
      <input type="checkbox" name="movement[]" value="Automatic" />Automatic<br />
      <input type="checkbox" name="movement[]" value="Quartz" />Quartz<br/>
      <br>
    </div>

    <div class='gender'>
      <label>Gender<label><br>
      <input type="checkbox" name="gender[]" value="Men" />Men<br />
      <input type="checkbox" name="gender[]" value="Women" />Women<br/>
      <input type="checkbox" name="gender[]" value="Unisex" />Unisex<br/>
      <br>
    </div>

    <div class='material'>
      <label>Material<label><br>
      <input type="checkbox" name="material[]" value="Titanium" />Titanium<br />
      <input type="checkbox" name="material[]" value="Steel" />Steel<br/>
      <input type="checkbox" name="material[]" value="Aluminium" />Aluminium<br/>
      <br>
    </div>


    <div class='price'>
      <label>Price<label><br>
      <input type="checkbox" name="price" value="10000-50000" />₹10,000-₹50,000<br />
      <input type="checkbox" name="price" value="50000-100000" />₹50,000-₹1,00,000<br/>
      <input type="checkbox" name="price" value="100000-500000" />₹1,00,000-₹5,00,000<br/>
      <input type="checkbox" name="price" value="500000-1000000" />₹5,00,000-₹10,00,000<br/>
      <input type="checkbox" name="price" value="1000000-1500000" />₹10,00,000-₹15,00,000<br/>
      <br>
    </div>

    <input type="text" name="search">
    <br><br>

    <input type="submit" name="submit" value="Submit"/>
    </form>

</body>
</html>

<?php   
 echo "<table class='db-table'>";
 echo "<tr colspan='15'>Table</tr><br>";
 echo "  <table border = 1> <tr> <th>Brand Name</th></tr>";
  echo "<tr>";
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
              $br=$row['Watch_Name'];
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
            $mov=$row['Watch_Name'];
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
                $gen=$row['Watch_Name'];
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
                $mat=$row['Watch_Name'];
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
                  $pric=$row['Watch_Name'];
                  array_push($watches,$pric);
              }
            }
            
            if(!empty($_POST['search']))
            {
              $text=$_POST["search"];
                $sql = "SELECT * FROM watches WHERE Watch_Name LIKE '$text%' OR Watch_Name LIKE '%$text%' ";
                $result = mysqli_query($link, $sql);
              
                while($row=mysqli_fetch_assoc($result))
                {
                    print $row['Watch_Name'];
                }
              }  


            $watches=array_unique($watches);
            foreach($watches as $i)
            {
              print "<tr><td><a href='".$i.'.php>'.$i.'</a></td></tr>';
            }
                  
          echo "</tr>";

    mysqli_close($link);
}

?>
