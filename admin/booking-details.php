<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
//Code For Updation the Enrollment
if(isset($_POST['submit'])){
$roomid=intval($_GET['rid']);
$estatus=$_POST['status'];
$oremark=$_POST['officialremak'];
$bdate=$_POST['bdate'];

$ret=mysqli_query($con,"SELECT id FROM tblbookings where  roomId='$roomid' and bookingDate='$bdate' and boookingStatus='Approved'");
 $count=mysqli_num_rows($ret);
if($count>0){
echo "<script>alert('Room already booked for given Date.);</script>";
} else{
$query=mysqli_query($con,"update tblbookings set adminremark='$oremark',boookingStatus='$estatus'where id='$roomid'");

if($query){
echo "<script>alert('Booking Details Updated   successfully.');</script>";
//echo "<script type='text/javascript'> document.location = 'manage-classes.php'; </script>";
} else {
echo "<script>alert('Something went wrong. Please try again.');</script>";
}
}
}

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meeting and Conference  Booking System  | Booking Details</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Booking Details</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">Booking Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
        

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Booking Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
            
<?php $bid=intval($_GET['rid']);
$query=mysqli_query($con,"select tblrooms.id,tblbookings.bookingNo,tblbookings.bookingDate,tblbookings.postingDate,tblbookings.companyIndivadualName,
billingAddress,billingCity,billingSate,billingZip,billingCountry,
 tblrooms.roomTitle, tblrooms.roomType,tblbookings.id as bookid,boookingStatus,roomCapacity,roomImage,roomPpday,roomDesciption,adminremark,updationDate from tblbookings
join  tblrooms on tblbookings.roomId=tblrooms.id
where   tblbookings.id='$bid' ");
$cnt=1;
while($row=mysqli_fetch_array($query)){
?>

<div class="row">
<div class="col-5">
    <table class="table table-bordered" border="1">
<tr>
    <th>Booking  Number</th>
    <td><?php echo htmlentities($row['bookingNo']);?></td>
</tr>
<tr>
    <th>Booking Date</th>
    <td><?php echo htmlentities($bdate=$row['bookingDate']);?></td>
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
    <td><img  src="roomimages/<?php echo htmlentities($row['roomImage']);?>" alt="<?php echo htmlentities($row['roomTitle']);?>" width="400" height="200"  style="border:solid 1px #000;"/>
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


<?php if($row['boookingStatus']==''):?>
<tr>
  <td colspan="4" style="text-align:center;">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Take Action</button>
</td>
</tr>
<?php endif;?>

    </table>
</div>

</div>



         <?php $cnt++;} ?>
             
                  </tbody>
     
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>


</div>
<!-- ./wrapper -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Booking Satus</h4>
      </div>
      <div class="modal-body">
        <form name="takeaction" method="post">
<input type="hidden" value="<?php echo $bdate?>" name="bdate">
          <p><select class="form-control" name="status" id="status" required>
            <option value="">Select Booking Status</option>
            <option value="Approved">Approved</option>
            <option value="Canceled ">Canceled </option>
          </select></p>


    


        <p><textarea class="form-control" name="officialremak" placeholder="Official Remark" rows="5" required></textarea></p>
        <input type="submit" class="btn btn-primary" name="submit" value="update">

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>






<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">

  //For report file
  $('#rtable').hide();
  $(document).ready(function(){
  $('#status').change(function(){
  if($('#status').val()=='Accepted')
  {
  $('#rtable').show();
  jQuery("#table").prop('required',true);  
  }
  else{
  $('#rtable').hide();
  }
})}) 
</script>
</body>
</html>
<?php } ?>