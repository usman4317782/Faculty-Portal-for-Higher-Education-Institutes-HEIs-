<?php
session_start();

require_once "../db_connect.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
}

if (isset($_GET['id'])) {
    $university_id = $_GET['id'];

    // Fetch university data from the database
    $query = "SELECT * FROM hecuniversities WHERE id = $university_id";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $university_data = mysqli_fetch_assoc($result);
    } else {
        echo "University not found.";
        exit;
    }
} else {
    echo "University ID not provided.";
    exit;
}

?>

<?php
//university 
if (isset($_POST['submit'])) {
    // Function to sanitize user input
    function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Validate and sanitize form inputs
    $name = sanitizeInput($_POST['name']);
    $location = sanitizeInput($_POST['location']);
    $established_year = intval($_POST['established_year']);
    $vice_chancellor = sanitizeInput($_POST['vice_chancellor']);
    $email = sanitizeInput($_POST['email']);
    $phone = sanitizeInput($_POST['phone']);
    $website = sanitizeInput($_POST['website']);
    $accreditation_status = sanitizeInput($_POST['accreditation_status']);

    // Validate inputs
    $errors = array();

    // Name validation: Only alphabets and white space allowed
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $errors['name'] = "Only alphabets and white space allowed";
    }

    // Location validation: Valid address format
    // You can add your own validation logic here

    // Year validation: Valid year format
    if (!filter_var($established_year, FILTER_VALIDATE_INT) || $established_year < 1000 || $established_year > date("Y")) {
        $errors['established_year'] = "Invalid year format";
    }

    // Vice Chancellor validation: Only alphabets and white space allowed
    if (!preg_match("/^[a-zA-Z. ]+$/", $vice_chancellor)) {
        $errors['vice_chancellor'] = "Only alphabets and white space allowed";
    }

    // Email validation: Valid email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format";
    }

    // Phone validation: Pakistani valid phone number format
    // You can add your own validation logic here

    // Website validation: Valid URL format
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
        $errors['website'] = "Invalid website format";
    }

    // Accreditation Status validation: You can add your own validation logic here

    // Check if university name, email, and phone number already exist in the database for other universities
    $check_query = "SELECT * FROM hecuniversities WHERE (name='$name' OR email='$email' OR phone='$phone') AND id != $university_id";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        $errors['existing_data'] = "University name, email, or phone number already exists for another university";
    }

    // Update data into the database if no errors
    if (empty($errors)) {
        // Convert all data to lowercase
        $name = strtolower($name);
        $email = strtolower($email);
        $phone = strtolower($phone);

        // Update data into the database
        $update_query = "UPDATE hecuniversities SET name='$name', location='$location', established_year=$established_year, vice_chancellor='$vice_chancellor', email='$email', phone='$phone', website='$website', accreditation_status='$accreditation_status' WHERE id = $university_id";
        if (mysqli_query($conn, $update_query)) {
            $msg = "<p class='text text-center text-success font-weight-bold mb-4 mt-4'>University record updated successfully!</p>";
        } else {
            $msg = "<p class='text text-center text-danger font-weight-bold mb-4 mt-4'>Error updating record: " . mysqli_error($conn) . '</p>';
        }
    } else {
        // Display validation errors
        foreach ($errors as $error) {
            $msg = "<p class='text text-center text-danger font-weight-bold mb-4 mt-4'>$error</p>";
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Update University</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <h2 class="mt-4 mb-4 text text-center text-info text-uppercase">Update University</h2>
        <form action="" method="post">
            <?php echo $msg ?? "";?>
            <div class="form-group">
                <label for="name">Name:</label>
                <input class="form-control" type="text" id="name" name="name" value="<?php echo isset($university_data['name']) ? htmlspecialchars($university_data['name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="location">Location:</label>
                <input class="form-control" type="text" id="location" name="location" value="<?php echo isset($university_data['location']) ? htmlspecialchars($university_data['location']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="established_year">Established Year:</label>
                <input class="form-control" type="number" id="established_year" name="established_year" value="<?php echo isset($university_data['established_year']) ? htmlspecialchars($university_data['established_year']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="vice_chancellor">Vice Chancellor:</label>
                <input class="form-control" type="text" id="vice_chancellor" name="vice_chancellor" value="<?php echo isset($university_data['vice_chancellor']) ? htmlspecialchars($university_data['vice_chancellor']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo isset($university_data['email']) ? htmlspecialchars($university_data['email']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input class="form-control" type="text" id="phone" name="phone" value="<?php echo isset($university_data['phone']) ? htmlspecialchars($university_data['phone']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="website">Website:</label>
                <input class="form-control" type="text" id="website" name="website" value="<?php echo isset($university_data['website']) ? htmlspecialchars($university_data['website']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="accreditation_status">Accreditation Status:</label>
                <input class="form-control" type="text" id="accreditation_status" name="accreditation_status" value="<?php echo isset($university_data['accreditation_status']) ? htmlspecialchars($university_data['accreditation_status']) : ''; ?>" required>
            </div>
            <input type="submit" name="submit" class="btn btn-success" value="Update">
            <a class="btn btn-info" href="admin-dashboard.php" target="_blank" rel="noopener noreferrer" class="btn btn-sm btn-info">Dashboard</a>
        </form>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
