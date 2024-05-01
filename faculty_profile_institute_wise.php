<?php
require_once "db_connect.php";

// Fetch HEC universities for dropdown
$sql_universities = "SELECT * FROM hecuniversities";
$result_universities = mysqli_query($conn, $sql_universities);

// Check if any universities exist
if (mysqli_num_rows($result_universities) > 0) {
    // Initialize an empty array to store universities
    $universities = array();

    // Fetch data and store in the array
    while ($row = mysqli_fetch_assoc($result_universities)) {
        $universities[] = $row;
    }
} else {
    echo "No universities found";
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Get the selected university ID
    $selected_university_id = $_POST['university'];
    // Fetch faculty profiles from the database for the selected university
    $sql = "SELECT * FROM teachers WHERE hec_university = '$selected_university_id'";
    $result = mysqli_query($conn, $sql);

    // Check if any records exist
    if (mysqli_num_rows($result) > 0) {
        // Initialize an empty array to store faculty profiles
        $faculty_profiles = array();

        // Fetch data and store in the array
        while ($row = mysqli_fetch_assoc($result)) {
            $faculty_profiles[] = $row;
        }
    } else {
        $message = "Record not found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Profiles</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        /* body {
            background-color: #f8f9fa;
        } */
        /* .container {
            margin-top: 50px;
        } */
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php"><i class="fa fa-university"></i> Faculty Portal for Higher
                Education Institutes (HEIs)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="facultyDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                        <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <div class="container">
        <br><br>
        <h2 class="mb-5 text-center text-uppercase text-info">Faculty Profiles</h2>

        <form method="POST">
            <div class="form-group row">
                <label for="university" class="col-sm-2 col-form-label">Select HEC University:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="university" name="university">
                        <option value="">Select University</option>
                        <?php foreach ($universities as $university) : ?>
                            <option value="<?php echo $university['name']; ?>"><?php echo $university['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-sm-2">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>

        <?php if (isset($faculty_profiles)) : ?>
            <table class="table mt-5 table-bordered">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Action</th>
                        <!-- <th>Department</th>
                    <th>Qualification</th>
                    <th>Specialization</th>
                    <th>HEC University</th>
                    <th>Research Interests</th>
                    <th>Contact</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 0;
                    foreach ($faculty_profiles as $profile) : $count++; ?>
                        <tr>
                            <td><?php echo $count; ?></td>
                            <td class="text-capitalize"><?php echo $profile['fname'] . " " . $profile['lname']; ?></td>
                            <td class="text-capitalize"><?php echo $profile['designation']; ?></td>
                            <td><a class="btn btn-sm btn-success" href="faculty_complete_profile.php?id=<?php echo $profile['id']; ?>">View Profile</a></td>
                            <!-- <td><?php echo $profile['department']; ?></td>
                        <td><?php echo $profile['qualification']; ?></td>
                        <td><?php echo $profile['specialization']; ?></td>
                        <td><?php echo $profile['hec_university']; ?></td>
                        <td><?php echo $profile['research_interest']; ?></td>
                        <td><?php echo $profile['email'] . "<br>" . $profile['phone']; ?></td> -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (isset($message)) : ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS and jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>