<?php session_start();
include_once('includes/config.php');
error_reporting(0);
if (isset($_POST['submit'])) {
    $name = $_POST['fullname'];
    $email = $_POST['emailid'];
    $contactno = $_POST['contactnumber'];
    $password = md5($_POST['inputuserpwd']);
    $sql = mysqli_query($con, "select id from tblusers where email='$email'");
    $count = mysqli_num_rows($sql);
    if ($count == 0) {
        $query = mysqli_query($con, "insert into tblusers(name,email,contactno,password) values('$name','$email','$contactno','$password')");
        if ($query) {
            echo "<script>alert('You are successfully registered');</script>";
            echo "<script type='text/javascript'> document.location ='login.php'; </script>";
        } else {
            echo "<script>alert('Not register something went worng');</script>";
            echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
        }
    } else {
        echo "<script>alert('Email id already registered with another accout. Please try  with another email id.');</script>";
        echo "<script type='text/javascript'> document.location ='signup.php'; </script>";
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
    <title>Meeting and Conference Booking System | User Sign up</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
</head>
<script>
    function emailAvailability() {
        $("#loaderIcon").show();
        jQuery.ajax({
            url: "check_availability.php",
            data: 'email=' + $("#emailid").val(),
            type: "POST",
            success: function(data) {
                $("#user-email-status").html(data);
                $("#loaderIcon").hide();
            },
            error: function() {}
        });
    }
</script>
<style type="text/css"></style>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Header-->
    <header class="bg-primary bg-gradient py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder text-shadow">User Signup</h1>
                <p class="lead fw-normal text-white-50 mb-0">One Time Registration is Required for Booking</p>
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
                            <form method="post" name="signup">
                                <div class="mb-4">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="fullname" class="form-control form-control-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Email Id</label>
                                    <input type="email" name="emailid" id="emailid" class="form-control form-control-lg" onBlur="emailAvailability()" required>
                                    <span id="user-email-status" class="text-muted small"></span>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Contact Number</label>
                                    <input type="text" name="contactnumber" pattern="[0-9]{10}" title="10 numeric characters only" class="form-control form-control-lg" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <input type="password" name="inputuserpwd" class="form-control form-control-lg" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary btn-lg" required>
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