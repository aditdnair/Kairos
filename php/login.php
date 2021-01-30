<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../html/index4.php");
    exit;
}
 
// Include config file
require_once "configure.php";
require_once "configure1.php";
 
// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if email is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, email, password FROM details WHERE email = ?";
        
        if($stmt = mysqli_prepare($link1, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if email exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $email, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        $query=mysqli_query($link1,"select * from details WHERE email='".$email."' and password='".$password."'");
                        $numrows=mysqli_num_rows($query);
                        if($numrows>0)
                        {
                            while($row=mysqli_fetch_array($query,MYSQLI_ASSOC))
                            {
                                $dbpassword=$row['password'];
                                if($dbpassword==$password){
                                    // Password is correct, so start a new session
                                    session_start();
                                    
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $id;
                                    $_SESSION["email"] = $email;                            
                                    
                                    // Redirect user to welcome page
                                    header("location: ../html/index4.php");
                                } else{
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link1);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kairos - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../svg/logo.svg"> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,600" rel="stylesheet">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/index.css">
</head>
<body class="container-fluid">

    <nav class="navbar nav-bar row">
        <a href="../html/home.html"><img src="../svg/name_logo.svg" class="logo"></a>        
    </nav>

    <div class="spacer"></div>  
    <div class="spacer"></div>  
    <div class="spacer"></div>  
    <div class="spacer"></div>  
    <div class="spacer"></div>  
    <div class="spacer"></div>  
    <div class="spacer"></div>  

    <div class="row">
        <div class="card mx-auto shadow login-form">
            <form class="p-4 row no-gutters" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="col-md-4 d-flex flex-column justify-content-center border-right pr-3">
                    <div class="d-flex justify-content-center">
                        <img src="../svg/name_logo.svg" class="card-img w-75 pb-2">
                    </div>
                </div>

                <div class="col-md-7 offset-md-1">
                    <div class="pb-2 font-weight-bold h1">
                        <span>Login</span>
                    </div>
                    <div class="form-group py-1">
                        <label class="h4">Email</label>
                        <br>
                        <input type="email" name="email" class="input" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group py-1">
                        <label class="h4">Password</label>
                        <br>
                        <input type="password" name="password" class="input" placeholder="Enter Password" required> 
                    </div>
                    <div class="form-group d-flex justify-content-center pb-2">
                        <span>New here? <a class="register-link" href="../html/get-started.php">Get Started</a></span>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </div>                
                </div>

            </form>
        </div>    
    </div>
    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>