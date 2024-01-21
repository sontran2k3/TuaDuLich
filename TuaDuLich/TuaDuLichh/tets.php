<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet">
    <title>Bootstrap Example</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="p-3 m-0 border-0 bd-example">
<div class="container text-left">
    <div class="row">
        <div class="col-3">
            <div class="accordion" id="accordionExample">

                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Quản Lý Blog
                        </button>
                    </h2>
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

</body>
</html>