<?php
session_start();

require_once "../db_connect.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
}

// Fetch all universities from the database
$sql = "SELECT * FROM hecuniversities";
$result = mysqli_query($conn, $sql);
$universities = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<?php
//university delete module

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Delete the university record from the database
    $sql = "DELETE FROM hecuniversities WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        // Redirect back to the university list page after successful deletion
        $msg = "<p class='text text-center text-success font-weight-bold'>University record deleted successfully</p>";
        ?>
            <script>
                // Redirect to another page after 5 seconds (5000 milliseconds)
                setTimeout(function () {
                    window.location.href = 'show-university-data.php'; // Replace 'target_page.php' with your desired destination
                }, 2000); // 5000 milliseconds = 5 seconds
            </script>
        <?php
    } else {
        $msg =  "<p class='text text-center text-danger font-weight-bold'>Error deleting record: " . mysqli_error($conn).'</p>';
    }
} 

?>

<!doctype html>
<html lang="en">

<head>
    <title>Registered Universities List</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .btn-group {
            margin-bottom: 10px;
        }
    </style>

</head>

<body>
    <h2>HEC Universities</h2>

    <div class="btn-group">
        <a href="register-university.php" class="btn btn-primary">Add New University</a>
        &nbsp;
        <a href="admin-dashboard.php" class="btn btn-info">Go To Dashbaord</a>
    </div>
    <div>
        <?php echo $msg ?? "";?>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Established Year</th>
                    <th>Vice Chancellor</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Website</th>
                    <th>Accreditation Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; foreach ($universities as $university) : $count++; ?>
                    <tr>
                        <td><?= $count; ?></td>
                        <td><?= $university['name'] ?></td>
                        <td><?= $university['location'] ?></td>
                        <td><?= $university['established_year'] ?></td>
                        <td><?= $university['vice_chancellor'] ?></td>
                        <td><?= $university['email'] ?></td>
                        <td><?= $university['phone'] ?></td>
                        <td><a href="<?= $university['website'] ?>" target="_blank"><?= $university['website'] ?></a></td>
                        <td><?= $university['accreditation_status'] ?></td>
                        <td><?= $university['created_at'] ?></td>
                        <td><?= $university['updated_at'] ?></td>
                        <td>
                            <a href="update_university.php?id=<?= $university['id'] ?>" class="btn btn-primary">Update</a>
                            <a href="?id=<?= $university['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this university?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>
