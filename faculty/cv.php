<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit(); // Exit after redirection
}

require_once "../db_connect.php";

// Fetch existing data from the database
$teacher_id = $_SESSION['id'];

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
    $email = $row['email'];
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
            <h1>Curriculum Vitae</h1>
            <a href="profile-registration.php" class="btn btn-primary hide-on-print">Back</a>
            &nbsp; ||
            <button class="btn btn-primary hide-on-print" id="printButton">Print CV</button>
        </div>

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

        <!-- Academic Information Section -->
        <table class="cv-table">
            <tr>
                <th colspan="2">Academic Information</th>
            </tr>
            <tr>
                <td>Publications:</td>
                <td><?= $publications ?></td>
            </tr>
            <tr>
                <td>Publications Details:</td>
                <td><?= nl2br($publications_details) ?></td>
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

        <!-- Contact Information Section -->
        <table class="cv-table">
            <tr>
                <th colspan="2">Contact Information</th>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?= $email ?></td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td><?= $phone ?></td>
            </tr>
            <tr>
                <td>City:</td>
                <td><?= $city ?></td>
            </tr>
            <tr>
                <td>Address:</td>
                <td><?= nl2br($address) ?></td>
            </tr>
        </table>

        <!-- Additional Information Section -->
        <table class="cv-table">
            <tr>
                <th colspan="2">Additional Information</th>
            </tr>
            <tr>
                <td>Qualification:</td>
                <td><?= $qualification ?></td>
            </tr>
            <tr>
                <td>Specialization:</td>
                <td><?= $specialization ?></td>
            </tr>
            <tr>
                <td>University:</td>
                <td><?= $university ?></td>
            </tr> 
            <tr>
                <td>Serving Institute:</td>
                <td><?= $serving_institute ?></td>
            </tr>
         
            <tr>
                <td>Department:</td>
                <td><?= $department ?></td>
            </tr>
            <tr>
                <td>Research Interests:</td>
                <td><?= nl2br($research_interest) ?></td>
            </tr>
            <!-- <tr>
                <td>Covering Letter:</td>
                <td><?= nl2br($coveringLetter) ?></td>
            </tr> -->
        </table>
        <!-- Covering Letter Section -->
        <table class="cv-table">
            <tr>
                <th colspan="2">Covering Letter</th>
            </tr>
            <tr>
                <td colspan="2">
                    <div id="coveringLetterContent">
                        <!-- Show only the first 100 characters -->
                        <?= substr(nl2br(html_entity_decode($coveringLetter)), 0, 100) ?>
                        <span class="show-more-content"><?= substr(nl2br($coveringLetter), 100) ?></span>
                    </div>
                    <?php if (strlen($coveringLetter) > 100) : ?>
                        <br>
                        <button id="showMoreButton" class="hide-on-print btn btn-primary btn-sm">Show more</button>
                    <?php endif; ?>
                </td>
            </tr>
        </table>

    </div>

    <script>
        document.getElementById('printButton').addEventListener('click', function() {
            window.print(); // Call the print function
        });

        // Toggle show more content
        document.getElementById('showMoreButton').addEventListener('click', function() {
            var showMoreContent = document.querySelector('.show-more-content');
            var showMoreButton = document.getElementById('showMoreButton');

            if (showMoreContent.style.display === 'none') {
                showMoreContent.style.display = 'inline'; // Show more content
                showMoreButton.textContent = 'Show less';
            } else {
                showMoreContent.style.display = 'none'; // Hide more content
                showMoreButton.textContent = 'Show more';
            }
        });
    </script>

</body>

</html>
