<?php include("inc_header.php")?>
<?php
$title    = "";

$content  = "";
$error    = "";
$success  = "";

if(isset($_GET['id'])){
    $id = $_GET['id'];
}else{
    $id = "";
}

if($id != ""){
    $sql1    = "select * from info where id = '$id'";
    $q1      = mysqli_query($conn,$sql1);
    $r1      = mysqli_fetch_array($q1);
    $title   = $r1['title'];
    $content = $r1['content'];

    if($content == ''){
        $error  = "Data not found";
    }
}

if (isset($_POST['save'])) {
    $title    = $_POST['title'];
    $content  = $_POST['content'];

    if ($title == '' or $content == '') {
        $error     = "Please enter all data (hint: title and content)";
    }

    if (empty($error)) {
        if($id != ""){
            $sql1   = " update info set title = '$title',content='$content',date_content=now() where id = '$id'";
        }else{
            $sql1       = "insert into info(title,content) values ('$title','$content')";
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
<h1>Admin Input Data</h1>
<div class="mb-3 row">
    <a href="info.php">
        << Return to Admin Info</a>
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


<form action="" method="post">
    <div class="mb-3 row">
        <label for="title" class="col-sm-2 col-form-label">Titles</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="title" value="<?php echo $title ?>" name="title">
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