<?php session_start();
error_reporting(0);
include_once('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="Book meeting rooms and conference facilities online" />
    <meta name="author" content="" />
    <title>Meeting and Conference Booking System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/moon.png" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS -->
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <!-- Add custom CSS -->
    <style>
        .hero-section {
            background: linear-gradient(rgba(4, 100, 244, 0.38), rgba(4, 43, 239, 0.95)), url('assets/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            padding: 100px 0;
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

        .room-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            opacity: 0;
            transform: translateY(20px);
            animation: slideIn 0.5s forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .room-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .room-title {
            color: #2c3e50;
            font-weight: 600;
        }

        .room-price {
            color: #16a085;
            font-weight: 500;
        }

        .view-btn {
            background-color: #2c3e50;
            color: white;
            transition: all 0.3s ease;
        }

        .view-btn:hover {
            background-color: #34495e;
            color: white;
            transform: scale(1.05);
        }

        .pagination .page-link {
            color: #2c3e50;
        }

        .pagination .active .page-link {
            background-color: #2c3e50;
            border-color: #2c3e50;
        }

        .cta-button {
            background-color: #16a085;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.2rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .cta-button:hover {
            background-color: #149174;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <?php include_once('includes/header.php'); ?>

    <!-- Hero Section -->
    <header class="hero-section py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder text-shadow">Meeting and Conference Booking System</h1>
                <p class="lead fw-normal text-white-50 mb-4">Find and book the perfect space for your next meeting or conference</p>
                <a href="#rooms" class="cta-button btn btn-lg">View Available Rooms</a>
            </div>
        </div>
    </header>

    <!-- Rooms Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Available Rooms</h2>
            <div class="row gx-4 gx-lg-5 row-cols-1 row-cols-md-2 row-cols-xl-3 justify-content-center">
                <?php

                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }

                $total_records_per_page = 12;
                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $result_count = mysqli_query($con, "SELECT COUNT(*) As total_records FROM tblrooms ");
                $total_records = mysqli_fetch_array($result_count);
                $total_records = $total_records['total_records'];
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total page minus 1

                $query = mysqli_query($con, "select * from tblrooms order by id desc LIMIT $offset, $total_records_per_page ");
                while ($row = mysqli_fetch_array($query)) {
                ?>
                    <div class="col mb-5">
                        <div class="card h-100 room-card">
                            <img class="card-img-top" src="admin/roomimages/<?php echo htmlentities($row['roomImage']); ?>" alt="<?php echo htmlentities($row['roomTitle']); ?>" />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="room-title mb-3"><?php echo htmlentities($row['roomTitle']); ?></h5>
                                    <p class="room-price mb-3">$<?php echo htmlentities($row['roomPpday']); ?> per day</p>
                                    <a class="btn view-btn" href="details.php?rid=<?php echo htmlentities($row['id']); ?>">
                                        <i class="bi bi-info-circle me-2"></i>View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Pagination -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mt-4">
                            <li <?php if ($page_no <= 1) {
                                    echo "class='page-item disabled'";
                                } ?>>
                                <a <?php if ($page_no > 1) {
                                        echo "href='?page_no=$previous_page'";
                                    } ?> class="page-link">Previous</a>
                            </li>
                            <?php
                            if ($total_no_of_pages <= 10) {
                                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='page-link active'><a>$counter</a></li>";
                                    } else {
                                        echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                    }
                                }
                            } elseif ($total_no_of_pages > 10)

                                if ($page_no <= 4) {
                                    for ($counter = 1; $counter < 8; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter'> $counter</a></li>";
                                        }
                                    }
                                    echo "<li><a>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                                } elseif ($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                    echo "<li><a href='?page_no=1'>1</a></li>";
                                    echo "<li><a href='?page_no=2'>2</a></li>";
                                    echo "<li><a>...</a></li>";
                                    for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter' class='page-link'>$counter</a></li>";
                                        }
                                    }
                                    echo "<li><a>...</a></li>";
                                    echo "<li><a href='?page_no=$second_last' class='page-link'>$second_last</a></li>";
                                    echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>$total_no_of_pages</a></li>";
                                } else {
                                    echo "<li><a href='?page_no=1' class='page-link'>1</a></li>";
                                    echo "<li><a href='?page_no=2' class='page-link'>2</a></li>";
                                    echo "<li><a>...</a></li>";

                                    for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                        if ($counter == $page_no) {
                                            echo "<li class='active'><a>$counter</a></li>";
                                        } else {
                                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                        }
                                    }
                                }
                            ?>
                            <li <?php if ($page_no >= $total_no_of_pages) {
                                    echo "class='page-item disabled'";
                                } ?>>
                                <a <?php if ($page_no < $total_no_of_pages) {
                                        echo "href='?page_no=$next_page'";
                                    } ?> class="page-link">Next</a>
                            </li>
                            <?php if ($page_no < $total_no_of_pages) {
                                echo "<li><a href='?page_no=$total_no_of_pages' class='page-link'>Last &rsaquo;&rsaquo;</a></li>";
                            } ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <?php include_once('includes/footer.php'); ?>

    <!-- Bootstrap core JS-->
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>