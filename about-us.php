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
    <title>Meeting and Conference Booking System | About Us</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/moon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <!--  <link href="css/bootstrap.min.css" rel="stylesheet" /> -->
    <style>
        /* Modern Hero Section */
        .hero-about {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
                url('assets/images/about-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 150px 0;
            position: relative;
        }

        .hero-about h1 {
            font-size: 3.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            margin-bottom: 1.5rem;
        }

        /* About Content Section */
        .about-section {
            padding: 80px 0;
            background: #f8f9fa;
        }

        .about-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            color: #2c3e50;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 20px;
        }

        .section-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 3px;
            background: #16a085;
        }

        .about-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #555;
        }

        .about-content p {
            margin-bottom: 20px;
        }

        .highlight-box {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin: 30px 0;
            border-left: 4px solid #16a085;
        }

        .updated-info {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9rem;
            color: #666;
        }

        /* Animations */
        .fade-in {
            animation: fadeIn 1s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add these styles to your existing CSS */
        .stat-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            transition: transform 0.3s ease;
        }

        .stat-box:hover {
            transform: translateY(-5px);
        }

        .stat-box h3 {
            color: #fff;
            font-weight: 700;
            margin: 0;
        }

        .stat-box i {
            color: #16a085;
        }

        .hero-about {
            position: relative;
            overflow: hidden;
        }

        .hero-about::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(22, 160, 133, 0.7), rgba(44, 62, 80, 0.7));
        }

        .hero-about .container {
            position: relative;
            z-index: 1;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>

<body>
    <?php include_once('includes/header.php'); ?>
    <!-- Header-->
    <header class="bg-primary bg-gradient py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder text-shadow">Discover Our Story</h1>
                <div class="lead fw-normal text-white-50 mb-4">
                    <p class="mb-3">Where Professional Meetings Come to Life</p>
                    <p class="fs-5 mx-auto" style="max-width: 600px;">
                        We're the leading platform for booking premium meeting spaces and conference rooms.
                        With years of excellence and thousands of successful meetings hosted,
                        we're your trusted partner in professional gatherings.
                    </p>
                </div>
                <div class="mt-4 fade-in">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-3">
                            <div class="stat-box p-3">
                                <i class="bi bi-building fs-3"></i>
                                <h3 class="mt-2">500+</h3>
                                <p class="text-white-50">Premium Venues</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="stat-box p-3">
                                <i class="bi bi-people fs-3"></i>
                                <h3 class="mt-2">10,000+</h3>
                                <p class="text-white-50">Happy Clients</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="stat-box p-3">
                                <i class="bi bi-star fs-3"></i>
                                <h3 class="mt-2">4.9/5</h3>
                                <p class="text-white-50">Client Rating</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Section-->
    <section class="about-section py-5">
        <div class="container">
            <div class="about-container fade-in">
                <?php
                $sql = mysqli_query($con, "SELECT PageTitle, PageDescription, AdminName, LastUpdationDate 
                                             FROM tblpage 
                                             LEFT JOIN tbladmin ON tbladmin.ID=tblpage.updatedBy 
                                             WHERE PageType='aboutus'");
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                    <h2 class="section-title"><?php echo htmlentities($row['PageTitle']); ?></h2>

                    <div class="about-content">
                        <div class="highlight-box">
                            <p><i class="bi bi-quote me-2"></i>
                                Our commitment to excellence drives everything we do
                            </p>
                        </div>

                        <?php echo $row['PageDescription']; ?>

                        <div class="updated-info">
                            <p class="mb-0">
                                <i class="bi bi-pencil-square me-2"></i>
                                Last updated by: <?php echo htmlentities($row['AdminName']); ?>
                                <br>
                                <i class="bi bi-calendar3 me-2"></i>
                                Date: <?php echo htmlentities($row['LastUpdationDate']); ?>
                            </p>
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
</body>

</html>