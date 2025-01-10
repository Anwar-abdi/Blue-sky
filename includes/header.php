        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Blue - Sky</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>

                        <li class="nav-item"><a class="nav-link" href="rooms.php">Meeting and Conference Rooms</a></li>

                        <li class="nav-item"><a class="nav-link" href="about-us.php">About Us</a></li>

                        <li class="nav-item"><a class="nav-link" href="contact-us.php">Contat Us</a></li>
                        <?php if ($_SESSION['id'] == 0) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Users</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="login.php">Login</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="signup.php">Sign Up</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="admin/">Admin</a></li>
                        <?php } else { ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">My Account</a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="my-bookings.php">Bookings</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="my-profile.php">Profile</a></li>
                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="change-password.php">Change Password</a></li>

                                    <li>
                                        <hr class="dropdown-divider" />
                                    </li>
                                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php } ?>

                    </ul>
                    <?php if ($_SESSION['id'] != 0): ?>
                        <strong>Welcome:</strong> &nbsp;<?php echo $_SESSION['username']; ?> &nbsp;
                    <?php endif; ?>


                </div>
            </div>
        </nav>