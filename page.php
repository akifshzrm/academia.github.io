<?php
include_once("inc/inc_connection.php");
include_once("inc/inc_function.php");

$id = get_id();

$sql1   = " select * from page where id = '$id' ";
$q1     = mysqli_query($conn,$sql1);
$n1     = mysqli_num_rows($q1);
$r1     = mysqli_fetch_array($q1);

$title_page  = $r1['title'];
?>
<?php include_once("inc_header.php")?>

<?php 
if($title_page == ''){
    echo "<div><p>Sorry , data not found :(</p></div>";
}else{
    ?>
    <p class="deskripsi"><?php echo $r1['quote']?></p>
    <h1><?php echo $r1['title']?></h1>
    <?php echo set_content($r1['content'])?>
    <?php
}
?>

<?php include_once("inc_footer.php")?>