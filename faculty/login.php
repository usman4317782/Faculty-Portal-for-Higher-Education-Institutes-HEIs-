<?php
session_start();
if (isset($_SESSION['id'])) {
    header("Location: profile-registration.php"); 
}
?>
<?php
require_once "../db_connect.php";
$message = ''; // Initialize empty message

if (isset($_POST['submit'])) {
    // Sanitize and validate form inputs
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Validation checks
    if (empty($email) || empty($password)) {
        $message = "Error! All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Error! Invalid email format";
    } else {
        // Check if email exists in the database
        $check_query = "SELECT * FROM teachers WHERE email='$email'";
        $result = mysqli_query($conn, $check_query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                // Password is correct, set session and redirect to profile-registration.php
                // session_start();
                $_SESSION['id'] = $row['id'];
                echo '<script>window.location.href = "profile-registration.php";</script>';
                exit();
            } else {
                $message = "Error! Incorrect password";
            }
        } else {
            $message = "Error! Email not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculty Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group label {
            font-weight: bold;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-group input[type="text"]:focus,
        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus,
        .form-group select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-reset {
            width: 100%;
            padding: 10px;
            background-color: red;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="form-container">
                    <h2 class="mb-4 text text-center">Faculty Login</h2>
                    <form action="" method="post">
                        <?php if (!empty($message)) : ?>
                            <div class="alert alert-<?php echo (strpos($message, 'Error') !== false) ? 'danger' : 'success'; ?>" role="alert">
                                <?php echo $message; ?>
                            </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" id="email" name="email" required value="<?php echo $_POST['email'] ?? ""?>">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" id="password" name="password" required>
                        </div>
                        <button type="submit" name="submit" class="btn-submit">Submit</button>
                        <br><br>
                        <button type="reset" name="reset" class="btn-reset">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>