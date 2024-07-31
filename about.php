<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>
        TaskManagement - About Us
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet">
    <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet">

    <link href="assets/css/bootstrap-dark-yellow.min.css" id="bootstrap-style" class="theme-opt" rel="stylesheet"
        type="text/css">

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css" type="text/css"
        rel="stylesheet" />

    <link href="assets/css/style-dark-yellow.min.css" id="color-opt" class="theme-opt" rel="stylesheet" type="text/css">
</head>

<body>



    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <a class="logo" href="index.php">
                <img src="assets/images/logo-dark.png" class="logo-light-mode" height="24" alt="">
                <img src="assets/images/logo-light.png" height="24" class="logo-dark-mode" alt="">
            </a>

            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <!--Login button Start-->
            <ul class="buy-button list-inline mb-0">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="list-inline-item mb-0">
                        <a href="./public/main/index.php" class="btn btn-sm btn-soft-primary text-uppercase">Dashboard</a>
                    </li>
                <?php else: ?>
                    <li class="list-inline-item mb-0">
                        <a href="./public/main/login.php" class="btn btn-sm btn-soft-primary text-uppercase">Login</a>
                    </li>
                <?php endif; ?>
            </ul>

            <div id="navigation">

                <ul class="navigation-menu nav-right">
                    <li><a href="index.php" class="sub-menu-item">Home</a></li>
                    <li><a href="about.php" class="sub-menu-item">About Us </a></li>
                    </li>
                </ul>
                </li>
                </ul>
                </li>

                </ul>
            </div>
        </div>
    </header>
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 col-md-5 mt-4 pt-2 mt-sm-0 pt-sm-0">
                    <div class="position-relative p-4 bg-soft-primary rounded shadow">
                        <img src="assets/images/ai/about.jpg" class="rounded img-fluid mx-auto d-block" alt="">
                    </div>
                </div><!--end col-->

                <div class="col-lg-7 col-md-7 mt-4 pt-2 mt-sm-0 pt-sm-0">
                    <div class="section-title ms-lg-4">
                        <h4 class="title mb-4">What is Task Management? <br> </h4>
                        <p class="text-muted">In general, task management is the activity or process of identifying,
                            planning, visualizing, monitoring and evaluating work within a period of time.

                            Usually, when carrying out these activities, you will first identify which work is important
                            and immediate.

                            After identifying priorities, the next step is to plan whether the work will be done alone,
                            delegated, or postponed.

                            After planning, visualizing and working on it. Each job is monitored to what extent the work
                            has been done or how far the progress of the work is.</p>

                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->

</body>

</html>