<?php
session_start();
include_once("inc/inc_connection.php");
include_once("inc/inc_function.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Academia</title>
    <link rel="stylesheet" href="<?php echo url_first()?>/css/style.css">
</head>
<body>
    <nav>
        <div class="wrapper">
            <div class="logo"><a href='<?php echo url_first()?>'>Academia</a></div>
            <div class="menu">
                <ul>
                    <li><a href="<?php echo url_first()?>#home">Home</a></li>
                    <li><a href="<?php echo url_first()?>#courses">Courses</a></li>
                    <li><a href="<?php echo url_first()?>#tutors">Tutors</a></li>
                    <li><a href="<?php echo url_first()?>#partners">Partners</a></li>
                    <li><a href="<?php echo url_first()?>#contact">Contact</a></li>
                    <li>
                    <?php if(isset($_SESSION['members_full_name'])){
                        echo "<a href='".url_first()."/edit_profile.php'>".$_SESSION['members_full_name']."</a> | <a href='".url_first()."/logout.php'>Logout</a>";
                    }else{?>
                        
                    <a href="registration.php" class="tbl-blue">Sign Up</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="wrapper">