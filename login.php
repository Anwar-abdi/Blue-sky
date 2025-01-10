<?php session_start();
error_reporting(0);
include_once('includes/config.php');
// Code for User login
if(isset($_POST['login']))
{
   $email=$_POST['emailid'];
   $password=md5($_POST['inputuserpwd']);
$query=mysqli_query($con,"SELECT id,name FROM tblusers WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
//If Login Suceesfull

if($num>0)
{
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
echo "<script type='text/javascript'> document.location ='index.php'; </script>";
}
//If Login Failed
else{
    echo "<script>alert('Invalid login details');</script>";
    echo "<script type='text/javascript'> document.location ='login.php'; </script>";
exit();
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Meeting and Conference  Booking System  | User Sign in / Login</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/moon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
       <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
    </head>
<style type="text/css">
    input { border:solid 1px #000;

    }
    .text-shadow {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }
    .card {
        transition: all 0.3s ease-in-out;
    }
    .card:hover {
        transform: translateY(-5px);
    }
    .input-group-text {
        background-color: #f8f9fa;
        border-right: none;
    }
    .input-group .form-control {
        border-left: none;
    }
    .input-group .form-control:focus {
        border-color: #dee2e6;
        box-shadow: none;
    }
    .btn-primary {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .form-control-lg {
        border-radius: 0.5rem;
    }
</style>
    <body>
<?php include_once('includes/header.php');?>
        <!-- Header-->
        <header class="bg-primary bg-gradient py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder text-shadow">Welcome Back</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Sign in to manage your bookings</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-body p-5">
                                <form method="post" name="login">
                                    <div class="mb-4">
                                        <label class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                            <input type="email" name="emailid" id="emailid" class="form-control form-control-lg" 
                                                   onBlur="emailAvailability()" required placeholder="Enter your email">
                                        </div>
                                        <span id="user-email-status" class="text-muted small"></span>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-key"></i></span>
                                            <input type="password" name="inputuserpwd" class="form-control form-control-lg" 
                                                   required placeholder="Enter your password">
                                        </div>
                                        <div class="mt-2">
                                            <a href="password-recovery.php" class="text-decoration-none small">Forgot Password?</a>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="submit" name="login" class="btn btn-primary btn-lg">Sign In</button>
                                        <div class="text-center mt-3">
                                            <span class="text-muted">Don't have an account?</span>
                                            <a href="signup.php" class="text-decoration-none">Sign Up</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
   <?php include_once('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
