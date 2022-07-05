<?php include("inc_header.php")?>
<?php
$name            = "";

$content         = "";
$photos          = "";
$photos_name     ="";
$error           = "";
$success         = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1    = "select * from tutors where id = '$id'";
    $q1      = mysqli_query($conn,$sql1);
    $r1      = mysqli_fetch_array($q1);
    $name   = $r1['name'];
    $content = $r1['content'];
    $photos  = $r1['photos'];

    if($content == ''){
        $error  = "Data not found";
    }
}

if (isset($_POST['save'])) {
    $name   = $_POST['name'];
    $content  = $_POST['content'];


    if ($name == '' or $content == '') {
        $error     = "Please enter all data (hint: name and content)";
    }

    if($_FILES['photos']['name']){
        $photos_name = $_FILES['photos']['name'];
        $photos_file = $_FILES['photos']['tmp_name'];

        $detail_file = pathinfo($photos_name);
        $photos_extension = $detail_file['extension'];
        $extention_allowed = array("jpg","jpeg","png","gif");
        if(!in_array($photos_extension,$extention_allowed)){
            $error = "Extension that are allowed are jpg, jpeg, png dan gif";
        }
    }

    if (empty($error)) {
        if($photos_name){
            $directory = "../images";

            @unlink($directory."/$photos"); //delete data

            $photos_name = "tutors_".time()."_".$photos_name;
            move_uploaded_file($photos_file,$directory."/".$photos_name);

            $photos = $photos_name;
        }else{
            $photos_name = $photos; 
        }

        if($id != ""){
            $sql1   = " update tutors set name = '$name',photos='$photos_name',content='$content',date_content=now() where id = '$id'";
        }else{
            $sql1       = "insert into tutors(name,photos,content) values ('$name','$photos_name','$content')";
        }
        
        $q1         = mysqli_query($conn,$sql1);
        if ($q1) {
            $success    = "Data successfully inserted.";
        } else {
            $error      = "Failed to insert data!";
        }
    }
}
?>
<h1>Admin Input Data (Tutors)</h1>
<div class="mb-3 row">
    <a href="tutors.php">
        << Return to Admin (Tutors) </a>
</div>

<?php
if ($error) {
?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php
}
?>
<?php
if ($success) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $success ?>
    </div>
<?php
}
?>


<form action="" method="post" enctype="multipart/form-data">
    <div class="mb-3 row">
        <label for="name" class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="name" value="<?php echo $name ?>" name="name">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="Quote" class="col-sm-2 col-form-label">Photo</label>
        <div class="col-sm-10">
        <?php 
            if($photos){
                echo "<img src='../images/$photos' style='max-height:100px;max-width:100px'/>";
            }
            ?>
            <input type="file" class="form-control" id="photos" value="<?php echo $photos ?>" name="photos">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="content" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
            <textarea name="content" class="form-control" id="summernote"><?php echo $content ?></textarea>
        </div>
    </div>
    <div class="mb-3 row">
        <div class="col-sm-2"></div>
        <div class="col-sm-10">
            <input type="submit" name="save" value="Save Data" class="btn btn-primary" />
        </div>
    </div>
</form>
<?php include("inc_footer.php")?>