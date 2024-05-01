<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEIs</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa fa-university"></i> Faculty Portal for Higher
                Education Institutes (HEIs)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="facultyDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-book"></i> Faculty
                        </a>
                        <div class="dropdown-menu" aria-labelledby="facultyDropdown">
                            <a class="dropdown-item" href="faculty/login.php"><i class="fa fa-sign-in"></i> Login</a>
                            <a class="dropdown-item" href="faculty/login-registration.php"><i class="fa fa-user-plus"></i> Register</a>
                            <a class="dropdown-item" href="faculty_profile_institute_wise.php"><i class="fa fa-list"></i> List</a>
                            <a class="dropdown-item" href="search.php"><i class="fa fa-search"></i> More Search</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user"></i> Admin
                        </a>
                        <div class="dropdown-menu" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="admin/login.php"><i class="fa fa-sign-in"></i> Login</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <!-- Your content here -->
                        <h5 class="card-title text text-center text-info">Welcome to HEIs Portal</h5>
                        <p class="card-text text-justify">Faculty Portal for HEIs is proposed with aim to create a
                            system where students can search faculty information of different universities. Student can
                            search a specific faculty detail by Name, Department, Designation, Qualification,
                            Specialization, Courses and Research interest. As faculty plays key role in any academic
                            institute especially for higher studies, So, this system will help students to select the
                            best institute for higher study based on faculty profile. Merging of faculty information at
                            one place will be helpful for students as they do not have to visit university or individual
                            websites. So, students’ effort of searching and comparing faculty of different universities
                            will be reduced</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>