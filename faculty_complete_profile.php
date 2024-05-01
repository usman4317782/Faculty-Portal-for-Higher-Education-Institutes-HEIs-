<?php
require_once "db_connect.php";

// Fetch existing data from the database
$teacher_id = $_GET['id'];

$sql = "SELECT * FROM teachers WHERE id = '$teacher_id'";
$db_result = mysqli_query($conn, $sql);

if ($db_result && mysqli_num_rows($db_result) > 0) {
    $row = mysqli_fetch_assoc($db_result);

    // Assign retrieved data to variables
    $fname = $row['fname'];
    $lname = $row['lname'];
    $designation = $row['designation'];
    $experience = $row['experience'];
    $experience_details = $row['experience_details'];
    $publications = $row['publications'];
    $publications_details = $row['publications_details'];
    $conferences = $row['conferences'];
    $conferences_details = $row['conferences_details'];
    $seminars = $row['seminars'];
    $seminars_details = $row['seminars_details'];
    $workshops = $row['workshops'];
    $workshops_details = $row['workshops_details'];
    $city = $row['city'];
    $address = $row['address'];
    $phone = $row['phone'];
    $qualification = $row['qualification'];
    $specialization = $row['specialization'];
    $university = $row['hec_university'];
    $serving_institute = $row['serving_institute'];
    $department = $row['department'];
    $research_interest = $row['research_interest'];
    $coveringLetter = $row['coveringLetter'];
} else {
    $msg = "<p class='text text-center text-danger font-weight-bold'>Error: Unable to fetch teacher data from the database.</p>";
    exit(); // Add exit to stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher CV</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom styles */
        .cv-header {
            background-color: #007bff;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        .cv-table {
            width: 100%;
            margin-bottom: 30px;
        }

        .cv-table th,
        .cv-table td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }

        .cv-table th {
            background-color: #007bff;
            color: #fff;
            text-align: left;
        }

        .show-more-content {
            display: none;
        }

        /* Hide buttons and links when printing */
        @media print {
            .hide-on-print {
                display: none !important;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="cv-header">
            <h1>Faculty Information</h1>
            <a href="index.php" class="btn btn-primary hide-on-print">Back</a>
            &nbsp; ||
            <button class="btn btn-primary hide-on-print" id="printButton">Print</button>
        </div>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="true">Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="publications-tab" data-toggle="tab" href="#publications" role="tab"
                    aria-controls="publications" aria-selected="false">Publications</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="conferences-tab" data-toggle="tab" href="#conferences" role="tab"
                    aria-controls="conferences" aria-selected="false">Conferences, Seminars and Workshops</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab"
                    aria-controls="experience" aria-selected="false">Experience</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Profile tab -->
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Personal Information Section -->
                <table class="cv-table">
                    <tr>
                        <th colspan="2">Personal Information</th>
                    </tr>
                    <tr>
                        <td>First Name:</td>
                        <td><?= $fname ?></td>
                    </tr>
                    <tr>
                        <td>Last Name:</td>
                        <td><?= $lname ?></td>
                    </tr>
                    <tr>
                        <td>Designation:</td>
                        <td><?= $designation ?></td>
                    </tr>
                    <tr>
                        <td>Experience (Years):</td>
                        <td><?= $experience ?></td>
                    </tr>
                    <tr>
                        <td>Experience Details:</td>
                        <td><?= nl2br($experience_details) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Publications tab -->
            <div class="tab-pane fade" id="publications" role="tabpanel" aria-labelledby="publications-tab">
                <!-- Academic Information Section -->
                <table class="cv-table">
                    <tr>
                        <th colspan="2">Publications</th>
                    </tr>
                    <tr>
                        <td>Publications:</td>
                        <td><?= $publications ?></td>
                    </tr>
                    <tr>
                        <td>Publications Details:</td>
                        <td><?= nl2br($publications_details) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Conferences, Seminars and Workshops tab -->
            <div class="tab-pane fade" id="conferences" role="tabpanel" aria-labelledby="conferences-tab">
                <!-- Academic Information Section -->
                <table class="cv-table">
                    <tr>
                        <th colspan="2">Conferences, Seminars and Workshops</th>
                    </tr>
                    <tr>
                        <td>Conferences:</td>
                        <td><?= $conferences ?></td>
                    </tr>
                    <tr>
                        <td>Conferences Details:</td>
                        <td><?= nl2br($conferences_details) ?></td>
                    </tr>
                    <tr>
                        <td>Seminars:</td>
                        <td><?= $seminars ?></td>
                    </tr>
                    <tr>
                        <td>Seminars Details:</td>
                        <td><?= nl2br($seminars_details) ?></td>
                    </tr>
                    <tr>
                        <td>Workshops:</td>
                        <td><?= $workshops ?></td>
                    </tr>
                    <tr>
                        <td>Workshops Details:</td>
                        <td><?= nl2br($workshops_details) ?></td>
                    </tr>
                </table>
            </div>

            <!-- Experience tab -->
            <div class="tab-pane fade" id="experience" role="tabpanel" aria-labelledby="experience-tab">
                <!-- Personal Information Section -->
                <table class="cv-table">
                    <tr>
                        <th colspan="2">Experience</th>
                    </tr>
                    <tr>
                        <td>Experience (Years):</td>
                        <td><?= $experience ?></td>
                    </tr>
                    <tr>
                        <td>Experience Details:</td>
                        <td><?= nl2br($experience_details) ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print(); // Call the print function
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
