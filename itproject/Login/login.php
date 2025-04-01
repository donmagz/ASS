<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Scheduling System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="login.css">
</head>
<body class="d-flex flex-column justify-content-center align-items-center">

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-3">
        <a class="navbar-brand" href="#">
            <img class="logo me-2" src="../img/Alogo1.png" alt="Logo">
            <span class="text-white fw-bold">Appointment Scheduling</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\Admin\admin.php">Admin Panel</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white rounded-pill" href="\itproject\Login\login.php">
                    <i class="fa-regular fa-user"></i> Log in</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Login Form -->
    <div class="container mt-5">
        <div class="container-box mx-auto text-center">
            <h2 class="mb-4">Login</h2>
            <form action="\itproject\Login\addappoint.php">
                <div class="mb-3">
                    
                    <input type="number" name="ID" class="form-control" placeholder="ID Number" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button type="submit" class="btn btn-login w-100">Login</button>
                <a href="#" class="link">Create an Account</a>
                <a href="#" class="link">Forgot Password?</a>
            </form>
        </div>
    </div>

   

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
