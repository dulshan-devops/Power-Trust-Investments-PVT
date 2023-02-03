<?php include 'db_connect.php' ?>
<?php
extract($_POST);


?>
<div class="">
    <label for="">Group</label>
    <select name="group" id="" class="custom-select browser-default select2">
        <option value=""></option>
        <?php
        $groups = $conn->query("SELECT * from groups where village_id = " . $village_id);
        while ($row = $groups->fetch_assoc()) :
        ?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['group'] ?></option>
        <?php endwhile; ?>
    </select>
</div>

<script>
    $('.select2').select2({
        placeholder: "select a village",
        width: "100%"
    })
</script>