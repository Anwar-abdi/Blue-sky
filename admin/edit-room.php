<?php session_start();
// Database Connection
include('includes/config.php');
//Validating Session
if(strlen($_SESSION['aid'])==0)
  { 
header('location:index.php');
}
else{


if(isset($_POST['update']))
{
 $rtitle=$_POST['roomtitle'];
$capacity=$_POST['capacity'];
$description=$_POST['description'];
$ppday=$_POST['ppday'];
$rtype=$_POST['rtype'];
echo $rimage=$_FILES["roomimage"]["name"];

if($rimage==''):
$imgfile=$_POST['oldrimage'];
else:
$imgfile=$_FILES["roomimage"]["name"];
endif;
// exit();
$roomid=intval($_GET['rid']);

// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
//rename the image file

// Code for move image into directory
if($rimage!=''):
  $imgnewfile=md5($imgfile).$extension;
move_uploaded_file($_FILES["roomimage"]["tmp_name"],"roomimages/".$imgnewfile);
else:
$imgnewfile=$imgfile;
endif;
// Query for insertion data into database
$query=mysqli_query($con,"update tblrooms set roomTitle='$rtitle',roomCapacity='$capacity',roomDesciption='$description',roomPpday='$ppday',roomType='$rtype',roomImage='$imgnewfile' where id='$roomid' ");
if($query)
{
echo "<script>alert('Data inserted successfully');</script>";
echo "<script>window.location = 'manage-rooms.php';</script>"; 
}
else
{
echo "<script>alert('Data not inserted');</script>";
}}
}


  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Meeting and Conference  Booking System | Edit Room</title>

  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php include_once("includes/navbar.php");?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 <?php include_once("includes/sidebar.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Room</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Room</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit/Update Room Details</h3>
              </div>
              <!-- /.card-header -->

<?php $roomid=intval($_GET['rid']);
$query=mysqli_query($con,"select * from tblrooms where id='$roomid'");
$cnt=1;
while($result=mysqli_fetch_array($query)){
?>

              <!-- form start -->
              <form name="addroom" method="post" enctype="multipart/form-data">
                <div class="card-body">

<!--  Table No--->
   <div class="form-group">
                    <label for="exampleInputFullname">Title</label>
                    <input type="text" class="form-control" id="roomtitle" name="roomtitle" value="<?php echo $result['roomTitle']?>" placeholder="Enter the title" required>
                  </div>


   <div class="form-group">
                    <label for="exampleInputFullname">Capacity</label>
                    <input type="text" class="form-control" id="capacity" name="capacity" value="<?php echo $result['roomCapacity']?>" placeholder="Enter the cpacity" required>
                  </div>

  <div class="form-group">
                    <label for="exampleInputFullname">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Room Description" rows="8" required><?php echo $result['roomDesciption']?></textarea>
                  </div>
   <div class="form-group">
                    <label for="exampleInputFullname">Price Per Day</label>
                    <input type="text" class="form-control" id="ppday" value="<?php echo $result['roomPpday']?>" name="ppday" placeholder="Enter the Price per Day" required>
                  </div>


   <div class="form-group">
                    <label for="exampleInputFullname">Type</label>
                 <select class="form-control" name="rtype" required>
                   <option value="<?php echo $result['roomType']?>"><?php echo $result['roomType']?></option>
                   <option value="Confrence">Confrence</option>
                   <option value="Theatre">Theatre</option>
                   <option value="Banquet">Banquet</option>
                   <option value="U Shape">U Shape</option>
                   <option value="Round Table">Round Table</option>
                   <option value="Hall">Hall</option>
                 </select>
                  </div>


   <div class="form-group">
         <label for="exampleInputFullname"> Room  Image</label>
         <input type="hidden" value="<?php echo $result['roomImage']?>" name="oldrimage">
    <img src="roomimages/<?php echo $result['roomImage']?>" width="250"><br /><br />
               
                    <input type="file" class="form-control" id="roomimage" name="roomimage">
                  </div>

  <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="update" id="update">Update</button>
                </div>
      
                </div>
                <!-- /.card-body -->
          
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->








    
              </form>
       <?php } ?>
  
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include_once('includes/footer.php');?>

</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- Page specific script -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
});
</script>
</body>
</html>
<?php } ?>
