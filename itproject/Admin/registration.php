<?php
session_start();

require 'C:/xampp/htdocs/itproject/DBconnect/Conn_accounts.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $user_type = isset($_POST['user_type']) ? $_POST['user_type'] : '';

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($user_type)) {
        die("<div class='alert alert-danger text-center'>All fields are required.</div>");
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<div class='alert alert-danger text-center'>Invalid email format.</div>");
    }

    // Check if the email already exists in any of the user tables
    $check_sql = "
        SELECT 1 
        FROM students s 
        INNER JOIN teacher t ON s.student_email = t.teacher_email
        INNER JOIN admin a ON s.student_email = a.admin_email
        WHERE s.student_email = ? OR t.teacher_email = ? OR a.admin_email = ?
    ";
    
    // Prepare the query
    $check_statement = $conn->prepare($check_sql);
    $check_statement->bind_param("sss", $email, $email, $email);

    // Execute the query
    $check_statement->execute();
    $check_statement->store_result();

    // Check if email is a CU corporate email
    if (!preg_match('/@g\.cu\.edu\.ph$/', $email)) {
        exit("<div class='alert alert-danger text-center'>Please use your CU corporate email.</div>");
    }
    
    // If email exists
    if ($check_statement->num_rows > 0) {
        die("<div class='alert alert-danger text-center'>Email is already registered.</div>");
    }

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Choose the correct table based on user type
    if ($user_type == "Student") {
        $sql = "INSERT INTO students (student_name, student_email, user_password) VALUES (?, ?, ?)";
    } elseif ($user_type == "Teacher") {
        $sql = "INSERT INTO teacher (teacher_name, teacher_email, user_password) VALUES (?, ?, ?)";
    } elseif ($user_type == "Admin") {
        $sql = "INSERT INTO admin (admin_name, admin_email, user_password) VALUES (?, ?, ?)";
    } else {
        die("<div class='alert alert-danger text-center'>Invalid user type selected.</div>");
    }

    // Prepare SQL statement
    $statement = $conn->prepare($sql);
    $statement->bind_param("sss", $name, $email, $hashed_password);

    // Execute and check for success
    if ($statement->execute()) {
        // Redirect after success
        echo "<div class='alert alert-success text-center'>Registration successful! Redirecting...<script>setTimeout(function(){ window.location.href = 'viewadmin.php'; }, 2000);</script></div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $statement->error . "</div>";
    }

    $check_statement->close();
    $statement->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
    <style>
        body {
            background: url("../img/body.jpg") no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .header {
            text-align: center;
            padding: 15px;
        }

        .btn-custom {
            background: grey;
            border: none;
            color: white;
            transition: background 0.3s ease-in-out;
        }

        .btn-custom:hover {
            background: #0056b3;
        }

        .navbar {
            padding: 8px 15px;
            background-color: #343a40;
        }

        .navbar-brand img {
            height: 35px;
            width: auto;
        }

        .navbar-nav .nav-link {
            font-size: 14px;
            padding: 5px 10px;
        }

        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
            }

            .navbar-nav .nav-link {
                padding: 10px;
            }
        }
    </style>
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
                <li class="nav-item"><a class="nav-link text-white" href="/itproject/Admin/admin.php">Admin Panel</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/itproject/aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="/itproject/Login/login.php"><i class="fa-regular fa-user"></i> Log in</a></li>
            </ul>
        </div>
    </nav>

    <div class="container"><br><br>
        <div class="card p-4">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="header">
                    <h2 class="text-dark">Appointment Scheduling System</h2>
                    <p>Register for an account</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">User Type</label>
                    <div>
                        <input type="radio" id="student" name="user_type" value="Student" required>
                        <label for="student">Student</label>
                        <input type="radio" id="teacher" name="user_type" value="Teacher" required>
                        <label for="teacher">Teacher</label>
                        <input type="radio" id="admin" name="user_type" value="Admin" required>
                        <label for="admin">Admin</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">CU Corporate Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
                <button type="submit" class="btn btn-custom w-100 text-white">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
