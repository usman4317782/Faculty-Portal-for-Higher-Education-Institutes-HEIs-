<?php
session_start();

require_once "../db_connect.php";

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
}

// Delete Teacher
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_delete = "DELETE FROM teachers WHERE id = $id";
    if(mysqli_query($conn, $sql_delete)) {
        $msg = "<p class='text text-center text-success font-weight-bold'>Record deleted successfuly</p>";
        header("refresh:1; url=show-faculty-list.php");
        // exit();
    } else {
        $msg = "<p class='text text-center text-danger font-weight-bold'>Error deleting record: " . mysqli_error($conn).'</p>';
    }
}

// Fetch all teachers from the database
$sql = "SELECT * FROM teachers";
$result = mysqli_query($conn, $sql);
$teachers = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <title>Registered Teachers List</title>
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
    <h2>Registered Teachers</h2>

    <div class="btn-group">
        <a href="register-faculty.php" class="btn btn-primary">Add New Teacher</a>
        &nbsp;
        <a href="admin-dashboard.php" class="btn btn-info">Back to Dashboard</a>
    </div>

    <div class="table-responsive">
        <?php echo $msg ?? "";?>
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th>Sr#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Designation</th>
                    <th>Experience (years)</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>City</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Qualification</th>
                    <th>Specialization</th>
                    <th>HEC University</th>
                    <th>Serving Institute</th>
                    <th>Department</th>
                    <th>Research Interests</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $count=0; foreach ($teachers as $teacher) : $count++; ?>
                    <tr>
                        <td><?= $count; ?></td>
                        <td><?= $teacher['fname'] ?></td>
                        <td><?= $teacher['lname'] ?></td>
                        <td><?= $teacher['designation'] ?></td>
                        <td><?= $teacher['experience'] ?></td>
                        <td><?= $teacher['email'] ?></td>
                        <td><?= $teacher['phone'] ?></td>
                        <td><?= $teacher['city'] ?></td>
                        <td><?= $teacher['gender'] ?></td>
                        <td><?= $teacher['address'] ?></td>
                        <td><?= $teacher['qualification'] ?></td>
                        <td><?= $teacher['specialization'] ?></td>
                        <td><?= $teacher['hec_university'] ?></td>
                        <td><?= $teacher['serving_institute'] ?></td>
                        <td><?= $teacher['department'] ?></td>
                        <td><?= $teacher['research_interest'] ?></td>
                        <td>
                            <a href="update-teacher.php?id=<?= $teacher['id'] ?>" class="btn btn-primary">Update</a>
                            <a href="?id=<?= $teacher['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this teacher?')">Delete</a>
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
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous">
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
