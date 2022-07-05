<?php include("inc_header.php")?>
<?php 
if(isset($_SESSION['members_email']) == ''){ //belum dalam keadaan login
    header("location:login.php");
    exit();
}
?>
<h3>Edit Account Profile</h3>
<?php
$email          = "";
$full_name      = "";
$err            = "";
$success        = "";

if(isset($_POST['save'])){
    $full_name              = $_POST['full_name'];
    $old_password           = $_POST['old_password'];
    $password               = $_POST['password'];
    $password_confirmation  = $_POST['password_confirmation'];

    if($full_name == ''){
        $err .= "<li>Silakan masukkan nama lengkap</li>";
    }

    if($password != ''){ //if you are going to make a password change
        $sql1 = "select * from members where email = '".$_SESSION['members_email']."'";
        $q1   = mysqli_query($conn,$sql1);
        $r1   = mysqli_fetch_array($q1);
        if(md5($old_password) != $r1['password']){
            $err .= "<li>The password you entered does not match the previous password</li>";
        }

        if($old_password == '' or $password_confirmation== '' or $password == ''){
            $err .= "<li>Please enter the old password, new password and password confirmation</li>";
        }

        if($password != $password_confirmation){
            $err .= "<li>Please enter the password and confirm the same password</li>";
        }

        if(strlen($password) < 6){
            $err .= "<li>The allowed character length for the password is 6 characters, minimum.</li>";
        }
}

if(empty($err)){
    $sql1 = "update members set full_name = '".$full_name."' where email = '".$_SESSION['members_email']."'";
    mysqli_query($conn,$sql1);
    $_SESSION['members_full_name'] = $full_name;

    if($password){
        $sql2 = "update members set password = md5($password) where email = '".$_SESSION['members_email']."'";
        mysqli_query($conn,$sql2);
    }

    $success = "Data changed successfully";
}

}

?>
<?php if($err) {echo "<div class='error'><ul>$err</ul></div>";} ?>
<?php if($success) {echo "<div class='success'>$success</div>";} ?>

<form action="" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td>
            <?php echo $_SESSION['members_email']?>               
            </td>
        </tr>
        <tr>
            <td class="label">Full Name</td>
            <td>
                <input type="text" name="full_name" class="input" value="<?php $_SESSION['members_full_name']?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Old Password</td>
            <td>
                <input type="password" name="old_password" class="input" />
            </td>
        </tr>
        <tr>
        <tr>
            <td class="label">New Password</td>
            <td>
                <input type="password" name="password" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Password Confirmation</td>
            <td>
                <input type="password" name="password_confirmation" class="input" />             
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <input type="submit" name="save" value="save" class="tbl-blue"/>
            </td>
        </tr>
    </table>
</form>

<?php include("inc_footer.php")?>
