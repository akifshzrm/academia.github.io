<?php include("inc_header.php")?>tutors

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
    $sql1   = "delete from info where id = '$id'";
    $q1     = mysqli_query($conn, $sql1);
    if ($q1) {
        $success     = "Data successfully deleted";
    }
}
?>

<h1>Admin Info</h1>
<p>
    <a href="info_input.php">
        <input type="button" class="btn btn-primary" value="Create New Info"/>
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
        <th>Title</th>
        <th class="col-2">Action</th>
    </tr>
</thead>
<tbody>
    <?php
    $sqladd = "";
    $per_info = 2;
    if($keywords != ''){
        $array_keywords = explode(" ", $keywords);
        for($x=0 ; $x < count($array_keywords) ; $x++){
            $sqlfind[] = "(title like '%" . $array_keywords[$x] . "%' or content like '%" . $array_keywords[$x] . "%')";
        }
        $sqladd    = " where " . implode(" or ", $sqlfind);
    }
    $sql1 = " select * from info $sqladd";



    $info   = isset($_GET['info'])?(int)$_GET['info']:1;
    $start  = ($info > 1) ? ($info * $per_info) - $per_info : 0;  
    $q1     = mysqli_query($conn,$sql1);
    $total  = mysqli_num_rows($q1);
    $infos  = ceil($total / $per_info);
    $num    = $start + 1;
    $sql1   = $sql1." order by id desc limit $start,$per_info";
    

    $q1   = mysqli_query($conn, $sql1);

    while ($r1 = mysqli_fetch_array($q1)) {
    ?>
        <tr>
        <td><?php echo $num++ ?></td>
        <td><?php echo $r1['title'] ?></td>
        <td>
        <a href="info_input.php?id=<?php echo $r1['id']?>">
        <span class="badge bg-warning text-dark">Edit</span>
        </a>
        <a href="info.php?op=delete&id=<?php echo $r1['id']?>" onclick="return confirm('Confirm on delete?')">
        <span class="badge bg-danger">Delete</span>
        </a>
        </td>
    </tr>  
    <?php     
    }
    ?>

</tbody>
</table>

<nav aria-label="Info navigation example">
    <ul class="pagination">
        <?php 
        $find = isset($_GET['find'])? $_GET['find'] : "";

        for($i=1; $i <= $infos; $i++){
            ?>
            <li class="info-item">
                <a class="info-link" href="info.php?keywords=<?php echo $keywords?>&find=<?php echo $find?>&info=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
            <?php
        }
        ?>
    </ul>
</nav>


<?php include("inc_footer.php")?>
