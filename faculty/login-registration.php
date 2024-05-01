<?php
require_once "../db_connect.php";
?>
<?php
$message = ''; // Initialize empty message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate form inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validation checks
    if (empty($email) || empty($city) || empty($gender) || empty($address) || empty($password)) {
        $message = "Error! All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Error! Invalid email format";
    } elseif (!ctype_alpha($city)) {
        $message = "Error! City should contain alphabets only";
    }

    // Check if email already exists in the database
    $check_query = "SELECT * FROM teachers WHERE email='$email'";
    $result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($result) > 0) {
        $message = "Error! Email already registered";
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the database
    if (empty($message)) {
        $insert_query = "INSERT INTO teachers (email, city, gender, address, password) 
                         VALUES ('$email', '$city', '$gender', '$address', '$hashed_password')";
        if (mysqli_query($conn, $insert_query)) {
            $message = "Registration successful!";
        } else {
            $message = "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Registration</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">Teacher Registration</h5>
                        <form action="" method="post">
                            <?php if (!empty($message)) : ?>
                                <div class="alert alert-<?php echo (strpos($message, 'Error') !== false) ? 'danger' : 'success'; ?>" role="alert">
                                    <?php echo $message; ?>
                                </div>
                            <?php endif; ?>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php echo $_POST['email'] ?? ""?>">
                            </div>
                            <div class="form-group">
                                <label for="city">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city" required  value="<?php echo $_POST['city'] ?? ""?>">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" id="gender" name="gender" required>
                                    <option value="Male" <?php if(isset($_POST['gender']) and $_POST['gender'] === 'Male'){echo "selected";}?>>Male</option>
                                    <option value="Female" <?php if(isset($_POST['gender']) and $_POST['gender'] === 'Female'){echo "selected";}?>>Female</option>
                                    <option value="Other" <?php if(isset($_POST['gender']) and $_POST['gender'] === 'Other'){echo "selected";}?>>Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" id="address" name="address" placeholder="Enter address" required  value="<?php echo $_POST['address'] ?? ""?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </form>
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