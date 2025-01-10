<?php session_start();
error_reporting(0);
include_once('includes/config.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Meeting and Conference Booking System | Contact Us</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/moon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
    <style>
        /* Hero Section */
        .contact-hero {
            background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8)),
                url('/assets/images/contact-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 120px 0;
            position: relative;
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Contact Info Cards */
        .contact-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .contact-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .contact-card {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
            margin-bottom: 30px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.6s forwards;
        }

        .contact-card:hover {
            transform: translateY(-5px);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: #16a085;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .contact-icon i {
            font-size: 24px;
            color: white;
        }

        .contact-info h3 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .contact-info p {
            color: #666;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 0;
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out forwards;
        }

        /* Map Section */
        .map-card {
            animation: fadeIn 0.6s forwards;
        }
    </style>
</head>
<style type="text/css">
    input {
        border: solid 1px #000;

    }
</style>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Header-->
    <header class="bg-primary bg-gradient py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder text-shadow">Get in Touch</h1>
                <p class="lead fw-normal text-white-50 mb-0">We're here to help with your meeting space needs</p>
            </div>
        </div>
    </header>
    <!-- Contact Section -->
    <section class="contact-section py-5">
        <div class="contact-container">
            <div class="row justify-content-center">
                <?php
                $sql = mysqli_query($con, "SELECT tblpage.*, AdminName from tblpage 
                                             left join tbladmin on tbladmin.ID=tblpage.updatedBy 
                                             where PageType='contactus'");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <div class="col-md-4">
                        <div class="contact-card fade-in">
                            <div class="contact-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Visit Us</h3>
                                <p><?php echo htmlentities($row['PageDescription']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-card fade-in">
                            <div class="contact-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Call Us</h3>
                                <p><?php echo htmlentities($row['MobileNumber']); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="contact-card fade-in">
                            <div class="contact-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="contact-info">
                                <h3>Email Us</h3>
                                <p><?php echo htmlentities($row['Email']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <!-- Map Section -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="contact-card map-card fade-in">
                        <div class="ratio ratio-21x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15864.123456789!2d45.345678!3d2.123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1641f1234567890%3A0xabcdef123456789!2sBanadir%20Region%2C%20Somalia!5e0!3m2!1sen!2sus!4v1234567890123"
                                allowfullscreen="" loading="lazy"
                                class="rounded">
                            </iframe>
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