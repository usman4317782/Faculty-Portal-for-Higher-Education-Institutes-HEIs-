<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
}
?>
<?php
require_once "../db_connect.php";

$uni_query = "SELECT name FROM hecuniversities";
$db_uni_result = mysqli_query($conn, $uni_query);

$errors = [];

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
    $hec_university = $row['hec_university'];
    $serving_institute = $row['serving_institute'];
    $department = $row['department'];
    $research_interest = $row['research_interest'];
    $coveringLetter = $row['coveringLetter'];
} else {
    $msg = "<p class='text text-center text-dagner font-weight-bold'>Error: Unable to fetch teacher data from the database.</p>";
    exit(); // Add exit to stop further execution
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $experience = mysqli_real_escape_string($conn, $_POST['experience']);
    $experience_details = mysqli_real_escape_string($conn, $_POST['experience_details']);
    $publications = mysqli_real_escape_string($conn, $_POST['publications']);
    $publications_details = mysqli_real_escape_string($conn, $_POST['publications_details']);
    $conferences = mysqli_real_escape_string($conn, $_POST['conferences']);
    $conferences_details = mysqli_real_escape_string($conn, $_POST['conferences_details']);
    $seminars = mysqli_real_escape_string($conn, $_POST['seminars']);
    $seminars_details = mysqli_real_escape_string($conn, $_POST['seminars_details']);
    $workshops = mysqli_real_escape_string($conn, $_POST['workshops']);
    $workshops_details = mysqli_real_escape_string($conn, $_POST['workshops_details']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
    $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
    $serving_institute = mysqli_real_escape_string($conn, $_POST['serving_institute']);
    $hec_university = mysqli_real_escape_string($conn, $_POST['hec_university']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $research_interest = mysqli_real_escape_string($conn, $_POST['research_interest']);
    $coveringLetter = mysqli_real_escape_string($conn, $_POST['coveringLetter']);

    // First Name and Last Name validation
    if (!preg_match("/^[a-zA-Z ]{3,}$/", $fname)) {
        $errors['fname'] = "First Name is invalid (should be alphabets and spaces, minimum length 3)";
    }
    if (!preg_match("/^[a-zA-Z ]{3,}$/", $lname)) {
        $errors['lname'] = "Last Name is invalid (should be alphabets and spaces, minimum length 3)";
    }

    // Experience, Publications, Conferences, Seminars, Workshops validation
    if ($experience < 0) {
        $errors['experience'] = "Experience should be a positive number";
    }
    if ($publications < 0) {
        $errors['publications'] = "Publications should be a positive number";
    }
    if ($conferences < 0) {
        $errors['conferences'] = "Conferences should be a positive number";
    }
    if ($seminars < 0) {
        $errors['seminars'] = "Seminars should be a positive number";
    }
    if ($workshops < 0) {
        $errors['workshops'] = "Workshops should be a positive number";
    }

    // Phone number validation (Pakistan format)
    if (!preg_match("/\+92[0-9]{10}/", $phone)) {
        $errors['phone'] = "Phone number is invalid. Please use Pakistani phone number format (+92XXXXXXXXXX)";
    }

    // If there are no validation errors, proceed with insertion
    if (empty($errors)) {
        // Insert data into database
        // $sql = "INSERT INTO teachers (fname, lname, designation, experience, experience_details, publications, publications_details, conferences, conferences_details, seminars, seminars_details, workshops, workshops_details, city, address, phone, qualification, specialization, serving_institute, department, research_interest, coveringLetter) 
        // VALUES ('$fname', '$lname', '$designation', '$experience', '$experience_details', '$publications', '$publications_details', '$conferences', '$conferences_details', '$seminars', '$seminars_details', '$workshops', '$workshops_details', '$city', '$address', '$phone', '$qualification', '$specialization', '$serving_institute', '$department', '$research_interest', '$coveringLetter')";

        $sql = "UPDATE teachers SET 
            fname = '$fname',
            lname = '$lname',
            designation = '$designation',
            experience = '$experience',
            experience_details = '$experience_details',
            publications = '$publications',
            publications_details = '$publications_details',
            conferences = '$conferences',
            conferences_details = '$conferences_details',
            seminars = '$seminars',
            seminars_details = '$seminars_details',
            workshops = '$workshops',
            workshops_details = '$workshops_details',
            city = '$city',
            address = '$address',
            phone = '$phone',
            qualification = '$qualification',
            specialization = '$specialization',
            hec_university = '$hec_university',
            serving_institute = '$serving_institute',
            department = '$department',
            research_interest = '$research_interest',
            coveringLetter = '$coveringLetter'
        WHERE id = '$teacher_id'";

        if (mysqli_query($conn, $sql)) {
            $msg = "<p class='text text-center text-success font-weight-bold'>New record created successfully</p>";
        } else {
            $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Information Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Custom styles */
        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 0;
        }

        .btn-primary {
            border-radius: 0;
        }
    </style>
</head>

<body>

  
    <div class="container">

        <?php
        echo $msg ?? "";
        ?>
        <h2 class="mt-5 mb-4">
            Teacher Information Form
        </h2>
        <form action="" method="post">
            <!-- Personal Information Section -->
            <div class="card mb-4">
                <div class="card-header">Personal Information</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fname">First Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= isset($errors['fname']) ? 'is-invalid' : '' ?>" id="fname" name="fname" placeholder="Enter first name" value="<?= isset($fname) ? htmlspecialchars($fname) : (isset($_POST['fname']) ? htmlspecialchars($_POST['fname']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['fname']) ? $errors['fname'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="lname">Last Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= isset($errors['lname']) ? 'is-invalid' : '' ?>" id="lname" name="lname" placeholder="Enter last name" value="<?= isset($lname) ? htmlspecialchars($lname) : (isset($_POST['lname']) ? htmlspecialchars($_POST['lname']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['lname']) ? $errors['lname'] : '' ?></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="designation">Designation<span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?= isset($errors['designation']) ? 'is-invalid' : '' ?>" id="designation" name="designation" placeholder="Enter designation" value="<?= isset($designation) ? htmlspecialchars($designation) : (isset($_POST['designation']) ? htmlspecialchars($_POST['designation']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['designation']) ? $errors['designation'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="experience">Experience (Years)<span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?= isset($errors['experience']) ? 'is-invalid' : '' ?>" id="experience" name="experience" placeholder="Enter years of experience" value="<?= isset($experience) ? htmlspecialchars($experience) : (isset($_POST['experience']) ? htmlspecialchars($_POST['experience']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['experience']) ? $errors['experience'] : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="experience_details">Experience Details<span class="text-danger">*</span></label>
                        <textarea class="form-control <?= isset($errors['experience_details']) ? 'is-invalid' : '' ?>" id="experience_details" name="experience_details" placeholder="Enter details of experience" rows="4" required><?= isset($experience_details) ? htmlspecialchars($experience_details) : (isset($_POST['experience_details']) ? htmlspecialchars($_POST['experience_details']) : '') ?></textarea>
                        <div class="invalid-feedback"><?= isset($errors['experience_details']) ? $errors['experience_details'] : '' ?></div>
                    </div>

                </div>
            </div>

            <!-- Academic Information Section -->
            <div class="card mb-4">
                <div class="card-header">Academic Information</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publications">Publications<span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?= isset($errors['publications']) ? 'is-invalid' : '' ?>" id="publications" name="publications" placeholder="Enter number of publications" value="<?= isset($publications) ? htmlspecialchars($publications) : (isset($_POST['publications']) ? htmlspecialchars($_POST['publications']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['publications']) ? $errors['publications'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="publications_details">Publications Details<span class="text-danger">*</span></label>
                                <textarea class="form-control <?= isset($errors['publications_details']) ? 'is-invalid' : '' ?>" id="publications_details" name="publications_details" placeholder="Enter details of publications" rows="4" required><?= isset($publications_details) ? htmlspecialchars($publications_details) : (isset($_POST['publications_details']) ? htmlspecialchars($_POST['publications_details']) : '') ?></textarea>
                                <div class="invalid-feedback"><?= isset($errors['publications_details']) ? $errors['publications_details'] : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conferences">Conferences<span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?= isset($errors['conferences']) ? 'is-invalid' : '' ?>" id="conferences" name="conferences" placeholder="Enter number of conferences attended" value="<?= isset($conferences) ? htmlspecialchars($conferences) : (isset($_POST['conferences']) ? htmlspecialchars($_POST['conferences']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['conferences']) ? $errors['conferences'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conferences_details">Conferences Details<span class="text-danger">*</span></label>
                                <textarea class="form-control <?= isset($errors['conferences_details']) ? 'is-invalid' : '' ?>" id="conferences_details" name="conferences_details" placeholder="Enter details of conferences" rows="4" required><?= isset($conferences_details) ? htmlspecialchars($conferences_details) : (isset($_POST['conferences_details']) ? htmlspecialchars($_POST['conferences_details']) : '') ?></textarea>
                                <div class="invalid-feedback"><?= isset($errors['conferences_details']) ? $errors['conferences_details'] : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seminars">Seminars<span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?= isset($errors['seminars']) ? 'is-invalid' : '' ?>" id="seminars" name="seminars" placeholder="Enter number of seminars attended" value="<?= isset($seminars) ? htmlspecialchars($seminars) : (isset($_POST['seminars']) ? htmlspecialchars($_POST['seminars']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['seminars']) ? $errors['seminars'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="seminars_details">Seminars Details<span class="text-danger">*</span></label>
                                <textarea class="form-control <?= isset($errors['seminars_details']) ? 'is-invalid' : '' ?>" id="seminars_details" name="seminars_details" placeholder="Enter details of seminars" rows="4" required><?= isset($seminars_details) ? htmlspecialchars($seminars_details) : (isset($_POST['seminars_details']) ? htmlspecialchars($_POST['seminars_details']) : '') ?></textarea>
                                <div class="invalid-feedback"><?= isset($errors['seminars_details']) ? $errors['seminars_details'] : '' ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="workshops">Workshops<span class="text-danger">*</span></label>
                                <input type="number" class="form-control <?= isset($errors['workshops']) ? 'is-invalid' : '' ?>" id="workshops" name="workshops" placeholder="Enter number of workshops attended" value="<?= isset($workshops) ? htmlspecialchars($workshops) : (isset($_POST['workshops']) ? htmlspecialchars($_POST['workshops']) : '') ?>" required>
                                <div class="invalid-feedback"><?= isset($errors['workshops']) ? $errors['workshops'] : '' ?></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="workshops_details">Workshops Details<span class="text-danger">*</span></label>
                                <textarea class="form-control <?= isset($errors['workshops_details']) ? 'is-invalid' : '' ?>" id="workshops_details" name="workshops_details" placeholder="Enter details of workshops" rows="4" required><?= isset($workshops_details) ? htmlspecialchars($workshops_details) : (isset($_POST['workshops_details']) ? htmlspecialchars($_POST['workshops_details']) : '') ?></textarea>
                                <div class="invalid-feedback"><?= isset($errors['workshops_details']) ? $errors['workshops_details'] : '' ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Contact Information Section -->
            <div class="card mb-4">
                <div class="card-header">Contact Information</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="phone">Phone<span class="text-danger">*</span></label>
                        <input type="text" class="form-control <?= isset($errors['phone']) ? 'is-invalid' : '' ?>" id="phone" name="phone" placeholder="Enter phone number" value="<?= isset($phone) ? htmlspecialchars($phone) : (isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '') ?>" required>
                        <div class="invalid-feedback"><?= isset($errors['phone']) ? $errors['phone'] : '' ?></div>
                    </div>

                    <div class="form-group">
                        <label for="city">City<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" value="<?= isset($city) ? htmlspecialchars($city) : (isset($_POST['city']) ? htmlspecialchars($_POST['city']) : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="address" name="address" placeholder="Enter address" rows="4" required><?= isset($address) ? htmlspecialchars($address) : (isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '') ?></textarea>
                    </div>
                </div>
            </div>


            <!-- Additional Information Section -->
            <div class="card mb-4">
                <div class="card-header">Additional Information</div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="qualification">Qualification<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="qualification" name="qualification" placeholder="Enter qualification" value="<?= isset($qualification) ? htmlspecialchars($qualification) : (isset($_POST['qualification']) ? htmlspecialchars($_POST['qualification']) : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="specialization">Specialization<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Enter specialization" value="<?= isset($specialization) ? htmlspecialchars($specialization) : (isset($_POST['specialization']) ? htmlspecialchars($_POST['specialization']) : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="hec_university">HEC University<span class="text-danger">*</span></label>
                        <select class="form-control" id="hec_university" name="hec_university">
                            <option value="" selected disabled>Select University</option>
                            <?php
                            if ($db_uni_result && mysqli_num_rows($db_uni_result) > 0) {
                                while ($row = mysqli_fetch_assoc($db_uni_result)) {
                                    echo "<option value='" . $row['name'] . "'";
                                    if ($row['name'] == $hec_university) {
                                        echo " selected";
                                    }
                                    echo ">" . $row['name'] . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>No universities found</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="serving_institute">Serving Institute<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="serving_institute" name="serving_institute" placeholder="Enter serving institute" value="<?= isset($serving_institute) ? htmlspecialchars($serving_institute) : (isset($_POST['serving_institute']) ? htmlspecialchars($_POST['serving_institute']) : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="department">Department<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="department" name="department" placeholder="Enter department" value="<?= isset($department) ? htmlspecialchars($department) : (isset($_POST['department']) ? htmlspecialchars($_POST['department']) : '') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="research_interest">Research Interests<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="research_interest" name="research_interest" placeholder="Enter research interests" rows="4" required><?= isset($research_interest) ? htmlspecialchars($research_interest) : (isset($_POST['research_interest']) ? htmlspecialchars($_POST['research_interest']) : '') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="coveringLetter">Covering Letter<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="coveringLetter" name="coveringLetter" placeholder="Enter covering letter" rows="4" required><?= isset($coveringLetter) ? htmlspecialchars($coveringLetter) : (isset($_POST['coveringLetter']) ? htmlspecialchars($_POST['coveringLetter']) : '') ?></textarea>
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="show-faculty-list.php" class="btn btn-info">Go to List</a>
        </form>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>