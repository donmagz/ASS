<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Appointment Scheduling System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-3">
        <div class="container-fluid">
            <!-- Logo and Brand Name -->
            <a class="navbar-brand" href="#">
                <img src="../img/Alogo1.jpg" alt="Logo" width="50" height="50" class="d-inline-block align-text-center">Appointment Scheduling System
            </a>
            <!-- Mobile Menu Button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navigation Menu Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link text-white" href="\itproject\Admin\admin.php">Admin Panel</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="\itproject\aboutus.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="\itproject\Login\login.php"><i class="fa-regular fa-user"></i> Log in</a></li>
                </ul>
                
            </div>
        </div>
    </nav>
    
    <!-- Admin Login Form Container -->
    <div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="card p-4 shadow" style="width: 320px;">
            <h1 class="text-center">Admin Panel</h1>
            <form action="\itproject\Admin\viewadmin.php">
                <!-- Username Input -->
                <div class="mb-3">
                    <input type="text" class="form-control" id="login-username" placeholder="Username" required>
                </div>
                <!-- Password Input -->
                <div class="mb-3">
                    <input type="password" class="form-control" id="login-password" placeholder="Password" required>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="btn btn-success w-100">Login</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
