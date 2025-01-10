<?php session_start();
error_reporting(0);
include_once('includes/config.php');
if(strlen($_SESSION['id'])==0)

  { 
    header('location:logout.php');
 }
else{

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Meeting and Conference  Booking System | Booking Details</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/moon.png" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <script src="js/jquery.min.js"></script>
               <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
       <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
        <script language="javascript" type="text/javascript">
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height)
{
 if(popUpWin)
{
if(!popUpWin.closed) popUpWin.close();
}
popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}

</script>

    </head>
<style type="text/css"></style>
    <body>
<?php include_once('includes/header.php');?>    
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">


                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">#<?php echo intval($_GET['bookingno']);?> Booking Details</h1>
                </div>

            </div>
        </header>
        <!-- Section-->
        <section class="py-5">
            <div class="container px-4  mt-5">
<h5>Booking Details</h5>
<hr />
     <?php
$uid=$_SESSION['id'];
$bookid=intval($_GET['bid']);
$ret=mysqli_query($con,"select tblrooms.id,tblbookings.bookingNo,tblbookings.bookingDate,tblbookings.postingDate,tblbookings.companyIndivadualName,
billingAddress,billingCity,billingSate,billingZip,billingCountry,
 tblrooms.roomTitle, tblrooms.roomType,tblbookings.id as bookid,boookingStatus,roomCapacity,roomImage,roomPpday,roomDesciption,adminremark,updationDate
  from tblbookings
join  tblrooms on tblbookings.roomId=tblrooms.id
where  tblbookings.userId='$uid' and tblbookings.id='$bookid' ");
while ($row=mysqli_fetch_array($ret)) {?>
<div class="row">
<div class="col-5">
    <table class="table table-bordered" border="1">
<tr>
    <th>Booking  Number</th>
    <td><?php echo htmlentities($row['bookingNo']);?></td>
</tr>
<tr>
    <th>Booking Date</th>
    <td><?php echo htmlentities($row['bookingDate']);?></td>
</tr>
<tr>
    <th>Booked for</th>
    <td><?php echo htmlentities($row['companyIndivadualName']);?></td>
</tr>
<tr>
    <th>Billing Address</th>
    <td><?php echo htmlentities($row['billingAddress']);?></td>
</tr>
<tr>
    <th>Billing City</th>
    <td><?php echo htmlentities($row['billingCity']);?></td>
</tr>

<tr>
    <th>Billing State</th>
    <td><?php echo htmlentities($row['billingSate']);?></td>
</tr>

<tr>
    <th>Billing ZipCode/Pincode</th>
    <td><?php echo htmlentities($row['billingZip']);?></td>
</tr>

<tr>
    <th>Billing Country</th>
    <td><?php echo htmlentities($row['billingCountry']);?></td>
</tr>

<tr>
    <th>Booking at</th>
    <td><?php echo htmlentities($row['postingDate']);?></td>
</tr>

<tr>
    <th>Status</th>
      <td><?php $bstatus=$row['boookingStatus'];
                         if($bstatus==''): ?>
                      <span class="badge badge-warning">Not Proccessed Yet</span>
                    <?php elseif($bstatus=='Approved'): ?>
                      <span class="badge badge-success">Approved</span>
                        <?php elseif($bstatus=='Canceled '): ?>
    <span class="badge badge-danger">Canceled</span>
                        <?php endif;?>
                    </td>
                        </td></tr>
<tr>
    <th>Admin Remark</th>
    <td><?php if($row['adminremark']==''):
    echo "Not update yet";
else:
echo htmlentities($row['adminremark']);
endif;?></td>
</tr>

<tr>
    <th>Last Updation Date</th>
    <td><?php if($row['updationDate']==''):
    echo "Not update yet";
else:
echo htmlentities($row['updationDate']);
endif;?></td>
</tr>


    </table>
</div>
<div class="col-7">
    <table class="table table-bordered" border="1">
<tr>
    <th>Room Title / Type</th>
    <td><img  src="admin/roomimages/<?php echo htmlentities($row['roomImage']);?>" alt="<?php echo htmlentities($row['roomTitle']);?>" width="400" height="200"  style="border:solid 1px #000;"/>
        <br /><?php echo htmlentities($row['roomTitle']);?> (<?php echo htmlentities($row['roomType']);?>)</td>
</tr>
<tr>
    <th>Room Capacity </th>
    <td><?php echo htmlentities($row['roomCapacity']);?></td>
</tr>

<tr>
    <th>Room Pric Per Day </th>
    <td>$<?php echo htmlentities($row['roomPpday']);?></td>
</tr>

<tr>
    <th>Room Description</th>
    <td><?php echo htmlentities($row['roomDesciption']);?></td>
</tr>
<!-- 
<tr><td colspan="2"><a href="javascript:void(0);" onClick="popUpWindow('cancelorder.php?oid=<?php echo $row['orderid'];?>');" title="Cancel Order" class="btn-upper btn btn-danger">Canel this Booking
</a></td></tr> -->
    </table>
</div>

</div>
<?php } ?>
    
              
            </div>

 
</div>
        </section>
        <!-- Track Order Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <!-- Footer-->
   <?php include_once('includes/footer.php'); ?>
        <!-- Bootstrap core JS-->
        <script src="js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>


</html>
<?php } ?>
