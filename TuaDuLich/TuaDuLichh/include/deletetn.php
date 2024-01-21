 <?php
// Kết nối đến cơ sở dữ liệu
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "sontran2k3";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa dữ liệu từ cơ sở dữ liệu
    $delete_query = "DELETE FROM tourtrongnuoc WHERE id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
           header("Location: ../trongnuoc.php");
            echo "<script>
                    alert('Xóa dữ liệu thành công');
                    window.location.href='../trongnuoc.php';
                  </script>";
        } else {
            echo "Lỗi xóa dữ liệu: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Lỗi chuẩn bị câu lệnh SQL: " . mysqli_error($conn);
    }

    mysqli_close($conn);


    exit();
} else {
    echo "ID không hợp lệ.";
}
?>