<?php
// Kết nối đến cơ sở dữ liệu
$hostName = "localhost";
$dbUser = "root";
$dbPassword = "sontran2k3";
$dbName = "login_register";

try {
    $conn = new PDO("mysql:host=$hostName;dbname=$dbName", $dbUser, $dbPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}

// Truy vấn cơ sở dữ liệu để lấy dữ liệu từ bảng tourtrongnuoc
$trongnuoc = $conn->prepare("SELECT id, title, mota, image_path FROM tourtrongnuoc");
$trongnuoc->execute();
$tourstrongnuoc = $trongnuoc->fetchAll(PDO::FETCH_ASSOC);

$ngoainuoc = $conn->prepare("SELECT id, title, mota, image_path FROM tourngoainuoc");
$ngoainuoc->execute();
$toursngoainuoc = $ngoainuoc->fetchAll(PDO::FETCH_ASSOC);

// Đóng kết nối database
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>Bootstrap Theme The Band</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            font: 400 15px/1.8 Lato, sans-serif;
            color: #777;
        }
        h3, h4 {
            margin: 10px 0 30px 0;
            letter-spacing: 10px;
            font-size: 20px;
            color: #111;
        }
        .container {
            padding: 80px 120px;
        }
        .person {
            border: 10px solid transparent;
            margin-bottom: 25px;
            width: 80%;
            height: 80%;
            opacity: 0.7;
        }
        .person:hover {
            border-color: #f1f1f1;
        }
        .carousel-inner img {
            width: 100%;
            margin: auto;
        }
        .carousel-caption h3 {
            color: #fff !important;
        }
        @media (max-width: 600px) {
            .carousel-caption {
                display: none;
            }
        }
        .bg-1 {
            background: #2d2d30;
            color: #bdbdbd;
        }
        .bg-1 h3 {color: #fff;}
        .bg-1 p {font-style: italic;}
        .list-group-item:first-child {
            border-top-right-radius: 0;
            border-top-left-radius: 0;
        }
        .list-group-item:last-child {
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .thumbnail {
            padding: 0 0 15px 0;
            border: none;
            border-radius: 0;
        }
        .thumbnail p {
            margin-top: 15px;
            color: #555;
        }
        .btn {
            padding: 10px 20px;
            background-color: #333;
            color: #f1f1f1;
            border-radius: 0;
            transition: .2s;
        }
        .btn:hover, .btn:focus {
            border: 1px solid #333;
            background-color: #fff;
            color: #333;
        }
        .modal-header, h4, .close {
            background-color: #777777;
            font-size: 30px;
            text-align: center;
            border-radius: 5px;
            color: #333;
        }


        .nav-tabs li a {
            color: #777;
        }
        .navbar {
            font-family: Montserrat, sans-serif;
            margin-bottom: 0;
            background-color: #2d2d30;
            border: 0;
            font-size: 11px !important;
            letter-spacing: 4px;
            opacity: 0.9;
        }
        .navbar li a, .navbar .navbar-brand {
            color: #d5d5d5 !important;
        }
        .navbar-nav li a:hover {
            color: #fff !important;
        }
        .navbar-nav li.active a {
            color: #fff !important;
            background-color: #29292c !important;
        }
        .navbar-default .navbar-toggle {
            border-color: transparent;
        }
        .open .dropdown-toggle {
            color: #fff;
            background-color: #555 !important;
        }
        .dropdown-menu li a {
            color: #000 !important;
        }
        .dropdown-menu li a:hover {
            background-color: red !important;
        }
        footer {
            background-color: #2d2d30;
            color: #f5f5f5;
            padding: 32px;
        }
        footer a {
            color: #f5f5f5;
        }
        footer a:hover {
            color: #777;
            text-decoration: none;
        }
        .form-control {
            border-radius: 0;
        }
        textarea {
            resize: none;
        }

    </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <img class="bd-placeholder-img rounded float-start" width="70" height="70" src="./image/logo.jpg" alt="Logo Image">
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#myPage">HOME</a></li>
                <li><a href="#band">BAND</a></li>
                <li><a href="#tour">TOUR</a></li>
                <li><a href="logout.php">LOGIN</a></li>
                <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>
            </ul>
        </div>
    </div>
</nav>
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="./image/3.jpg" alt="Los Angeles" style="width:100%; height: 600px">
        </div>

        <div class="item">
            <img src="./image/bavi.jpg" alt="Chicago" style="width:100%; height: 600px">
        </div>

        <div class="item">
            <img src="./image/taxua1.jpg" alt="New York" style="width:100%; height: 600px">
        </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
<!-- Container (The Band Section) -->
<div id="band" class="container text-center">
    <h3>THE BAND</h3>
    <p><em>We love music!</em></p>
    <p>We have created a fictional band website. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo" class="collapse">
                <p>Guitarist and Lead Vocalist</p>
                <p>Loves long walks on the beach</p>
                <p>Member since 1988</p>
            </div>
        </div>
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo2" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo2" class="collapse">
                <p>Drummer</p>
                <p>Loves drummin'</p>
                <p>Member since 1988</p>
            </div>
        </div>
        <div class="col-sm-4">
            <p class="text-center"><strong>Name</strong></p><br>
            <a href="#demo3" data-toggle="collapse">
                <img src="bandmember.jpg" class="img-circle person" alt="Random Name" width="255" height="255">
            </a>
            <div id="demo3" class="collapse">
                <p>Bass player</p>
                <p>Loves math</p>
                <p>Member since 2005</p>
            </div>
        </div>
    </div>
</div>

<!-- Container (TOUR Section) -->
<div class="container">
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu1">TRONG NƯỚC</a></li>
        <li><a data-toggle="tab" href="#menu2">NGOÀI NƯỚC</a></li>
    </ul>
    <div class="tab-content">
        <div id="menu1" class="tab-pane fade in active">
            <div class="row text-center">
                <div id="tour" class="bg-1">
                    <div class="thumbnail">
                        <div class="container">
                            <div class="row">
                                <?php foreach ($tourstrongnuoc as $tourstrongnuoc): ?>
                                    <div class="col-sm-4">
                                        <div class="thumbnail">
                                            <img src="<?= $tourstrongnuoc['image_path'] ?>" alt="Lights" width="400" height="300">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $tourstrongnuoc['title'] ?></h5>
                                                <p class="card-text"><?= $tourstrongnuoc['mota'] ?></p>
                                                <button class="btn" data-toggle="modal" data-target="#myModal<?= $tourstrongnuoc['id'] ?>"> <i class="fa-solid fa-cart-shopping"></i>   Đặt Vé</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="myModal<?= $tourstrongnuoc['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="myModalLabel">Thông tin chi tiết</h3>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-md-4">
                                                        <img src="<?= $tourstrongnuoc['image_path']?>" class="img-fluid" alt=""  height="100" width="200">
                                                        <p><?= $tourstrongnuoc['title'] ?></p>
                                                        <p><?= $tourstrongnuoc['mota'] ?></p>
                                                    </div>
                                                    <div class="col-md-offset-4">
                                                        <table class="table table-bordered" style="width: 100%; max-width: 600px;">
                                                            <thead>
                                                            <tr>
                                                                <th style="width: auto;">Tên</th>
                                                                <th style="width: auto;">Họ</th>
                                                                <th style="width: auto;">Email</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td style="width: auto;">John</td>
                                                                <td style="width: auto;">Doe</td>
                                                                <td style="width: auto;">john@example.com</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: auto;">Mary</td>
                                                                <td style="width: auto;">Moe</td>
                                                                <td style="width: auto;">mary@example.com</td>
                                                            </tr>
                                                            <tr>
                                                                <td style="width: auto;">July</td>
                                                                <td style="width: auto;">Dooley</td>
                                                                <td style="width: auto;">july@example.com</td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="menu2" class="tab-pane fade">
            <div class="row text-center">
                <div id="tour" class="bg-1">
                    <div class="thumbnail">
                        <div class="container">
                            <div class="row">
                                <?php foreach ($toursngoainuoc as $toursngoainuoc): ?>
                                    <div class="col-sm-4">
                                        <div class="thumbnail">
                                            <img src="<?= $toursngoainuoc['image_path'] ?>" width="400" height="300">
                                            <div class="card-body">
                                                <h5 class="card-title"><?= $toursngoainuoc['title'] ?></h5>
                                                <p class="card-text"><?= $toursngoainuoc['mota'] ?></p>
                                                <button class="btn" data-toggle="modal" data-target="#myModal<?= $toursngoainuoc['id'] ?>">Buy Tickets</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="myModal<?= $toursngoainuoc['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel">Thông tin chi tiết</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="<?= $toursngoainuoc['image_path'] ?>" class="img-fluid" alt="<?= $toursngoainuoc['title'] ?>" height="30" width="40">
                                                    <p><?= $toursngoainuoc['mota'] ?></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4><span class="glyphicon glyphicon-lock"></span> Tickets</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <label for="psw"><span class="glyphicon glyphicon-shopping-cart"></span> Tickets, $23 per person</label>
                            <input type="number" class="form-control" id="psw" placeholder="How many?">
                        </div>
                        <div class="form-group">
                            <label for="usrname"><span class="glyphicon glyphicon-user"></span> Send To</label>
                            <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                        </div>
                        <button type="submit" class="btn btn-block">Pay
                            <span class="glyphicon glyphicon-ok"></span>
                        </button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span> Cancel
                    </button>
                    <p>Need <a href="#">help?</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Container (Contact Section) -->
<div id="contact" class="container">
    <h3 class="text-center">Contact</h3>
    <p class="text-center"><em> Tua du lịch xin chào quý khách </em></p>

    <div class="row">
        <div class="col-md-4">
            <p>Fan? Drop a note.</p>
            <p><span class="glyphicon glyphicon-map-marker"></span>    Hà Nội. Việt Nam</p>
            <p><span class="glyphicon glyphicon-phone"></span>    Phone: 0325005050</p>
            <p><span class="glyphicon glyphicon-envelope"></span>    Email: laptrinhphpK12@gmail.com</p>
        </div>
        <div class="col-md-8">
            <form action="./include/contact.php" method="post">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
                    </div>
                    <div class="col-sm-6 form-group">
                        <input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
                    </div>
                </div>
                <textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
                <br>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <button class="btn pull-right" type="submit" name="submit">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
    <br>
    <h3 class="text-center">From The Blog</h3>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#home">Mike</a></li>
        <li><a data-toggle="tab" href="#menu1">Chandler</a></li>
        <li><a data-toggle="tab" href="#menu2">Peter</a></li>
    </ul>

    <div class="tab-content">
        <div id="home" class="tab-pane fade in active">
            <h2>Mike Ross, Manager</h2>
            <p>Man, we've been on the road for some time now. Looking forward to lorem ipsum.</p>
        </div>
        <div id="menu1" class="tab-pane fade">
            <h2>Chandler Bing, Guitarist</h2>
            <p>Always a pleasure people! Hope you enjoyed it as much as I did. Could I BE.. any more pleased?</p>
        </div>
        <div id="menu2" class="tab-pane fade">
            <h2>Peter Griffin, Bass player</h2>
            <p>I mean, sometimes I enjoy the show, but other times I enjoy other things.</p>
        </div>
    </div>
</div>

<!-- Image of location/map -->
<img src="map.jpg" class="img-responsive" style="width:100%">

<!-- Footer -->
<footer class="text-center">
    <a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
        <span class="glyphicon glyphicon-chevron-up"></span>
    </a><br><br>
    <p>Bootstrap Theme Made By <a href="https://www.w3schools.com" data-toggle="tooltip" title="Visit w3schools">www.w3schools.com</a></p>
</footer>

<script>
    $(document).ready(function(){
        // Initialize Tooltip
        $('[data-toggle="tooltip"]').tooltip();

        // Add smooth scrolling to all links in navbar + footer link
        $(".navbar a, footer a[href='#myPage']").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {

                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    })
</script>
<script src="https://kit.fontawesome.com/ea6b2b5594.js" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="your-script.js"></script>

</body>
</html>