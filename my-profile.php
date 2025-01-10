<?php session_start();
include_once('includes/config.php');
if(strlen($_SESSION['id'])==0)
{   header('location:logout.php');
}else


//For updating User  Profile
if(isset($_POST['update']))
{
$name=$_POST['fullname'];
$uid=$_SESSION['id'];
$contactno=$_POST['contactnumber'];
$query=mysqli_query($con,"update tblusers set name='$name',contactno='$contactno' where id='$uid'");
if($query)
{
    echo "<script>alert('Profile Updated successfully');</script>";
    echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
}else{
echo "<script>alert('Something went wrong. Please try again.');</script>";
    echo "<script type='text/javascript'> document.location ='my-profile.php'; </script>";
} }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Meeting and Conference  Booking System  | User Profile</title>
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
.text-shadow {
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}
.card {
    transition: all 0.3s ease-in-out;
}
.card:hover {
    transform: translateY(-5px);
}
.form-control-lg {
    border-radius: 0.5rem;
}
.form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}
</style>
    <body>
<?php include_once('includes/header.php');?>
        <!-- Header-->
        <header class="bg-primary bg-gradient py-5">
            <div class="container px-4 px-lg-5 my-5">

<?php 
$uid=$_SESSION['id'];
$query=mysqli_query($con,"select * from tblusers where id='$uid'");
while($result=mysqli_fetch_array($query)){

?>
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder text-shadow"><?php echo htmlentities($result['name']);?>'s Profile</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Manage your account settings</p>
                </div>

            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card shadow-lg border-0 rounded-lg">
                            <div class="card-body p-5">
                                <form method="post" name="profile">
                                    <div class="mb-4">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" name="fullname" value="<?php echo htmlentities($result['name']);?>" class="form-control form-control-lg" required>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Email Address</label>
                                        <input type="email" name="emailid" value="<?php echo htmlentities($result['email']);?>" class="form-control form-control-lg" readonly>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label">Contact Number</label>
                                        <input type="text" name="contactnumber" value="<?php echo htmlentities($result['contactno']);?>" pattern="[0-9]{10}" title="10 numeric characters only" class="form-control form-control-lg" required>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="submit" name="update" class="btn btn-primary btn-lg">Update Profile</button>
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
<?php } ?>
