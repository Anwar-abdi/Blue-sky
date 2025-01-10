<?php session_start();
include_once('includes/config.php');
//error_reporting(0);

$rid = intval($_GET['rid']);

//Code for booking
if (isset($_POST['submit'])) {
    if (strlen($_SESSION['id']) == 0) {
        echo "<script>alert('Login is required for booking');</script>";
    } else {
        $bno = mt_rand(100000000, 999999999);
        $userid = $_SESSION['id'];
        $bdate = $_POST['inputdate'];
        $compindiname = $_POST['compindiname'];
        $billaddress = $_POST['billaddress'];
        $billcity = $_POST['billcity'];
        $billstate = $_POST['billstate'];
        $billzip = $_POST['billzip'];
        $billcountry = $_POST['billcountry'];
        $userremark = $_POST['userremark'];
        $amount = str_replace('$', '', $_POST['totalamount']);
        $paymenttype = $_POST['paymenttype'];
        $txnnumber = $_POST['txnnumber'];
        $rid = intval($_GET['rid']);
        $query = mysqli_query($con, "select id from tblbookings where roomId='$rid' and bookingDate='$bdate' and  boookingStatus='Approved'");
        $count = mysqli_num_rows($query);
        if ($count > 0) {
            echo "<script>alert('Room Already booked in this date.');</script>";
        } else {
            mysqli_query($con, "insert into tblbookings(bookingNo,userId,bookingDate,companyIndivadualName,billingAddress,billingCity,billingSate,billingZip,billingCountry,userMeassage,billAmount,paymentType,txnNumber,roomId) values('$bno','$userid','$bdate','$compindiname','$billaddress','$billcity','$billstate','$billzip','$billcountry','$userremark','$amount','$paymenttype','$txnnumber','$rid')");
            echo '<script>alert("Your booking placed successfully. Booking number is "+"' . $bno . '")</script>';
            echo "<script type='text/javascript'> document.location ='my-bookings.php'; </script>";
        }
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
    <title>Meeting and Conference Booking System | Room Details</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/moon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <?php include_once('includes/header.php'); ?>
    <!-- Product section-->

    <?php
    $rid = intval($_GET['rid']);
    $query = mysqli_query($con, "select * from tblrooms where  id='$rid'");
    while ($row = mysqli_fetch_array($query)) {
    ?>
        <form name="productdetails" method="post">
            <section class="py-5">
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center">
                        <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="admin/roomimages/<?php echo htmlentities($row['roomImage']); ?>" alt="<?php echo htmlentities($row['roomTitle']); ?>" width="500" height="400" style="border:solid 1px #000;" />


                        </div>
                        <div class="col-md-6">
                            <h1 class="display-5 fw-bolder"><?php echo htmlentities($row['roomTitle']); ?></h1>
                            <h4><strong>Room Type:</strong> <?php echo htmlentities($row['roomType']); ?></h4>
                            <div class="small mb-1"><strong>Room Capacity:</strong> <?php echo htmlentities($row['roomCapacity']); ?></div>
                            <div class="small mb-1"><strong>Price Per Day:</strong> <?php echo htmlentities($gtotal = $row['roomPpday']); ?></div>




                            <p class="lead"><?php echo $row['roomDesciption']; ?></p>




                        </div>
                    </div>
                </div>
            </section>
        </form>
    <?php } ?>

    <section>
        <div class="container">
            <h5> Billing Details</h5>
            <hr />

            <?php if (strlen($_SESSION['id']) == 0) { ?>
                <h5 style="color:red;">Login is required for booking</h5>
                <a href="login.php" class="btn btn-primary">Login</a>
        </div>
    <?php } else { ?>
        <form method="post" name="signup">
            <div class="row">
                <div class="col-2">Booking Date</div>
                <div class="col-4"><input type="date" id="inputdate" name="inputdate" placeholder="Booking Date" class="form-control" required></div>
                <div class="col-6"><input type="text" name="compindiname" placeholder="Company /Individual Name" class="form-control" required></div>
            </div>


            <div class="row py-4">

                <div class="col-12"><textarea name="billaddress" class="form-control" required rows="3" placeholder="Enter the billing address"></textarea></div>
            </div>

            <div class="row py-2">
                <div class="col-6"><input type="text" name="billcity" placeholder="Enter the city name" class="form-control" required></div>
                <div class="col-6"><input type="text" name="billstate" placeholder="Enter the state name" class="form-control" required></div>
            </div>

            <div class="row py-2">
                <div class="col-6"><input type="text" name="billzip" placeholder="Enter the zip code" maxlength="6" class="form-control" required></div>
                <div class="col-6"><input type="text" name="billcountry" placeholder="Enter the country" class="form-control" required></div>
            </div>

            <div class="row py-2">
                <div class="col-6"><textarea name="userremark" class="form-control" required rows="4" placeholder="Any Message / Remark"></textarea></div>
            </div>

            <div class="row py-2">
                <div class="col-2">Total Payment</div>
                <div class="col-6"><input type="text" name="totalamount" value="<?php echo  $gtotal; ?>" class="form-control" readonly></div>
            </div>
            <div class="row mt-3">
                <div class="col-2">Payment Type</div>
                <div class="col-6">

                    <select class="form-control" name="paymenttype" id="paymenttype" required>
                        <option value="">Select</option>
                        <option value="e-Wallet">E-Wallet</option>
                        <option value="Internet Banking">Internet Banking</option>
                        <option value="Debit/Credit Card">Debit/Credit Card</option>
                        <option value="Cash on Delivery">Cash on Delivery (COD)</option>
                    </select>
                </div>

            </div>

            <div class="row mt-3" id="txnno">
                <div class="col-2">Transaction Number</div>
                <div class="col-6"><input type="text" name="txnnumber" id="txnnumber" class="form-control" maxlength="50"></div>
            </div>


            <div class="row mt-3">
                <div class="col-4">&nbsp;</div>
                <div class="col-6"><input type="submit" name="submit" id="submit" class="btn btn-primary" required></div>
            </div>
        </form>
    <?php } ?>

    </div>


    </div>
    </section>
    <!-- Related items section-->
    <section class="py-5 bg-light">
        <div class="container px-4 px-lg-5 mt-5">
            <h2 class="fw-bolder mb-4">Related products</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                $query = mysqli_query($con, "select * from tblrooms where  id!='$rid' limit 4");
                $cnt = 1;
                while ($row = mysqli_fetch_array($query)) { ?>

                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                            <img class="card-img-top" src="admin/roomimages/<?php echo htmlentities($row['roomImage']); ?>" alt="<?php echo htmlentities($row['roomTitle']); ?>" width="350" height="200" />
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder"><?php echo htmlentities($row['roomTitle']); ?></h5>
                                    <!-- Product price-->
                                    <strong>Price Per Day:</strong>
                                    <span>$<?php echo htmlentities($row['roomPpday']); ?></span>
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center"><a class="btn btn-outline-dark mt-auto" href="details.php?rid=<?php echo htmlentities($row['id']); ?>">View options</a></div>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include_once('includes/footer.php'); ?>
    <!-- Bootstrap core JS-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            //alert(maxDate);
            $('#inputdate').attr('min', maxDate);
        });
    </script>

</body>

</html>