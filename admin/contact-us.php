<?php session_start();
//error_reporting(0);
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{
    if(isset($_POST['submit']))
{

$pagetitle=$_POST['pagetitle'];
$pagedes=$_POST['pagedes'];
$updatedby=$_SESSION['aid'];
$mobnum=$_POST['mobnum'];
$email=$_POST['email'];
$sql=mysqli_query($con,"update tblpage set PageTitle='$pagetitle',PageDescription='$pagedes',Email='$email',MobileNumber='$mobnum',updatedBy='$updatedby' where  PageType='contactus'");
echo '<script>alert("About us has been updated")</script>';


  }

  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meeting and Conference  Booking System | About Us</title>

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
            <h1>About Us</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
              <li class="breadcrumb-item active">About Us</li>
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
                <h3 class="card-title">About us Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                     <form method="post">
                                                   <?php

$sql=mysqli_query($con,"SELECT PageTitle,PageDescription,AdminName,tblpage.Email,tblpage.MobileNumber from  tblpage
left join tbladmin on tbladmin.ID=tblpage.updatedBy where PageType='contactus'");
while($row=mysqli_fetch_array($sql))
{              ?>
                         <fieldset>
                            
                           <div class="field">
                              <label class="label_field">Page Title</label>
                              <input type="text" name="pagetitle" value="<?php  echo $row['PageTitle'];?>" class="form-control" required='true'>
                           </div>
                           <br>
                            <div class="field">
                              <label class="label_field">Page Description</label>
                              <textarea type="text" name="pagedes" class="form-control" required='true'><?php  echo $row['PageDescription'];?></textarea>
                           </div>
                            <br>
                            <div class="field">
                              <label class="label_field">Email</label>
                              <input type="text" name="email" id="email" required="true" value="<?php  echo $row['Email'];?>" class="form-control">
                           </div>
                           <br>
                            <div class="field">
                              <label class="label_field">Mobile Number</label>
                              <input type="text" name="mobnum" id="mobnum" required="true" value="<?php  echo $row['MobileNumber'];?>" class="form-control" maxlength="10" pattern="[0-9]+">
                           </div>

                           <br>
    <div class="field">
                              <label class="label_field">Last Updated by</label>
                              <input type="text" name="admin page" value="<?php  echo $row['AdminName'];?>" class="form-control" readonly>
                           </div>
                           <br>
               

                           <br>
                           <div class="field margin_0">
                         <button class="btn btn-info" type="submit" name="submit" id="submit">Update</button>
                           </div>
                        </fieldset>
                      <?php } ?>
                     </form>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
</body>
</html>
<?php } ?>