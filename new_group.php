<?php include 'db_connect.php' ?>
<?php

if (isset($_GET['id'])) {
    $qry = $conn->query("SELECT * FROM payments where id=" . $_GET['id']);
    foreach ($qry->fetch_array() as $k => $val) {
        $$k = $val;
    }
}

?>
<div class="container-fluid">
    <div class="col-lg-12">
        <form id="new-group">
            <div class="row">
                <div class="col">
                    <!-- 1 of 3 -->
                </div>
                <div class="col-5">
                    <select name="village" id="village" class="custom-select browser-default select2">
                        <option value=""></option>
                        <?php
                        $villages = $conn->query("SELECT * from villages;");
                        while ($row = $villages->fetch_assoc()) :
                        ?>
                            <option value="<?php echo $row['id'] ?>"><?php echo $row['village'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    <input type="text" class="form-control mt-2" name="group_name" id="group_name" placeholder="Enter a group name">
                </div>
                <div class="col">
                    <!-- 3 of 3 -->
                </div>
            </div>
            <div class="row" id="fields">

            </div>
        </form>
    </div>
</div>

<script>
    $('.select2').select2({
        placeholder: "select village",
        width: "100%"
    })

    $('#new-group').submit(function(e) {

        e.preventDefault()

        if (document.getElementById("village").value == "" || document.getElementById("group_name").value == "") {
            alert_toast("Please enter village and group name..!", "danger");
        } else {
            start_load()
            $.ajax({
                url: 'ajax.php?action=save_group',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Group data successfully saved.", "success");
                        setTimeout(function(e) {
                            location.reload()
                        }, 1500)
                    } else if (resp == 0) {
                        alert_toast("Group has already exist in this village..!", "danger");
                        setTimeout(function(e) {
                            location.reload()
                        }, 1500)
                    }

                }
            })
        }

    })
    $(document).ready(function() {

    })
</script>