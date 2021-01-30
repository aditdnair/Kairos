<?php
// Include config file
require_once "configure.php";
require_once "configure1.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM details WHERE email = ?";
        
        if($stmt = mysqli_prepare($link1, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $email_err = "This email is already registered.";
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 5){
        $password_err = "Password must have atleast 5 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($email_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO details (email, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link1, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);
            
            // Set parameters
            $param_email = $email;
            $param_password = $password;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
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
    <title>Kairos - Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../svg/logo.svg" type="image/gif" sizes="16x16"> 
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

    <div class="row">
        <div class="card mx-auto shadow">
            <form class="p-4 row no-gutters" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                
                <div class="col-md-4 d-flex flex-column justify-content-center border-right pr-3">
                    <div class="d-flex justify-content-center">
                        <img src="../svg/name_logo.svg" class="card-img w-75 pb-2">
                    </div>   
                </div>

                <div class="col-md-7 offset-md-1">
                    <div class="py-2 font-weight-bold h1">
                        <span>Register</span>
                    </div>
                    <div class="form-group">
                        <label class="h5">Email</label>
                        <br>
                        <input type="email"name="email" class="input" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label class="h5">Password</label>
                        <br>
                        <input type="password" name="password" class="input" placeholder="Enter Password" required> 
                    </div>
                    <div class="form-group">
                        <label class="h5">Confirm Password</label>
                        <br>
                        <input type="password" name="confirm_password" class="input" placeholder="Confirm Password" required> 
                    </div>
                    <div class="form-group d-flex justify-content-center py-2">
                        <span><?php echo $password_err; ?></span>
                        <span>Already a user? <a class="register-link" href="../html/login.php">Login</a></span>
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