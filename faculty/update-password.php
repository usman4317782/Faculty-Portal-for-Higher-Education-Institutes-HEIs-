<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>
<?php
require_once "../db_connect.php";

$errors = [];
$msg = '';

$teacher_id = $_SESSION['id'];

$sql = "SELECT * FROM teachers WHERE id = '$teacher_id'";
$db_result = mysqli_query($conn, $sql);
if ($db_result && mysqli_num_rows($db_result) > 0) {
    $row = mysqli_fetch_assoc($db_result);
} else {
    $msg = "<p class='text text-center text-danger font-weight-bold'>Error: Unable to fetch teacher data from the database.</p>";
    exit(); // Add exit to stop further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    // Check if current password matches the one in the database
    if (password_verify($current_password, $row['password'])) {
        // Check if new password and confirm new password match
        if ($new_password === $confirm_new_password) {
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            // Update the password in the database
            $update_sql = "UPDATE teachers SET password = '$hashed_password' WHERE id = '$teacher_id'";
            if (mysqli_query($conn, $update_sql)) {
                $msg = "<p class='text text-center text-success font-weight-bold'>Password updated successfully</p>";
            } else {
                $msg = "<p class='text text-center text-danger font-weight-bold'>Error updating password</p>";
            }
        } else {
            $errors['confirm_new_password'] = "New password and confirm new password do not match";
        }
    } else {
        $errors['current_password'] = "Current password is incorrect";
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="profile-registration.php"><i class="fa fa-university"></i> Faculty Portal for Higher
                Education Institutes (HEIs)</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="profile-registration.php"><i class="fa fa-user-circle"></i> Profile <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cv.php"><i class="fa fa-address-card"></i> CV <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="update-password.php"><i class="fa fa-key"></i> Update Password <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../logout.php" onclick="return confirm('Logout Confirmation');"><i class="fa fa-sign-out"></i> Logout <span class="sr-only">(current)</span></a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mb-4">Update Password</h2>
                <?php if (!empty($msg)) echo $msg; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label for="current_password">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                        <?php if (isset($errors['current_password'])) echo "<p class='text-danger'>" . $errors['current_password'] . "</p>"; ?>
                    </div>
                    <div class="form-group">
                        <label for="new_password">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm_new_password">Confirm New Password</label>
                        <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" required>
                        <?php if (isset($errors['confirm_new_password'])) echo "<p class='text-danger'>" . $errors['confirm_new_password'] . "</p>"; ?>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Password</button>
                </form>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>