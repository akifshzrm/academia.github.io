<?php include("inc_header.php")?>
<h3>Forgot Password</h3>
<?php 
if(isset($_SESSION['members_email']) != ''){
    header("location:index.php");
    exit();
}

$err    = "";
$success = "";
$email  = "";

if(isset($_POST['submit'])){
    $email  = $_POST['email'];
    if($email == ''){
        $err = "Please enter your email";
    }else{
        $sql1 = "select * from members where email = '$email'";
        $q1   = mysqli_query($conn,$sql1);
        $n1   = mysqli_num_rows($q1);

        if($n1 < 1){
            $err = "Email: <b>$email</b> not found";
        }
    }

    if(empty($err)){
        $token_change_password       = md5(rand(0,1000));
        $title_email                 = "Change Password";
        $content_email               = "Someone asked to make a change to the account password. Click the link below to confirm it was you:<br/>";
        $content_email              .= url_first()."/change_password.php?email=$email&token=$token_change_password";
        send_email($email,$email,$title_email,$content_email);

        $sql1     = "update members set token_change_password = '$token_change_password' where email = '$email'";
        mysqli_query($conn,$sql1);
        $success  ="The link to change your password has already been sent to your email..";
    }
}
?>
<?php if($err){ echo "<div class='error'>$err</div>";}?>
<?php if($success){ echo "<div class='success'>$success</div>";}?>
<form action="" method="POST">
    <table>
        <tr>
            <td class="label">Email</td>
            <td><input type="text" name="email" class="input" value="<?php echo $email ?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td>
            <input type="submit" name="submit" value="Forgot Password" class="tbl-blue"/>
            </td>
        </tr>
    </table>
</form>
<?php include("inc_footer.php");?>