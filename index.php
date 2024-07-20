<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <title>
        TaskManagement - Project Task Management
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link href="assets/libs/tiny-slider/tiny-slider.css" rel="stylesheet" />
    <link href="assets/libs/tobii/css/tobii.min.css" rel="stylesheet" />
    <link href="assets/css/bootstrap-dark-yellow.min.css" id="bootstrap-style" class="theme-opt" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/@iconscout/unicons@4.0.8/css/line.min.css" type="text/css"
        rel="stylesheet" />
    <link href="assets/css/style-dark-yellow.min.css" id="color-opt" class="theme-opt" rel="stylesheet"
        type="text/css" />
</head>

<body>
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <a class="logo" href="index.php">
                <img src="assets/images/logo-dark.png" class="logo-light-mode" height="24" alt="" />
                <img src="assets/images/logo-light.png" height="24" class="logo-dark-mode" alt="" />
            </a>
            <div class="menu-extras">
                <div class="menu-item">
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                </div>
            </div>
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

                    <li><a href="about.php" class="sub-menu-item">About us</a></li>
                </ul>
            </div>
        </div>
    </header>
    <section class="bg-half-170 d-table w-100 overflow-hidden">
        <div class="container">
            <div class="row align-items-center pt-5">
                <div class="col-lg-7 col-md-6">
                    <div class="title-heading">
                        <h1 class="heading fw-bold mb-4">
                            Project Task Management <br /><span class="text-primary typewrite" data-period="2000"
                                data-type='[ "Study", "Teams Collaborate", "Track Progress" ]'>
                                <span class="wrap"></span>
                            </span>
                        </h1>
                        <p class="para-desc text-muted">
                            TaskManagement makes managing projects and tasks easy with a
                            modern interface and comprehensive features. Keep track of all
                            your projects, organize tasks, and organize todo lists easily in
                            one place. Powered by MDB5 for an elegant and responsive design,
                            TaskManagement increases your productivity.
                        </p>
                        <div class="mt-4 pt-2">
                            <a href="./public/main/login.php" class="btn btn-primary">Try Now </a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
                    <div class="ai-hero position-relative">
                        <div class="image position-relative">
                            <img src="assets/images/laptop.png" class="mx-auto d-block" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">So, how does it works?</h4>
                        <p class="text-muted para-desc mx-auto mb-0">
                            Start working with
                            <span class="text-primary fw-bold">Task Management</span> that
                            can provide everything you need to generate awareness, drive
                            traffic, connect.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mt-4 pt-2">
                    <div class="card border-0 features feature-primary feature-clean p-4">
                        <div class="icons">
                            <i class="mdi mdi-account-search-outline rounded-pill h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Create Project</h5>
                            <p class="text-muted mb-0">
                                Here, you have the freedom to develop your project as you like
                                and as creatively as possible.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4 pt-2">
                    <div class="card border-0 features feature-primary feature-clean p-4">
                        <div class="icons">
                            <i class="mdi mdi-wallet-bifold-outline rounded-pill h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Invite People</h5>
                            <p class="text-muted mb-0">
                                Inviting friends and family to do something together is a fun
                                way to strengthen relationships and create happy memories.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mt-4 pt-2">
                    <div class="card border-0 features feature-primary feature-clean p-4">
                        <div class="icons">
                            <i class="mdi mdi-home-plus-outline rounded-pill h3 mb-0"></i>
                        </div>
                        <div class="content mt-4">
                            <h5 class="fw-bold">Create To Do List</h5>
                            <p class="text-muted mb-0">
                                The simplest and most common task management method used by
                                many people.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title mb-4 pb-2">
                        <h4 class="title mb-4">The future of Task Management.</h4>
                        <p class="text-muted para-desc mx-auto mb-0">
                            Start working with
                            <span class="text-primary fw-bold">TaskManagement</span> that
                            provides everything you need to manage tasks, boost
                            productivity, and achieve your goals.
                        </p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

            <div class="row">
                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-pen rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Task Creator</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Easily create and assign tasks to team members with detailed
                                descriptions and deadlines.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-airplay rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Advanced Dashboard</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Get an overview of all projects and tasks with our
                                comprehensive dashboard.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-credit-card rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Time Tracking</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Track the time spent on each task to improve productivity and
                                manage deadlines.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-globe rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Collaboration Tools</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Collaborate with your team in real-time with comments and file
                                sharing.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-window-grid rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Custom Templates</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Use custom templates to streamline the creation of recurring
                                tasks and projects.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-4 col-md-6 col-12 mt-4 pt-2">
                    <div class="d-flex features feature-primary feature-clean">
                        <div class="icons text-center mx-auto">
                            <i class="uil uil-life-ring rounded h3 mb-0"></i>
                        </div>
                        <div class="content ms-4 me-md-4">
                            <h5 class="mb-1">
                                <a href="javascript:void(0)" class="text-dark">Support Platform</a>
                            </h5>
                            <p class="text-muted mb-0">
                                Access our support platform for help and guidance on managing
                                your tasks effectively.
                            </p>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="bg-soft-primary ps-4 pt-4 position-relative overflow-hidden rounded shadow">
                        <img src="assets/images/saas/classic02.png" class="img-fluid" alt="" />
                    </div>
                </div>
                <!--end col-->

                <div class="col-lg-6 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title ms-lg-5">
                        <h4 class="title mb-4">
                            Manage Projects, <br />
                            Tasks, & Teams
                        </h4>
                        <p class="text-muted">
                            Efficiently organize your projects and tasks, streamline
                            workflows, and enhance team collaboration with our robust task
                            management system.
                        </p>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Organize tasks with ease
                            </li>
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Collaborate with your team
                                in real-time
                            </li>
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Track progress and meet
                                deadlines
                            </li>
                        </ul>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 order-2 order-md-1 mt-4 mt-sm-0 pt-2 pt-sm-0">
                    <div class="section-title me-lg-5">
                        <h4 class="title mb-4">
                            Streamline Your Workflow <br />
                            with Task Automation
                        </h4>
                        <p class="text-muted">
                            Automate repetitive tasks, set reminders, and ensure that no
                            deadlines are missed with our advanced task management features.
                        </p>
                        <ul class="list-unstyled text-muted mb-0">
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Automate task assignments
                            </li>
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Set reminders and
                                notifications
                            </li>
                            <li class="mb-1">
                                <span class="text-primary h5 me-2"><i
                                        class="uil uil-check-circle align-middle"></i></span>Integrate with your
                                favorite tools
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-6 col-md-6 order-1 order-md-2">
                    <div class="bg-soft-primary pe-4 pt-4 position-relative overflow-hidden rounded shadow">
                        <img src="assets/images/saas/classic03.png" class="img-fluid" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="container mt-100 mt-60">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="section-title text-center mb-4 pb-2">
                        <h4 class="title mb-4">What Our Users Say</h4>
                        <p class="text-muted para-desc mb-0 mx-auto">
                            Start working with
                            <span class="text-primary fw-bold">TaskManagement</span> that
                            can provide everything you need to generate awareness, drive
                            traffic, connect.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12 mt-4">
                    <div class="tiny-three-item">
                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/01.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 1" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "Using this task management system has drastically improved our team’s
                                        productivity. The automation features are a game-changer."
                                    </p>
                                    <h6 class="text-primary">
                                        - Thomas Israel <small class="text-muted">C.E.O</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/02.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 2" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star-half text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "The reminder and notification system ensures we never miss a deadline. It's an
                                        essential tool for our daily operations."
                                    </p>
                                    <h6 class="text-primary">
                                        - Barbara McIntosh <small class="text-muted">M.D</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/03.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 3" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "Integration with our existing tools was seamless and added a lot of value to
                                        our project management processes."
                                    </p>
                                    <h6 class="text-primary">
                                        - Carl Oliver <small class="text-muted">P.A</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/04.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 4" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "This platform has made task delegation and follow-up so much easier. Our
                                        workflow is now more organized."
                                    </p>
                                    <h6 class="text-primary">
                                        - Christa Smith <small class="text-muted">Manager</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/05.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 5" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "Having everything in one place has significantly improved our team's efficiency
                                        and communication."
                                    </p>
                                    <h6 class="text-primary">
                                        - Dean Tolle <small class="text-muted">Developer</small>
                                    </h6>
                                </div>
                            </div>
                        </div>

                        <div class="tiny-slide">
                            <div class="d-flex client-testi m-1">
                                <img src="assets/images/client/06.jpg"
                                    class="avatar avatar-small client-image rounded shadow" alt="Client 6" />
                                <div class="card flex-1 content p-3 shadow rounded position-relative">
                                    <ul class="list-unstyled mb-0">
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="mdi mdi-star text-warning"></i>
                                        </li>
                                    </ul>
                                    <p class="text-muted mt-2">
                                        "The task automation features have saved us so much time. We can now focus on
                                        more critical aspects of our projects."
                                    </p>
                                    <h6 class="text-primary">
                                        - Jill Webb <small class="text-muted">Designer</small>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--end col-->
        </div>
        <!--end row-->
        </div>
        <!--end container-->

        <div class="container mt-100 mt-60">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="section-title">
                        <h4 class="title mb-4">Let's Try App Now !</h4>
                        <p class="text-muted para-desc mx-auto">
                            Start working with
                            <span class="text-primary fw-bold">Task Management</span> that
                            can provide everything you need to generate awareness, drive
                            traffic, connect.
                        </p>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->

    <!-- Footer Start -->
    <footer class="footer" style="
        background-image: url('assets/images/svg-map.svg');
        background-repeat: no-repeat;
        background-position: center;
      ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 py-lg-5">
                    <div class="footer-py-60 text-center">
                        <a href="#" class="logo-footer">
                            <img src="assets/images/logo-light.png" height="32" alt="" />
                        </a>
                        <p class="mt-4 para-desc mx-auto">
                            Start working with TaskManagement that can provide everything
                            you need to generate awareness, drive traffic, connect.
                        </p>
                        <ul class="list-unstyled social-icon foot-social-icon mb-0 mt-4">
                            <li class="list-inline-item mb-0">
                                <a href="mailto:admin@taskm.com" class="rounded"><i
                                        class="uil uil-envelope align-middle" title="email"></i></a>
                            </li>
                        </ul>
                        <!--end icon-->
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->

        <div class="footer-py-30 footer-bar bg-footer">
            <div class="container text-center">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="text-center">
                            <p class="mb-0">
                                ©
                                <script>
                                    document.write(new Date().getFullYear());
                                </script>
                                . Design with
                                <i class="mdi mdi-heart text-danger"></i> by
                                <a href="#" target="_blank" class="text-reset">Kelompok Farel, Fahreza, Puke</a>.
                            </p>
                        </div>
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->
            </div>
            <!--end container-->
        </div>
    </footer>
    <!--end footer-->
    <!-- Footer End -->

    <!-- Offcanvas Start -->
    <div class="offcanvas offcanvas-end shadow border-0" tabindex="-1" id="offcanvasRight"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header p-4 border-bottom">
            <h5 id="offcanvasRightLabel" class="mb-0">
                <img src="assets/images/logo-dark.png" height="24" class="light-version" alt="" />
                <img src="assets/images/logo-light.png" height="24" class="dark-version" alt="" />
            </h5>
            <button type="button" class="btn-close d-flex align-items-center text-dark" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="uil uil-times fs-4"></i>
            </button>
        </div>
        <div class="offcanvas-body p-4">
            <div class="row">
                <div class="col-12">
                    <img src="assets/images/contact.svg" class="img-fluid d-block mx-auto" alt="" />
                    <div class="card border-0 mt-4" style="z-index: 1">
                        <div class="card-body p-0">
                            <h4 class="card-title text-center">Login</h4>
                            <form class="login-form mt-4">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Your Email <span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="user" class="fea icon-sm icons"></i>
                                                <input type="email" class="form-control ps-5" placeholder="Email"
                                                    name="email" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <div class="form-icon position-relative">
                                                <i data-feather="key" class="fea icon-sm icons"></i>
                                                <input type="password" class="form-control ps-5" placeholder="Password"
                                                    required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value=""
                                                        id="flexCheckDefault" />
                                                    <label class="form-check-label" for="flexCheckDefault">Remember
                                                        me</label>
                                                </div>
                                            </div>
                                            <p class="forgot-pass mb-0">
                                                <a href="auth-cover-re-password.html" class="text-dark fw-bold">Forgot
                                                    password ?</a>
                                            </p>
                                        </div>
                                    </div>
                                    <!--end col-->

                                    <div class="col-lg-12 mb-0">
                                        <div class="d-grid">
                                            <button class="btn btn-primary">Sign in</button>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <p class="mb-0 mt-3">
                                            <small class="text-dark me-2">Don't have an account ?</small>
                                            <a href="auth-cover-signup.html" class="text-dark fw-bold">Sign Up</a>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offcanvas End -->
    <!-- Switcher Start -->
    <a href="javascript:void(0)" class="card switcher-btn shadow-md text-primary z-index-1 d-md-inline-flex d-none"
        data-bs-toggle="offcanvas" data-bs-target="#switcher-sidebar">
        <i class="mdi mdi-cog mdi-24px mdi-spin align-middle"></i>
    </a>

    <div class="offcanvas offcanvas-start shadow border-0" tabindex="-1" id="switcher-sidebar"
        aria-labelledby="offcanvasLeftLabel">
        <div class="offcanvas-header p-4 border-bottom">
            <h5 id="offcanvasLeftLabel" class="mb-0">
                <img src="assets/images/logo-dark.png" height="24" class="light-version" alt="" />
                <img src="assets/images/logo-light.png" height="24" class="dark-version" alt="" />
            </h5>
            <button type="button" class="btn-close d-flex align-items-center text-dark" data-bs-dismiss="offcanvas"
                aria-label="Close">
                <i class="uil uil-times fs-4"></i>
            </button>
        </div>
        <div class="offcanvas-body p-4 pb-0">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h6 class="fw-bold">Select your color</h6>
                        <ul class="pattern mb-0 mt-3">
                            <li>
                                <a class="color-list rounded color1" href="javascript: void(0);"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Primary"
                                    onclick="setColorPrimary()"></a>
                            </li>
                            <li>
                                <a class="color-list rounded color2" href="javascript: void(0);"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Green"
                                    onclick="setColor('green')"></a>
                            </li>
                            <li>
                                <a class="color-list rounded color3" href="javascript: void(0);"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Yellow"
                                    onclick="setColor('yellow')"></a>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center mt-4 pt-4 border-top">
                        <h6 class="fw-bold">Theme Options</h6>

                        <ul class="text-center style-switcher list-unstyled mt-4">
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="rtl-version t-rtl-light"
                                    onclick="setTheme('style-rtl')"><img src="assets/images/demos/rtl.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">RTL Version</span></a>
                            </li>
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="ltr-version t-ltr-light"
                                    onclick="setTheme('style')"><img src="assets/images/demos/ltr.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">LTR Version</span></a>
                            </li>
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="dark-rtl-version t-rtl-dark"
                                    onclick="setTheme('style-dark-rtl')"><img src="assets/images/demos/dark-rtl.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">RTL Version</span></a>
                            </li>
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="dark-ltr-version t-ltr-dark"
                                    onclick="setTheme('style-dark')"><img src="assets/images/demos/dark.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">LTR Version</span></a>
                            </li>
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="dark-version t-dark mt-4"
                                    onclick="setTheme('style-dark')"><img src="assets/images/demos/dark.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">Dark Version</span></a>
                            </li>
                            <li class="d-grid">
                                <a href="javascript:void(0)" class="light-version t-light mt-4"
                                    onclick="setTheme('style')"><img src="assets/images/demos/ltr.png"
                                        class="img-fluid rounded-md shadow-md d-block mx-auto" style="width: 240px"
                                        alt="" /><span class="text-dark fw-medium mt-3 d-block">Light Version</span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Switcher End -->

    <!-- Back to top -->
    <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fs-5"><i data-feather="arrow-up"
            class="fea icon-sm icons align-middle"></i></a>
    <!-- Back to top -->

    <!-- javascript -->
    <!-- JAVASCRIPT -->
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/tiny-slider/min/tiny-slider.js"></script>
    <script src="assets/libs/tobii/js/tobii.min.js"></script>
    <!-- simplebar -->
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <!-- Main Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.29.2/feather.min.js"></script>
    <script src="assets/js/plugins.init.js"></script>
    <!--Note: All init js like tiny slider, counter, countdown, maintenance, lightbox, gallery, swiper slider, aos animation etc.-->
    <script src="assets/js/app.js"></script>
    <!--Note: All important javascript like page loader, menu, sticky menu, menu-toggler, one page menu etc. -->
</body>

</html>
