<?php
session_start();
require 'C:/xampp/htdocs/itproject/DBconnect/Conn_accounts.php' ;

// Fetch users from the database
$sql_students = "SELECT student_name, student_email FROM students";
$sql_teachers = "SELECT teacher_name, teacher_email FROM teacher";
$sql_admins = "SELECT admin_name, admin_email FROM admin";

// Execute queries
$students_result = $conn->query($sql_students);
$teachers_result = $conn->query($sql_teachers);
$admins_result = $conn->query($sql_admins);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Scheduling</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="viewadmin.css">
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <a class="navbar-brand" href="#">
            <img src="../img/Alogo1.jpg" alt="Logo"> Appointment Scheduling
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\Admin\registration.php">Create Account</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\Admin\admin.php">Admin Panel</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\Login\login.php"><i class="fa-regular fa-user"></i> Log in</a></li>
            </ul>
        </div>
    </nav>

    <div class="container3">
        <h1>PANEL</h1>
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>User Type</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Display Students -->
                    <tr><th colspan="3" class="table-dark text-center">Students</th></tr>
                    <?php while($student = $students_result->fetch_assoc()): ?>
                        <tr>
                            <td>Student</td>
                            <td><?php echo $student['student_name']; ?></td>
                            <td><?php echo $student['student_email']; ?></td>
                        </tr>
                    <?php endwhile; ?>

                    <!-- Display Teachers -->
                    <tr><th colspan="3" class="table-dark text-center">Teachers</th></tr>
                    <?php while($teacher = $teachers_result->fetch_assoc()): ?>
                        <tr>
                            <td>Teacher</td>
                            <td><?php echo $teacher['teacher_name']; ?></td>
                            <td><?php echo $teacher['teacher_email']; ?></td>
                        </tr>
                    <?php endwhile; ?>

                    <!-- Display Admins -->
                    <tr><th colspan="3" class="table-dark text-center">Admins</th></tr>
                    <?php while($admin = $admins_result->fetch_assoc()): ?>
                        <tr>
                            <td>Admin</td>
                            <td><?php echo $admin['admin_name']; ?></td>
                            <td><?php echo $admin['admin_email']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <a href="\itproject\Admin\admin.php" class="btn btn-danger btn-logout">Log Out</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
