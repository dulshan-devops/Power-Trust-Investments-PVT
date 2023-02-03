<?php include 'db_connect.php' ?>
<?php
extract($_POST);
// $groups = $conn->query("SELECT * from groups where village_id = " . $village_id);
// $groups_data = $groups->fetch_array(MYSQLI_ASSOC);

// return array("groups" => $groups_data);

?>

<div class="col-lg-12">

    <div class="row" id="payment_row">

        <div class="col-md-5">
            <div class="form-group">
                <label for="" class="control-label">Group</label>
                <select name="group" id="" class="custom-select browser-default select2">
                    <option value=""></option>
                    <?php
                    $groups_data = $conn->query("SELECT * FROM groups where village_id = '" . $village_id . "' order by `group` ASC;");
                    while ($row = $groups_data->fetch_assoc()) :
                    ?>
                        <option value="<?php echo $row['id'] ?>"><?php echo $row['group'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="col-md-5" id="users_field">

        </div>
    </div>
    <div class="row" id="payment_row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Payment Type</label>
                <select name="payment_type" id="" class="custom-select browser-default select2">
                    <option value="1">Cash</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="">Amount</label>
                <input type="number" id="amount" name="amount" step="any" min="" class="form-control text-right" required="" value="">
            </div>
        </div>
    </div>
</div>

<script>
    $('.select2').select2({
        placeholder: "Please select here",
        width: "100%"
    })

    $('[name="group"]').change(function() {
        load_user();
    })

    function load_user() {
        start_load()
        $.ajax({
            url: 'load_users.php',
            method: "POST",
            data: {
                group_id: $('[name="group"]').val()
            },
            success: function(resp) {
                $('#users_field').html(resp)
                end_load()
            }
        })
    }
</script>