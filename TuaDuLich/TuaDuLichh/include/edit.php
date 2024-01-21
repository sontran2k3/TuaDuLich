<?php
if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $tour_id = $_GET['id'];

    $hostName = "localhost";
    $dbUser = "root";
    $dbPassword = "sontran2k3";
    $dbName = "login_register";

    $conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);


    $query = "SELECT * FROM tourtrongnuoc WHERE id = $tour_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $tour = $result->fetch_assoc();
    } else {
        echo "Tour không tồn tại.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
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
    }

    if (empty($error)) {
        // Di chuyển file vào thư mục đích
        // ... (như trong đoạn mã gốc)

        // Thực hiện cập nhật trong database
        $sql_update = "UPDATE tourtrongnuoc SET title=?, mota=?, thoigiandi=?, thoigianve=?, soluongkhach=?, giatien=?, trangthai=?, ghichu=?, image_path=? WHERE id=?";
        $stmt_update = mysqli_prepare($conn, $sql_update);

        if ($stmt_update) {
            mysqli_stmt_bind_param($stmt_update, "sssssssssi", $title, $mota,  $thoigiandi, $thoigianve, $soluongkhach, $giatien, $trangthai, $ghichu, $image_path, $tour_id);

            if (mysqli_stmt_execute($stmt_update)) {
                // Cập nhật thành công, có thể thêm thông báo hoặc chuyển hướng về trang danh sách tour.
                header("Location: trongnuoc.php");
                exit();
            } else {
                echo "Lỗi thực hiện câu lệnh SQL: " . mysqli_stmt_error($stmt_update);
            }

            mysqli_stmt_close($stmt_update);
        } else {
            echo "Lỗi chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
        }
    }
}
?>

<!-- Phần HTML để hiển thị biểu mẫu với thông tin của tour cho phép sửa -->
