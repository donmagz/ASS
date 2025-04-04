<?php
session_start();
require 'C:/xampp/htdocs/itproject/DBconnect/Conn_accounts.php';

// Fetch users
$sql_students = "SELECT student_id, student_name, student_email FROM students";
$sql_teachers = "SELECT teacher_id, teacher_name, teacher_email FROM teacher";
$sql_admins = "SELECT admin_id, admin_name, admin_email FROM admin";

$students_result = $conn->query($sql_students);
$teachers_result = $conn->query($sql_teachers);
$admins_result = $conn->query($sql_admins);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\aboutus.php">About Us</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="\itproject\Login\login.php"><i class="fa-regular fa-user"></i> Log in</a></li>
                <a href="logout.php" class="btn btn-danger">Log Out</a>
            </ul>
        </div>
    </nav>

<div class="container mt-5">
    <h1>ACCOUNTS</h1>
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="table-dark">
                <tr>
                    <th>User Type</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th colspan="2">Custom</th>
                </tr>
            </thead>
            <tbody>

            <!-- Students -->
            <tr><th colspan="5" class="table-dark">Students</th></tr>
            <?php while($student = $students_result->fetch_assoc()): ?>
                <tr>
                    <td>Student</td>
                    <td><?= $student['student_name'] ?></td>
                    <td><?= $student['student_email'] ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="<?= $student['student_id'] ?>"
                            data-type="student">EDIT</button>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $student['student_id'] ?>&type=student" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            <!-- Teachers -->
            <tr><th colspan="5" class="table-dark">Teachers</th></tr>
            <?php while($teacher = $teachers_result->fetch_assoc()): ?>
                <tr>
                    <td>Teacher</td>
                    <td><?= $teacher['teacher_name'] ?></td>
                    <td><?= $teacher['teacher_email'] ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="<?= $teacher['teacher_id'] ?>"
                            data-type="teacher">EDIT</button>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $teacher['teacher_id'] ?>&type=teacher" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            <!-- Admins -->
            <tr><th colspan="5" class="table-dark">Admins</th></tr>
            <?php while($admin = $admins_result->fetch_assoc()): ?>
                <tr>
                    <td>Admin</td>
                    <td><?= $admin['admin_name'] ?></td>
                    <td><?= $admin['admin_email'] ?></td>
                    <td>
                        <button class="btn btn-primary btn-sm editBtn"
                            data-id="<?= $admin['admin_id'] ?>"
                            data-type="admin">EDIT</button>
                    </td>
                    <td>
                        <a href="delete.php?id=<?= $admin['admin_id'] ?>&type=admin" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Are you sure?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog">
    <form id="editForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Account</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id" id="edit_id">
          <input type="hidden" name="type" id="edit_type">

          <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" name="name" id="edit_name" >
          </div>
          <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="edit_email" >
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="edit_password" >
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function () {
    $('.editBtn').on('click', function () {
        let id = $(this).data('id');
        let type = $(this).data('type');

        $.ajax({
            url: 'fetch_user.php',
            type: 'GET',
            data: { id: id, type: type },
            success: function (response) {
                let user = JSON.parse(response);
                $('#edit_id').val(id);
                $('#edit_type').val(type);
                $('#edit_name').val(user.name);
                $('#edit_email').val(user.email);
                $('#edit_passwrd').val(user.password);
                new bootstrap.Modal(document.getElementById('editModal')).show();
            }
        });
    });

    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        $.post('update_user.php', $(this).serialize(), function () {
            alert('Account updated!');
            location.reload();
        }).fail(function () {
            alert('Update failed.');
        });
    });
});
</script>

</body>
</html>

<?php $conn->close(); ?>
