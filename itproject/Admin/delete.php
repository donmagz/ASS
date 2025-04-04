<?php
require 'C:/xampp/htdocs/itproject/DBconnect/Conn_accounts.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['student_id'] && $_GET['teacher_id'] && $_GET['admin_id'];
    $type = $_GET['type'];
    $table = ($type === "student") ? "students" : (($type === "teacher") ? "teacher" : "admin");

    // Delete query
    $deleteQuery = "DELETE FROM $table WHERE student_id, teacher_id, admin_id=?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header("Location: viewadmin.php");
    exit();
}
?>
