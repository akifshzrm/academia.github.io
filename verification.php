<?php include("inc_header.php")?>
<?php 
$err     = "";
$success  = "";

if(!isset($_GET['email']) or !isset($_GET['code'])){
    $err    = "The data needed for verification is not ready..";
}else{
    $email  = $_GET['email'];
    $code   = $_GET['code'];

    $sql1   = "select * from members where email = '$email'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    if($r1['status'] == $code){
        $sql2   = "update members set status = '1' where email = '$email'";
        mysqli_query($conn,$sql2);
        $success = "The account is active. Please log in at the login page.";
    }else{
        $err = "Code is not valid";
    }
}
?>
<h3>Verification Page</h3>
<?php if($err) { echo "<div class='error'>$err</div>";}?>
<?php if($success) { echo "<div class='success'>$success</div>";}?>
<?php include("inc_footer.php")?>