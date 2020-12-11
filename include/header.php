<?php
//header.php  
session_start();
if(!isset($_SESSION["user_email"])){
    header('location: login.php');
    die;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Users Management System</title>
        <!-- Fontawersome -->
        <link href="vendor/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom Bootstrap styles-->
        <link href="css/egm_admin.css" rel="stylesheet">
        <!-- favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
		<!-- Croppie CSS -->
		<link rel="stylesheet" href="vendor/croppie/croppie.css" />
    </head>
    <body id="page-top">
        <nav class="navbar navbar-expand navbar-dark bg-dark static-top">
            <a class="navbar-brand mr-1" href="index.php">Users Management System</a>
            <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
            <i class="fas fa-bars"></i>
            </button>

            <!-- Navbar Search -->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
            </form>

            <!-- Navbar -->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span><?php echo $_SESSION['user_full_name']; ?>
                    <i class="fas fa-user-circle fa-fw"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user"></i> Personal Setting</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="wrapper">
            <!-- Sidebar -->
            <ul class="sidebar navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                    <i class="fas fa-file-invoice fa-fw"></i>
                    <span>&nbsp;Manage Receipts</span></a>
                </li> -->
                <?php
                    if($_SESSION['user_role']=="Admin"):
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">
                    <i class="fas fa-users-cog fa-fw"></i>
                    <span>&nbsp;Manage Users</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="company.php">
                    <i class="fas fa-sliders-h"></i>
                    <span>&nbsp;General Setting</span></a>
                </li>
                <?php
                    endif;
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="profile.php">
                    <i class="fas fa-user fa-fw"></i>
                    <span>&nbsp;Personal Setting</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    <span>&nbsp;Logout</span></a>
                </li>
            </ul>
            <div id="content-wrapper">
                <div class="container-fluid">