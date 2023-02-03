<?php include 'db_connect.php' ?>
<?php
extract($_POST);
?>
<select class="form-control form-control-sm" id="child_select">
    <?php
    $villages = $conn->query("SELECT * from villages;");
    while ($row = $villages->fetch_assoc()) :
    ?>
        <option value="<?php echo $row['id'] ?>"><?php echo $row['village'] ?></option>
    <?php endwhile; ?>
</select>