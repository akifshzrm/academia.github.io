<?php include("inc_header.php")?>
<?php 
if(isset($_SESSION['members_email']) != ''){ //already log in
    header("location:index.php");
    exit();
}
?>
<h3>Registration</h3>
<?php
$email          = "";
$full_name      = "";
$err            = "";
$success        = "";

if(isset($_POST['save'])){
    $email                  = $_POST['email'];
    $full_name              = $_POST['full_name'];
    $password               = $_POST['password'];
    $password_confirmation  = $_POST['password_confirmation'];

    if($email == '' or $full_name == '' or $password_confirmation =='' or $password == ''){
        $err .= "<li>Please enter all the required information.</li>";
    }

    //check in the database, whether the email already exists or not
    if($email != ''){
        $sql1   = "select email from members where email = '$email'";
        $q1     = mysqli_query($conn,$sql1);
        $n1     = mysqli_num_rows($q1);
        if($n1 > 0){
            $err .= "<li>Email you entered already registered.</li>";
        }
        //email validation
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $err .= "<li>Email you entered is not valid.</li>";
        }
    }
    //check password & confirm password
    if($password != $password_confirmation){
        $err .= "<li>Password and Confirmation password is not the same.</li>";
    }
    if(strlen($password) < 6){
        $err .= "<li>The minimum character for password must at least 6 character.</li>";
    }

    if(empty($err)){

        $status                 = md5(rand(0,1000));
        $title_email            = "Confirm Your Registration";
        $content_email          = "The account you have with email <b>$email</b> is ready to use.<br/>";
        $content_email         .= "Please activate your email at the link below:<br/>";
        $content_email         .= url_first()."/verification.php?email=$email&code=$status";

        send_email($email,$full_name,$title_email,$content_email);      

        $sql1 = "insert into members(email,full_name,password,status) values ('$email','$full_name',md5($password),'$status')";
        $q1         = mysqli_query($conn,$sql1);
        if($q1){
            $sukses = "Prosess Successful. Please check your email for verification.";
        }
        $success = "Process Success.";
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
                <input type="text" name="email" class="input" value="<?php echo $email?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Full Name</td>
            <td>
                <input type="text" name="full_name" class="input" value="<?php echo $full_name?>"/>
            </td>
        </tr>
        <tr>
            <td class="label">Password</td>
            <td>
                <input type="password" name="password" class="input" />
            </td>
        </tr>
        <tr>
            <td class="label">Password Confirmation</td>
            <td>
                <input type="password" name="password_confirmation" class="input" />
                <br/>
                Already have an account? Please <a href='<?php echo url_first()?>/login.php'>login</a>                
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
