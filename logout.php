<?php
session_start();
unset($_SESSION['members_email']);
unset($_SESSION['members_full_name']);
session_destroy();
header("location:index.php");
?>