<?php
require_once "db_connect.php";

// Function to sanitize input data
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Define variables to store search criteria
$searchName = $searchInstitute = $searchDepartment = $searchDesignation = $searchQualification = $searchSpecialization = $searchResearchInterest = "";

// Define variables to store search results
$searchResults = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize search criteria
    $searchName = sanitize($_POST["searchName"]);
    $searchInstitute = sanitize($_POST["searchInstitute"]);
    $searchDepartment = sanitize($_POST["searchDepartment"]);
    $searchDesignation = sanitize($_POST["searchDesignation"]);
    $searchQualification = sanitize($_POST["searchQualification"]);
    $searchSpecialization = sanitize($_POST["searchSpecialization"]);
    $searchResearchInterest = sanitize($_POST["searchResearchInterest"]);

    // Construct SQL query based on search criteria
    $sql = "SELECT * FROM teachers WHERE ";

    if (!empty($searchName)) {
        $sql .= "(fname LIKE '%$searchName%' OR lname LIKE '%$searchName%') AND ";
    }
    if (!empty($searchInstitute)) {
        $sql .= "serving_institute LIKE '%$searchInstitute%' AND ";
    }
    if (!empty($searchDepartment)) {
        $sql .= "department LIKE '%$searchDepartment%' AND ";
    }
    if (!empty($searchDesignation)) {
        $sql .= "designation LIKE '%$searchDesignation%' AND ";
    }
    if (!empty($searchQualification)) {
        $sql .= "qualification LIKE '%$searchQualification%' AND ";
    }
    if (!empty($searchSpecialization)) {
        $sql .= "specialization LIKE '%$searchSpecialization%' AND ";
    }
    if (!empty($searchResearchInterest)) {
        $sql .= "research_interest LIKE '%$searchResearchInterest%' AND ";
    }

    // Remove the trailing "AND" from the query
    $sql = rtrim($sql, "AND ");

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch and store the search results
        while ($row = mysqli_fetch_assoc($result)) {
            $searchResults[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Faculty Details</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="search.php"><i class="fa fa-search"></i> Search Faculty Details (More)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item ">
                        <a class="nav-link" href="index.php"><i class="fa fa-home"></i> Home <span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="facultyDropdown" role="button"
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
        
        <!-- <h2 class="mb-4">Search Faculty Details</h2> -->
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="searchName">Name:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchInstitute">Institute:</label>
                    <input type="text" class="form-control" id="searchInstitute" name="searchInstitute">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchDepartment">Department:</label>
                    <input type="text" class="form-control" id="searchDepartment" name="searchDepartment">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchDesignation">Designation:</label>
                    <input type="text" class="form-control" id="searchDesignation" name="searchDesignation">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchQualification">Qualification:</label>
                    <input type="text" class="form-control" id="searchQualification" name="searchQualification">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchSpecialization">Specialization:</label>
                    <input type="text" class="form-control" id="searchSpecialization" name="searchSpecialization">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchResearchInterest">Research Interest:</label>
                    <input type="text" class="form-control" id="searchResearchInterest" name="searchResearchInterest">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && count($searchResults) > 0) : ?>
            <div class="mt-4">
                <h4>Search Results:</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Institute</th>
                            <th scope="col">Department</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Qualification</th>
                            <th scope="col">Specialization</th>
                            <th scope="col">Research Interest</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($searchResults as $result) : ?>
                            <tr>
                                <td><?= $result['fname'] . ' ' . $result['lname'] ?></td>
                                <td><?= $result['serving_institute'] ?></td>
                                <td><?= $result['department'] ?></td>
                                <td><?= $result['designation'] ?></td>
                                <td><?= $result['qualification'] ?></td>
                                <td><?= $result['specialization'] ?></td>
                                <td><?= $result['research_interest'] ?></td>
                                <td><a class="btn btn-success btn-sm" href="faculty_complete_profile.php?id=<?= $result['id'] ?>">Complete Profile</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>