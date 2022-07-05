
<?php include("inc_header.php")?>
<?php 
if($_SESSION['members_email'] == ''){ //dia belum login
    header("location:login.php");
    exit();
}
?>
<div style="background-color: red;font-size:large;padding:50px;color:#FFFFFF;text-align:center">
Welcome <?php echo $_SESSION['members_full_name']?> to Secret Member Page. Only those who have logged in can access this page.
</div>
<?php include("inc_footer.php")?>
