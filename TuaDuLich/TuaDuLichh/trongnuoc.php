<?php
global $conn;
session_start();

if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    $full_name = $_SESSION["full_name"];
    $role = $_SESSION["role"];
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $error = array();

    // Kiểm tra sự tồn tại của title và mota
    if (empty($_POST['title']) || empty($_POST['mota'])) {
        $error[] = "Vui lòng nhập đầy đủ tiêu đề và mô tả.";
    }

    // Kiểm tra sự tồn tại của $_FILES['image']
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        $error[] = "Upload ảnh không thành công.";
    } else {
        // Kiểm tra kích thước và loại file
        if ($_FILES['image']['size'] > 5242880) {
            $error[] = "Kích thước hình ảnh phải nhỏ hơn 5MB.";
        }

        $file_type = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $file_type_allow = array('png', 'jpg', 'jpeg', 'gif');

        if (!in_array(strtolower($file_type), $file_type_allow)) {
            $error[] = "Loại file không hợp lệ.";
        }

        // Kiểm tra và xử lý trường hợp file tồn tại trước khi upload
        $target_dir = "./image/gallery/";
        $image_filename = basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_filename;

        // Kiểm tra và xử lý trường hợp file tồn tại trước khi upload
        if (file_exists($target_file)) {
            $error[] = "File đã tồn tại.";
        }
    }

    if (empty($error)) {
        // Di chuyển file vào thư mục đích
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $hostName = "localhost";
            $dbUser = "root";
            $dbPassword = "sontran2k3";
            $dbName = "login_register";

            $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

            // Kiểm tra kết nối database
            if (!$conn) {
                die("Kết nối thất bại: " . mysqli_connect_error());
            }

            // Sử dụng prepared statements để ngăn chặn SQL injection
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $mota = mysqli_real_escape_string($conn, $_POST['mota']);
            $thoigiandi = mysqli_real_escape_string($conn, $_POST['thoigiandi']);
            $thoigianve = mysqli_real_escape_string($conn, $_POST['thoigianve']);
            $soluongkhach = mysqli_real_escape_string($conn, $_POST['soluongkhach']);
            $giatien = mysqli_real_escape_string($conn, $_POST['giatien']);
            $trangthai = mysqli_real_escape_string($conn, $_POST['trangthai']);
            $ghichu = mysqli_real_escape_string($conn, $_POST['ghichu']);
            $image_path = $target_file;

            $sql = "INSERT INTO tourtrongnuoc (title, mota, thoigiandi, thoigianve, soluongkhach, giatien, trangthai, ghichu, image_path) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "sssssssss", $title, $mota,  $thoigiandi, $thoigianve, $soluongkhach, $giatien, $trangthai, $ghichu, $image_path);

                if (mysqli_stmt_execute($stmt)) {
                    $last_id = mysqli_insert_id($conn);

                    // Hiển thị hình ảnh trong bảng
                    echo "<tr>";
                    echo "<td>" . $last_id . "</td>";
                    echo '<td>' . $title . '</td>';
                    echo '<td>' . $mota . '</td>';
                    echo '<td><img src="' . $image_path . '" height="50" width="50"></td>';
                    echo '<td>' . $thoigiandi . '</td>';
                    echo '<td>' . $thoigianve . '</td>';
                    echo '<td>' . $soluongkhach . '</td>';
                    echo '<td>' . $giatien . '</td>';
                    echo '<td>' . $trangthai . '</td>';
                    echo '<td>' . $ghichu . '</td>';
                    echo '<td><a href="' . $image_path . '" target="_blank">Xem</a></td>';
                    echo "<td>
                        <a href='edit.php?id=" . $last_id . "' class='btn btn-primary'>Sửa</a>
                        <a onclick='return confirm(\"Xóa Data?\");' href='./include/deletetn.php?id=" . htmlspecialchars($last_id) . "' class='btn btn-success'>Xóa</a>
                    </td>";
                    echo "</tr>";
                } else {
                    echo "<br>Lỗi thực hiện câu lệnh SQL: " . mysqli_stmt_error($stmt);
                }

                mysqli_stmt_close($stmt);
            } else {
                echo "<br>Lỗi chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
            }

            mysqli_close($conn);
        } else {
            foreach ($error as $err) {
                echo $err . "<br>";
            }
        }
    }
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

        .container {
            padding: 80px 120px;
        }

        .bg-1 {
            background: #2d2d30;
            color: #bdbdbd;
        }

        .bg-1 h3 {
            color: #fff;
        }

        .navbar {
            font-family: Montserrat, sans-serif;
            margin-bottom: 0;
            background-color: #2d2d30;
            border: 0;
            font-size: 14px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }

        .dropdown-menu {
            font-size: 11px !important;
        }

        .row {
            margin-top: 50px;
        }

        img {
            margin-left: 100px;
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
                        <li><a class="dropdown-item" href="test.php">Lịch sử</a></li>
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

<div class="container text-top">
    <div class="row">
        <div class="col-3">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Quản Lý Tour
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
                            Quản Lý Blog
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
                            Quản Lý ...
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
        <div class="col-7">
            <center><h3>THÔNG TIN CHI TIẾT TOUR TRONG NƯỚC</h3></center>
            <form method="post" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                <div class="col-md-4">
                    <label for="title" class="form-label">Tiêu đề</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề ảnh" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="datetime" class="form-label">Thời gian đi dự kiến</label>
                    <input type="datetime-local" class="form-control" id="thoigiandi" name="thoigiandi">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="datetime_ve" class="form-label">Thời gian về dự kiến</label>
                    <input type="datetime-local" class="form-control" id="thoigianve" name="thoigianve">
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

                <div class="mb-3">
                    <label for="mota" class="form-label">Mô tả</label>
                    <textarea class="form-control" id="mota" name="mota" rows="3" placeholder="Nhập mô tả ảnh" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Ảnh</label>
                    <div class="input-group">
                        <input type="file" class="form-control" id="image" name="image" required>
                        <label class="input-group-text" for="image">Upload</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="soluongkhach" class="form-label">Số lượng khách dự kiến</label>
                    <input type="text" class="form-control" id="soluongkhach" name="soluongkhach" placeholder="Số lượng khách" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="giatien" class="form-label">Giá Tiền</label>
                    <div class="input-group has-validation">
                        <input type="text" class="form-control" id="giatien" name="giatien" placeholder="Giá tiền" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">VND</span>
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="trangthai" class="form-label">Trạng Thái</label>
                    <input type="text" class="form-control" id="trangthai" name="trangthai" placeholder="Trạng Thái" required>
                    <div class="valid-feedback">
                        Looks good!
                    </div>
                </div>

                <div class="mb-3">
                    <label for="ghichu" class="form-label">Ghi chú</label>
                    <textarea class="form-control" id="ghichu" name="ghichu" rows="3" placeholder="Nhập ghi chú"></textarea>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>

        </div>
    </div>
    <table class="table table-bordered mt-3">
        <thead>
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Mô tả</th>
            <th>Ảnh</th>
            <th>Thời gian đi</th>
            <th>Thời gian về</th>
            <th>Số lượng khách</th>
            <th>Giá Tiền</th>
            <th>Trạng Thái</th>
            <th>Ghi chú</th>
            <th>Xem trước ảnh</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $hostName = "localhost";
        $dbUser = "root";
        $dbPassword = "sontran2k3";
        $dbName = "login_register";

        $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

        // Kiểm tra kết nối database
        if (!$conn) {
            die("Kết nối thất bại: " . mysqli_connect_error());
        }

        $result = $conn->query("SELECT * FROM tourtrongnuoc");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo '<td>' . $row["title"] . '</td>';
            echo '<td>' . $row["mota"] . '</td>';
            echo '<td><img src="' . $row["image_path"] . '" height="50" width="50"></td>';
            echo '<td>' . $row["thoigiandi"] . '</td>';
            echo '<td>' . $row["thoigianve"] . '</td>';
            echo '<td>' . $row["soluongkhach"] . '</td>';
            echo '<td>' . $row["giatien"] . '</td>';
            echo '<td>' . $row["trangthai"] . '</td>';
            echo '<td>' . $row["ghichu"] . '</td>';
            echo '<td><a href="' . $row["image_path"] . '" target="_blank">Xem</a></td>';
            echo "<td>
                        <a href='./include/edit.php?id=" . $row["id"] . "' class='btn btn-primary'>Sửa</a>
                        <a onclick='return confirm(\"Xóa Data?\");' href='./include/deletetn.php?id=" . htmlspecialchars($row["id"]) . "' class='btn btn-success'>Xóa</a>
                    </td>";
            echo "</tr>";
        }
        mysqli_close($conn);
        ?>
        </tbody>
    </table>
</div>
<script>
    function confirmLogout() {
        var isConfirmed = confirm("Đăng Xuất Tài Khoản?");
        if (isConfirmed) {
            window.location.href = "index.php";
        }
        return false;
    }
</script>
<script src="https://kit.fontawesome.com/ea6b2b5594.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="your-script.js"></script>

</body>

</html>