<?php
include_once("inc/inc_connection.php");
include_once("inc/inc_function.php");

$id = get_id();

$sql1   = " select * from partners where id = '$id' ";
$q1     = mysqli_query($conn,$sql1);
$n1     = mysqli_num_rows($q1);
$r1     = mysqli_fetch_array($q1);

$name  = $r1['name'];
?>
<?php include_once("inc_header.php")?>

<?php 
if($name == ''){
    echo "<div><p>Sorry , data not found :(</p></div>";
}else{
    ?>
    <style>
    .photo_location {
        float: left;
        width: 20%;
        margin-top: 20px;
    }
    .photo_location img {
        width: 100%;
        border-radius: 50%;
    }
    .photo_desc {
        margin-top: 20px;
        float: right;
        width: 75%;
    }
    </style>
    <div class="photo_location">
    <img src="<?php echo url_first()."/images/".partners_photo($r1['id']) ?>"/>
    </div>
    <div class="photo_desc">
    <h1><?php echo $r1['name']?></h1>
    <?php echo set_content($r1['content'])?>
    </div>
    <br style="clear: both">
    <?php
}
?>

<?php include_once("inc_footer.php")?>