<?php
// Kết nối đến cơ sở dữ liệu
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "sontran2k3";
$dbName = "login_register";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

// Lấy dữ liệu từ form
$name = $_POST['name'];
$email = $_POST['email'];
$comment = $_POST['comments'];

$sql = "INSERT INTO lienhe (name, email, comment) VALUES ('$name', '$email', '$comment')";

// Kiểm tra kết nối
if ($conn->query($sql) === TRUE) {
    header("Location: ../index.php");
    echo '
    <div class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Success</h4>
                </div>
                <div class="modal-body">
                    <p>Contact information added successfully.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
} else {
    echo '
    <div class="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Error: ' . $conn->error . '</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>';
}

// Đóng kết nối
$conn->close();
?>
