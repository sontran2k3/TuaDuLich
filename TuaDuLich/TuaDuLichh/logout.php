<?php
session_start();
session_destroy();
header("Location: login.php");
echo "0, 7, 29, 0";
?>