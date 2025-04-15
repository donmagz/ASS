<?php
session_start();
require 'C:\xampp\htdocs\itproject\DBconnect\Accounts\overall.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $id = $_POST['IDnumber'];
    $section = $_POST['section'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $description = $_POST['description'];
    $department = $_POST['department_name'];  
    $teacher = $_POST['teacher_name'];

    if (!$conn) {
        exit("Database connection failed: " . mysqli_connect_error());
    }

    $appointment_datetime = $date . " " . $time . ":00";

    $statement = $conn->prepare("INSERT INTO appointmentdb (student_name, student_ID, section, appointment_date, Description, department_name, teacher_name, Status) VALUES (?, ?, ?, ?, ?, ?, ?, 'Pending')");

    if ($statement === false) {
        die("Prepare failed: " . $conn->error);
    }

    $statement->bind_param("sssssss", $name, $id, $section, $appointment_datetime, $description, $department, $teacher);

    if ($statement->execute()) {
        $success_message = "Appointment added successfully!";
    } else {
        $error_message = "Error: " . $conn->error;
    }

    $statement->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Scheduling System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/itproject/Login/Asset/addappoint.css">
    <link rel="stylesheet" href="/itproject/Login/Asset/viewappoint.css">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img class="logo me-2" src="../../img/Alogo1.jpg" alt="Logo">
                <span>Appointment Scheduling System</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link text-white" href="\itproject\aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="\itproject\Login\login.php">Log in</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center align-items-center flex-column" style="margin-top: 75px;">
        <div class="card p-4 shadow-lg" style="max-width: 400px; width: 100%;">
            <h2 class="text-center">Appointments</h2>

            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your Name" required>
                </div>
                <div class="mb-3">
                    <label for="IDnumber" class="form-label">ID Number</label>
                    <input type="number" name="IDnumber" id="IDnumber" class="form-control" placeholder="Enter your ID Number" required>
                </div>
                <div class="mb-3">
                    <label for="section" class="form-label">Section</label>
                    <input type="text" name="section" id="section" class="form-control" placeholder="Enter your Section" required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="time" class="form-label">Time</label>
                    <input type="time" name="time" id="time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="department_name" class="form-label">Department</label>
                    <select id="department_name" name="department_name" class="form-control" required>
                        <option value="">Select Department</option>
                        <option value="Computer Studies">Computer Studies</option>
                        <option value="Education">Education</option>
                        <option value="Business and Accountancy">Business and Accountancy</option>
                        <option value="Maritime Education">Maritime Education</option>
                        <option value="Criminology">Criminology</option>
                        <option value="Engineering">Engineering</option>
                        <option value="Health and Sciences">Health and Sciences</option>
                        <option value="Art and Sciences">Art and Sciences</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="teacher_name" class="form-label">Instructor</label>
                    <select id="teacher_name" name="teacher_name" class="form-control" required>
                        <option value="">Select Instructor</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label for="description" class="form-label">Subject/Meeting Reason</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Enter details" required>
                </div>
                
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Add Appointment</button>
                    <a href="viewappoint.php" class="btn btn-primary">View Appointments</a>
                    <a href="/itproject/Login/login.php" class="btn btn-danger">Log out</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <script>
        document.getElementById("department_name").addEventListener("change", function() {
            const dept = this.value;
            const teacherSelect = document.getElementById("teacher_name");

            teacherSelect.innerHTML = '<option value="">Select Instructor</option>';

            if (dept !== "") {
                fetch("get_instructors.php?department_name=" + encodeURIComponent(dept))
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(function(name) {
                            const option = document.createElement("option");
                            option.value = name;
                            option.text = name;
                            teacherSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error("Error fetching instructors:", error);
                    });
            }
    });
    </script>

</body>
</html>
