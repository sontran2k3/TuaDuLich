<?php
global $conn;
session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $full_name = $_SESSION["full_name"];
    $role = $_SESSION["role"];
}
?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">

<head>
    <title>Bootstrap Theme The Band</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limontesweetalert2/7.2.0/sweetalert2.min.css" />
    <style>
        body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
        }
        img{
            margin-left: 100px;
        }
        .container {
            padding: 80px 120px;
        }
        .bg-1 {
            background: #2d2d30;
            color: #bdbdbd;
        }
        .bg-1 h3 {color: #fff;}
        .navbar {
            font-family: Montserrat, sans-serif;
            margin-bottom: 0;
            background-color: #2d2d30;
            border: 0;
            font-size: 14px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }
        .dropdown-menu{
            font-size: 11px !important;
        }

        .accordion-item {
            width: 200px;
            color: #555555;
        }
        .nav-pills a {
            padding: 10px;
        }
        .row{
            margin-top: 50px;
        }
        .mb-2{
            margin-top: 10px;
        }

    </style>
</head>

<body id="myPage" data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="50">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#myNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <img class="bd-placeholder-img rounded float-start" width="70" height="70" src="./image/logo.jpg" alt="Logo Image">
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <?php echo isset($full_name) ? '<i class="far fa-circle-user"></i> ' . $full_name : 'ACCOUNT'; ?>
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Thông tin tài khoản</a></li>
                        <li><a class="dropdown-item" href="#">Thông tin vé</a></li>
                        <li><a class="dropdown-item" onclick="confirmLogout()" href="#">Đăng Xuất</a></li>
                        <script>
                            function confirmLogout() {
                                var isConfirmed = confirm("Đăng Xuất Tài Khoản?");
                                if (isConfirmed) {
                                    window.location.href = "index.php";
                                }
                                return false;
                            }
                        </script>
                    </ul>
                </li>
            </ul>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"><span class="glyphicon glyphicon-search"></span></a></li>
            </ul>
        </div>
    </div>
</nav>


<div class="container text-left">
    <div class="row">
        <div class="col-3">
            <nav id="navbar-example3" class="h-100 flex-column align-items-stretch pe-4 border-end">
                <nav class="nav nav-pills flex-column">
                    <a class="nav-link"  href="chitietaccount.php"> <i class="fa-solid fa-user-pen"></i>  Thông tin tài khoản</a>
                    <a class="nav-link" href="datve.php"> <i class="fa-solid fa-clipboard-list"></i>      Thông tin vé </a>
                    <a class="nav-link" href="#">  <i class="fa-solid fa-arrow-right-from-bracket"></i>  Logout</a>
                </nav>
            </nav>
        </div>

    </div>


    <div class="footter">

    </div>


    <script src="https://kit.fontawesome.com/ea6b2b5594.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="your-script.js"></script>

</body>

</html>
