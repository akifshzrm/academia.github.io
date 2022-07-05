<?php include("inc_header.php")?>

<?php 
$success = "";
$keywords = (isset($_GET['keywords'])) ? $_GET['keywords'] : "";
if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}
if ($op == 'delete') {
    $id = $_GET['id'];

    $sql1   = "select photos from tutors where id = '$id'";
    $q1     = mysqli_query($conn,$sql1);
    $r1     = mysqli_fetch_array($q1);
    @unlink("../images/".$r1['photos']);


    $sql1   = "delete from tutors where id = '$id'";
    $q1     = mysqli_query($conn, $sql1);
    if ($q1) {
        $success     = "Data successfully deleted";
    }
}
?>

<h1>Admin Page Tutors</h1>
<p>
    <a href="tutors_input.php">
        <input type="button" class="btn btn-primary" value="Add New Tutor"/>
    </a>
</p>

<?php
if ($success) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $success ?>
    </div>
<?php
}
?>

<form class="row g-3" method="get">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Enter Keywords" name="keywords" value="<?php echo $keywords ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="find" value="Find Text" class="btn btn-secondary" />
    </div>
</form>

<table class="table table-striped">
<thead>
    <tr>
        <th class="col-1">#</th>
        <th class="col-2">Photo</th>
        <th>Name</th>
        <th class="col-2">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $sqladd = "";
    $per_page = 2;
    if($keywords != ''){
        $array_keywords = explode(" ", $keywords);
        for($x=0 ; $x < count($array_keywords) ; $x++){
            $sqlfind[] = "(name like '%" . $array_keywords[$x] . "%' or content like '%" . $array_keywords[$x] . "%')";
        }
        $sqladd    = " where " . implode(" or ", $sqlfind);
    }
    $sql1 = " select * from tutors $sqladd";



    $page   = isset($_GET['page'])?(int)$_GET['page']:1;
    $start  = ($page > 1) ? ($page * $per_page) - $per_page : 0;  
    $q1     = mysqli_query($conn,$sql1);
    $total  = mysqli_num_rows($q1);
    $pages  = ceil($total / $per_page);
    $num    = $start + 1;
    $sql1   = $sql1." order by id desc limit $start,$per_page";
    

    $q1   = mysqli_query($conn, $sql1);

    while ($r1 = mysqli_fetch_array($q1)) {
    ?>
        <tr>
        <td><?php echo $num++ ?></td>
        <td><img src="../images/<?php echo tutors_photo($r1['id'])?>" style="max-height:100px;max-width:100px"/></td>
        <td><?php echo $r1['name'] ?></td>
        <td>
        <a href="tutors_input.php?id=<?php echo $r1['id']?>">
        <span class="badge bg-warning text-dark">Edit</span>
        </a>
        <a href="tutors.php?op=delete&id=<?php echo $r1['id']?>" onclick="return confirm('Confirm on delete?')">
        <span class="badge bg-danger">Delete</span>
        </a>
        </td>
    </tr>  
    <?php     
    }
    ?>

</tbody>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php 
        $find = isset($_GET['find'])? $_GET['find'] : "";

        for($i=1; $i <= $pages; $i++){
            ?>
            <li class="page-item">
                <a class="page-link" href="tutors.php?keywords=<?php echo $keywords?>&find=<?php echo $find?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>


<?php include("inc_footer.php")?>
