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
<html lang="en">

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
                        <li><a class="dropdown-item" href="chitietaccount.php">Thông tin tài khoản</a></li>
                        <li><a class="dropdown-item" href="datve.php"> Thông tin vé </a></li>
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
        </div>
    </div>
</nav>

<div class="container text-left">
    <div class="row">
        <div class="col-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Quản lý Tour
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 my-1" href="trongnuoc.php">Trong Nước</a>
                            <a class="nav-link ms-3 my-1" href="ngoainuoc.php">Ngoài Nước</a>
                        </nav>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Quản Lý Tour
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 my-1" href="trongnuoc.php">Trong Nước</a>
                            <a class="nav-link ms-3 my-1" href="#item-1-2">Ngoài Nước</a>
                        </nav>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Quản Lý Liên Hệ
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <nav class="nav nav-pills flex-column">
                            <a class="nav-link ms-3 my-1" href="trongnuoc.php">Trong Nước</a>
                            <a class="nav-link ms-3 my-1" href="ngoainuoc.php">Ngoài Nước</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <img src="./image/3.jpg" width="600px" height="300px">
        </div>
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