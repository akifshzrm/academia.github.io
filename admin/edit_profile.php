<?php include("inc_header.php") ?>
<?php
$err        = "";
$success    = "";

if (isset($_POST['save'])) {


    $old_password             = $_POST['old_password'];
    $password                 = $_POST['password'];
    $password_confirmation    = $_POST['password_confirmation'];

    $sql1 = "select * from admin where username = '".$_SESSION['admin_username']."'";
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

    if(empty($err)){
        $sql1   = "update admin set password = md5($password) where username = '".$_SESSION['admin_username']."'";
        mysqli_query($conn,$sql1);
        $success = "Successfully changed password";
    }
}
?>
<h1>Change Account Password</h1>
<?php
if($success){
    ?>
    <div class="alert alert-primary">
        <?php echo $success?>
    </div>
    <?php
}
?>
<?php
if($err){
    ?>
    <div class="alert alert-danger">
        <ul><?php echo $err?></ul>
    </div>
    <?php
}
?>
<form action="" method="POST">
    <div class="mb-3 row">
        <label for="old_password" class="col-sm-3 col-form-label">Old Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="old_password" name="old_password" />
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-3 col-form-label">New Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password" name="password" />
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password_confirmation" class="col-sm-3 col-form-label">Confirmation New Password</label>
        <div class="col-sm-9">
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" />
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-3"></div>
        <div class="col-sm-9">
            <input type="submit" class="btn btn-primary" name="save" value="Change New Password" />
        </div>
    </div>
</form>

<?php include("inc_footer.php") ?>