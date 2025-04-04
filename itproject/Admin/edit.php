<?php
session_start();
require 'C:/xampp/htdocs/itproject/DBconnect/Conn_accounts.php';

if (!isset($_GET['id']) || !isset($_GET['type'])) {
    echo "Invalid request.";
    exit;
}

$id = $_GET['id'];
$type = $_GET['type'];

// Determine table and columns based on user type
switch ($type) {
    case 'student':
        $table = 'students';
        $id_column = 'student_id';
        $name_column = 'student_name';
        $email_column = 'student_email';
        break;
    case 'teacher':
        $table = 'teacher';
        $id_column = 'teacher_id';
        $name_column = 'teacher_name';
        $email_column = 'teacher_email';
        break;
    case 'admin':
        $table = 'admin';
        $id_column = 'admin_id';
        $name_column = 'admin_name';
        $email_column = 'admin_email';
        break;
    default:
        echo "Invalid user type.";
        exit;
}

// Fetch user data
$stmt = $conn->prepare("SELECT $name_column, $email_column FROM $table WHERE $id_column = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($name, $email);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_name = $_POST['name'];
    $new_email = $_POST['email'];

    $update = $conn->prepare("UPDATE $table SET $name_column = ?, $email_column = ? WHERE $id_column = ?");
    $update->bind_param("ssi", $new_name, $new_email, $id);

    if ($update->execute()) {
        echo "<script>alert('User updated successfully!'); window.location.href = 'viewaccounts.php';</script>";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $update->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit <?php echo ucfirst($type); ?> Account</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email:</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
        <a href="viewaccounts.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
