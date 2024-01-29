<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Fungsi untuk memuat konten dinamis berdasarkan tautan yang diklik
        function loadContent(url) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('#dynamicContent').html(data);
                },
                error: function() {
                    $('#dynamicContent').html('<p>Failed to load content.</p>');
                }
            });
        }
    </script>

    <style>
        #dynamicContent {
            margin-left: 200px !important;
            padding: 1px 16px;
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #343a40;
            position: fixed;
            height: 100%;
            overflow: auto;
        }

        .nav-link {
            background-color: #343a40;
            border: none;
            color: white;
            height: 45px;
        }

        .nav-link span {
            font-size: 14px;
            color: white;

        }

        .nav-link span:hover {
            color: #4ECDC4;
        }

        .nav-link:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="halo row flex-nowrap">
            <div class="sidebar col-auto col-md-3 col-xl-2 px-sm-2 px-0">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="./index.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <img src="./assets/img/LOGO_UNIVERSITAS_KLABAT.png" alt="" class="fs-5 d-inline d-sm-inline img-fluid" style="width: 60px; margin-left: -10px">
                        <span style="font-size: 15px; margin-left: 10px">Universitas Klabat</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <button id="home" class="nav-link align-middle px-0">
                                <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>
                            </button>
                        </li>
                        <li>
                            <button id="students" href="viewstudents.php" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Students</span>
                            </button>
                        </li>
                        <li>
                            <button id="operator" href="viewoperator.php" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Operator</span>
                            </button>
                        </li>
                        <li>
                            <button href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                                <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Class</span></button>
                        </li>
                        <li>
                            <button href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Attendance List</span>
                            </button>
                        </li>
                        <li>
                            <button href="#" class="nav-link px-0 align-middle">
                                <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Attendance History</span> </button>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col py-3 content" id="dynamicContent">
                <h1>Welcome Home</h1>
            </div>
        </div>
    </div>
    <script>
        $('#home span').css('color', '#7EBDC2');
        $(document).ready(function() {
            // Tambahkan event listener pada button-menu
            $('#home').click(function(e) {
                e.preventDefault();
                $('#dynamicContent').empty();
                $('#dynamicContent').append('<h1>Welcome Home</h1>');


                $('.nav-link span').css('color', 'white');
                $('#home span').css('color', '#7EBDC2');

            });

            $("#students").click(function(e) {
                e.preventDefault();
                var targetUrl = $(this).attr('href');
                loadContent(targetUrl);

                $('.nav-link span').css('color', 'white');
                $('#students span').css('color', '#7EBDC2');
            })

            $("#operator").click(function(e) {
                e.preventDefault();
                var targetUrl = $(this).attr('href');
                loadContent(targetUrl);


                $('.nav-link span').css('color', 'white');
                $('#operator span').css('color', '#7EBDC2');
            })

        });
    </script>

</body>
</body>

</html>