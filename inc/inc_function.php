<?php
function url_first(){
    // $_SERVER['SERVER_NAME']
    $url_first  = "http://".$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']);
    return $url_first;
}

function get_picture($id_text){
    global $conn;
    $sql1 = " select * from page where id = '$id_text'";
    $q1   = mysqli_query($conn,$sql1);
    $r1   = mysqli_fetch_array($q1);
    $text = $r1['content'];

    preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
    $image = $img[1];
    $image = str_replace("../images/",url_first()."/images/",$image);
    return $image;

}

function get_quote($id_text){
    global $conn;
    $sql1   = "select * from page where id = '$id_text'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['quote'];
    return $text;
}

function get_title($id_text){
    global $conn;
    $sql1   = "select * from page where id = '$id_text'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = $r1['title'];
    return $text;
}

function get_content($id_text){
    global $conn;
    $sql1   = "select * from page where id = '$id_text'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $text   = strip_tags($r1['content']);
    return $text;
}

function clean_title($title){
    $new_title    = strtolower($title);
    $new_title    = preg_replace("/[^a-zA-Z0-9\s]/","",$new_title);
    $new_title     = str_replace(" ","-",$new_title);
    return $new_title;
}

function create_page_link($id){
    global $conn;
    $sql1    = " select * from page where id = '$id' ";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $title  = clean_title($r1['title']);
    return url_first()."/page.php/$id/$title";
}

function get_id(){
    $id     ="";
    if(isset($_SERVER['PATH_INFO'])){
        $id = dirname($_SERVER['PATH_INFO']);
        $id = preg_replace("/[^0-9]/","",$id);
    }
    return $id;
}

function set_content($content){
    $content    = str_replace("../images/",url_first()."/images/",$content);
    return $content;
}

function maximum_word($content,$maximum){
    $array_content = explode(" ",$content);
    $array_content = array_slice($array_content,0,$maximum);
    $content = implode(" ",$array_content);
    return $content;
}

function tutors_photo($id){
    global $conn;
    $sql1   = "select * from tutors where id = '$id'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $photos   = $r1['photos'];

    if($photos){
        return $photos;
    }else{
        return 'tutors_default_picture.png';
    }
}

function create_page_tutors($id){
    global $conn;
    $sql1    = " select * from tutors where id = '$id' ";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $name  = clean_title($r1['name']);
    return url_first()."/tutors.php/$id/$name";
}


function partners_photo($id){
    global $conn;
    $sql1   = "select * from partners where id = '$id'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $photos   = $r1['photos'];

    if($photos){
        return $photos;
    }else{
        return 'partners_default_picture.png';
    }
}

function create_page_partners($id){
    global $conn;
    $sql1    = "select * from partners where id = '$id'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    $name  = clean_title($r1['name']);
    return url_first()."/partners.php/$id/$name";
}

function get_content_info($id,$column){
    global $conn;
    $sql1   = "select $column from info where id = '$id'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    return $r1[$column];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function send_email($email_receiver, $name_receiver,$title_email,$content_email){
    
    $email_sender     = "akifshzrm@gmail.com";
    $name_sender     = "noreply";

    //Load Composer's autoloader
    require getcwd().'/vendor/autoload.php';

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                                       //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $email_sender;                          //SMTP username
        $mail->Password   = 'esqzuvvieodhwgpy';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($email_sender, $name_sender);
        $mail->addAddress($email_receiver,$name_receiver);          //Add a recipient
       

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = $title_email;
        $mail->Body    = $content_email;
        

        $mail->send();
        return "success";
    } catch (Exception $e) {
        return "fail: {$mail->ErrorInfo}";
    }
}

