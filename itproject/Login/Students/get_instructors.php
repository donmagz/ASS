<?php
require 'C:\xampp\htdocs\itproject\DBconnect\Accounts\overall.php';

if (isset($_GET['departments'])) {
    $departmentName = $_GET['departments'];

    // Prepare the query to fetch teachers with the matching department_name
    $stmt = $conn->prepare("SELECT teacher_name FROM teacher WHERE departments = ?");
    $stmt->bind_param("s", $departmentName);
    $stmt->execute();
    $result = $stmt->get_result();

    // Provide the option to select an instructor
    echo '<option value="">Select Instructor</option>';

    // Loop through the result set and display the teacher names
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['teacher_name']) . '">' . htmlspecialchars($row['teacher_name']) . '</option>';
    }

    // Close the statement (no need to close the connection here, as it's done in the main script)
    $stmt->close();
}
?>
