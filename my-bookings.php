<?php session_start();
include_once('includes/config.php');
if(strlen($_SESSION['id'])==0)
{   header('location:logout.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Meeting and Conference  Booking System | My Bookings</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/moon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
       <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
         <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
    </head>
<style type="text/css"></style>
    <body>
<?php include_once('includes/header.php');?>
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">


                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">My Booking Details</h1>
                </div>

            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4  mt-5">
     

    <div class="table-responsive">
        <table class="table" border="1">
            <thead>
                <tr>
                    <th colspan="4"><h4>My Bookings</h4></th>
                </tr>
            </thead>
            <tr>
                <thead>
                    <th>#</th>
                    <th>Booking Number </th>
                    <th>Room Type</th>
                    <th>Room Title</th>
                    <th>Booking For</th>
                    <th>Booking Date</th>
                    <th>Booking Status</th>
                    <th> Booking at</th>
                    <th>Action</th>
                </thead>
            </tr>
            <tbody>
<?php
$uid=$_SESSION['id'];
$ret=mysqli_query($con,"select tblrooms.id,tblbookings.bookingNo,tblbookings.bookingDate,tblbookings.postingDate,tblbookings.companyIndivadualName, tblrooms.roomTitle, tblrooms.roomType,tblbookings.id as bookid,boookingStatus from tblbookings
join  tblrooms on tblbookings.roomId=tblrooms.id

    where  tblbookings.userId='$uid'");
$num=mysqli_num_rows($ret);
$cnt=1;
    if($num>0)
    {
while ($row=mysqli_fetch_array($ret)) {

?>

                <tr>
                    <td><?php echo htmlentities($cnt);?></td>
                    <td><?php echo htmlentities($row['bookingNo']);?></td>
                    <td><?php echo htmlentities($row['roomType']);?></td>
                    <td><?php echo htmlentities($row['roomTitle']);?></td>
                    <td><?php echo htmlentities($row['companyIndivadualName']);?></td>
                    <td><?php echo htmlentities($row['bookingDate']);?></td>
                    <td><?php $bstatus=$row['boookingStatus'];
                         if($bstatus==''): ?>
                      <span class="badge badge-warning">Not Proccessed Yet</span>
                    <?php elseif($bstatus=='Approved'): ?>
                      <span class="badge badge-success">Approved</span>
                        <?php elseif($bstatus=='Canceled '): ?>
    <span class="badge badge-danger">Canceled</span>
                        <?php endif;?>
                    </td>
                    <td><?php echo htmlentities($row['postingDate']);?></td>
                    <td><a href="booking-details.php?bid=<?php echo htmlentities($row['bookid']);?>&&bookingno=<?php echo htmlentities($row['bookingNo']);?>" class="btn-upper btn btn-primary">Details</a></td>
                
                </tr>
            
                <?php $cnt++;}  } else{ ?>
                <tr>
                    <td style="font-size: 18px; font-weight:bold ">No Booking Yet.&nbsp;
                    </td>

                </tr>
                <?php } ?>
            </tbody>
        </table>
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
        <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
    </body>
</html>
<?php } ?>
