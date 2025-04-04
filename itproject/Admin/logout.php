<?php
session_start(); 


session_unset();
session_destroy();

header("Location: /itproject/Admin/admin.php");
exit();

?>
