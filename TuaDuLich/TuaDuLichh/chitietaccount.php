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
                    <a class="nav-link"  href="chitietaccoint.php"> <i class="fa-solid fa-user-pen"></i>  Thông tin tài khoản</a>
                    <a class="nav-link" href="datve.php"> <i class="fa-solid fa-clipboard-list"></i>  Thông tin vé </a>
                    <a class="nav-link" href="#">  <i class="fa-solid fa-arrow-right-from-bracket"></i>  Logout</a>
                </nav>
            </nav>
        </div>

        <?php
        if (isset($_SESSION["user_id"])) {
            $user_id = $_SESSION["user_id"];
            $full_name = $_SESSION["full_name"];
            $role = $_SESSION["role"];

            // Kết nối đến cơ sở dữ liệu (thay thế các giá trị này bằng thông tin kết nối thực tế của bạn)
            $hostName = "localhost";
            $dbUser = "root";
            $dbPassword = "sontran2k3";
            $dbName = "login_register";

            $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

            // Kiểm tra kết nối
            if ($conn->connect_error) {
                die("Kết nối không thành công: " . $conn->connect_error);
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Lấy dữ liệu từ form
                $full_name = $_POST["full_name"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $CCCD = $_POST["CCCD"];
                $ngay = $_POST["ngay"];
                $thang = $_POST["thang"];
                $nam = $_POST["nam"];
                $ngaysinh = "$nam-$thang-$ngay";
                $gioitinh = $_POST["gioitinh"];
                $tinhthanh = $_POST["tinhthanh"];
                $sothich = isset($_POST["sothich"]) ? implode(', ', $_POST["sothich"]) : '';

                // Cập nhật thông tin trong cơ sở dữ liệu
                $update_sql = "UPDATE users SET 
                full_name = '$full_name', 
                email = '$email', 
                phone = '$phone', 
                CCCD = '$CCCD', 
                ngaysinh = '$ngaysinh', 
                gioitinh = '$gioitinh', 
                diachi = '$tinhthanh', 
                sothich = '$sothich' 
                WHERE id = $user_id";

                if ($conn->query($update_sql) === TRUE) {
                    // Hiển thị modal khi cập nhật thành công
                    echo '<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông báo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Cập nhật thông tin thành công!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                  </div>
                </div>
              </div>
            </div>';

                    // Kích hoạt modal bằng JavaScript
                    echo '<script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById("successModal"));
                myModal.show();
            });
          </script>';
                } else {
                    echo '<div class="modal fade" id="successModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Thông báo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                   Lỗi cập nhật thông tin:
                  </div>
                  <div class="modal-footer">
                    <button type="close" class="btn btn-primary">Đóng</button>
                  </div>
                </div>
              </div>
            </div>';
                    echo '<script type="text/javascript">
            document.addEventListener("DOMContentLoaded", function () {
                var myModal = new bootstrap.Modal(document.getElementById("successModal"));
                myModal.show();
            });
          </script>';
                }
            }



            // Lấy thông tin của người dùng hiện đang đăng nhập từ cơ sở dữ liệu
            $sql = "SELECT * FROM users WHERE id = $user_id";
            $result = $conn->query($sql);

            // Lấy thông tin của người dùng hiện đang đăng nhập (chưa xử lý bảo mật)
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            } else {
                echo "Không tìm thấy thông tin người dùng.";
            }

            $conn->close();
        } else {
            // Xử lý khi không có người dùng đăng nhập
            echo "Không có người dùng đăng nhập.";
        }
        ?>



        <div class="col-7">
            <center><h3>Thông Tin Tài Khoản</h3></center>
            <form class="row g-6" method="post" >
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">User Name: </label>
                    <input type="text" class="form-control" name="full_name" value="<?php echo $row['full_name']; ?>"  >
                </div>
                <div class="col-md-6">
                    <label for="exampleInputEmail1" class="form-label">Email address: </label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" value="<?php echo $row['email']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Phone: </label>
                    <input type="text" class="form-control" id="inputPhone" name="phone" value="<?php echo $row['phone']; ?>">
                </div>
                <div class="col-md-6">
                    <label for="inputCCCD" class="form-label">CMND/CCCD: </label>
                    <input type="text" class="form-control" id="inputCCCD" name="CCCD" value="<?php echo $row['CCCD']; ?>">
                </div>
                <div class="mb-2">
                    <label class="form-check-label">Ngày Sinh: </label>
                    <label class="form-check-label"> Ngày: </label>
                    <div class="form-check form-check-inline">
                        <select id="inputState" class="form-select" name="ngay">
                            <?php
                            for ($i = 1; $i <= 31; $i++) {
                                echo "<option " . (($i == date('d', strtotime($row['ngaysinh']))) ? 'selected' : '') . ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <label class="form-check-label"> Tháng: </label>
                    <div class="form-check form-check-inline">
                        <select id="inputState1" class="form-select" name="thang">
                            <?php
                            for ($i = 1; $i <= 12; $i++) {
                                echo "<option " . (($i == date('m', strtotime($row['ngaysinh']))) ? 'selected' : '') . ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <label class="form-check-label"> Năm: </label>
                    <div class="form-check form-check-inline">
                        <select id="inputState2" class="form-select" name="nam">
                            <?php
                            for ($i = 2001; $i <= 2012; $i++) {
                                echo "<option " . (($i == date('Y', strtotime($row['ngaysinh']))) ? 'selected' : '') . ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- Giới Tính -->
                <div class="mb-3">
                    <label class="form-check-label">Giới Tính: </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioitinh" id="exampleRadios1" value="Nam" <?php echo ($row['gioitinh'] == 'Nam') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="exampleRadios1">
                            Nam
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gioitinh" id="exampleRadios2" value="Nữ" <?php echo ($row['gioitinh'] == 'Nữ') ? 'checked' : ''; ?>>
                        <label class="form-check-label" for="exampleRadios2">
                            Nữ
                        </label>
                    </div>
                </div>

                <!-- Địa Chỉ -->
                <div class="mb-3">
                    <label class="form-check-label">Tỉnh/ Thành Phố: </label>
                    <div class="form-check form-check-inline">
                        <select class="form-select" id="autoSizingSelect" name="tinhthanh">
                            <option value="Other" <?php echo ($row['diachi'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            <option value="Hà Nội" <?php echo ($row['diachi'] == 'Hà Nội') ? 'selected' : ''; ?>>Hà Nội</option>
                            <option value="Nghệ An" <?php echo ($row['diachi'] == 'Nghệ An') ? 'selected' : ''; ?>>Nghệ An</option>
                            <option value="Thanh Hóa" <?php echo ($row['diachi'] == 'Thanh Hóa') ? 'selected' : ''; ?>>Thanh Hóa</option>
                            <!-- Các option khác tương tự -->
                        </select>
                    </div>
                </div>

                <!-- Sở Thích -->
                <div class="mb-3">
                    <label class="form-check-label">Sở Thích: </label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="Thể Thao" <?php echo (isset($row['sothich']) && in_array('Thể Thao', explode(', ', $row['sothich']))) ? 'checked' : ''; ?> name="sothich[]">
                        <label class="form-check-label" for="inlineCheckbox1">Thể Thao</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="Nghe Nhạc" <?php echo (isset($row['sothich']) && in_array('Nghe Nhạc', explode(', ', $row['sothich']))) ? 'checked' : ''; ?> name="sothich[]">
                        <label class="form-check-label" for="inlineCheckbox2">Nghe Nhạc</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="Mua Sắm" <?php echo (isset($row['sothich']) && in_array('Mua Sắm', explode(', ', $row['sothich']))) ? 'checked' : ''; ?> name="sothich[]">
                        <label class="form-check-label" for="inlineCheckbox3">Mua Sắm</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="Du Lịch" <?php echo (isset($row['sothich']) && in_array('Du Lịch', explode(', ', $row['sothich']))) ? 'checked' : ''; ?> name="sothich[]">
                        <label class="form-check-label" for="inlineCheckbox4">Du Lịch</label>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Cập nhật </button>
                </div>
            </form>
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
