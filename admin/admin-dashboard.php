<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">

<head>
    <title>Admin Dashboard</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .btn-custom {
            color: #fff !important;
            transition: all 0.3s ease;
            border-radius: 20px;
            padding: 10px 20px;
            font-size: 16px;
        }

        .btn-custom:hover {
            opacity: 0.8;
            transform: translateY(-3px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-university {
            background-color: #007bff !important;
            border-color: #007bff !important;
        }

        .btn-faculty {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
        }

        .btn-transparent {
            background-color: transparent !important;
            border-color: transparent !important;
        }

        .btn-featured {
            background-color: #ff5c00 !important;
            border-color: #ff5c00 !important;
        }
        .btn-featured2 {
            background-color: #ff5c11 !important;
            border-color: #ff5c11 !important;
        }

        .btn-other {
            background-color: #7952b3 !important;
            border-color: #7952b3 !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1 class="text text-center text-uppercase text-info mt-4 mb-4">
            Admin Dashboard
        </h1>

        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="register-university.php" class="btn btn-custom btn-university btn-block">
                    <i class="bi bi-plus-circle"></i> Register New University
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="show-university-data.php" class="btn btn-custom btn-faculty btn-block">
                    <i class="bi bi-list"></i> All Registered Universities
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="register-faculty.php" class="btn btn-custom btn-featured btn-block">
                    <i class="bi bi-person-plus"></i> Register New Faculty
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="show-faculty-list.php" class="btn btn-custom btn-other btn-block">
                    <i class="bi bi-person-lines-fill"></i> All Faculty Members
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <a href="logout.php" class="btn btn-custom btn-featured2 btn-block" onclick="return confirm('Logout confirmed!')">
                    <i class="bi bi-person-plus"></i> Logout
                </a>
            </div>
            
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous">
    </script>
</body>

</html>
