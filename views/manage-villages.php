<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <form class="form-inline" id="add-village" enctype="multipart/form-data" method="">
                <div class="form-group mx-sm-3 mb-2">
                    <input class="form-control form-control-sm" type="text" placeholder="Enter a village" style="margin-right: 5px; width : 15rem;" name="village" id="village">
                    <button type="submit" class="btn btn-primary float-right btn-sm" id="new_village"><i class="fa fa-plus"></i> Add Village</button>
                </div>

            </form>

        </div>
    </div>
    <div class="row mt-2">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">Village Id</th>
                            <th class="text-center">Village Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $villages = $conn->query("SELECT  * from villages;");
                        $i = 1;
                        while ($row = $villages->fetch_assoc()) :
                        ?>
                            <!-- track to village id -->
                             <input type="hidden" id="vid" name="vid" value="<?php echo $row['id'] ?>">
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $row['id'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $row['village'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary btn-sm">Action</button>
                                            <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' onclick="setup_edit(<?php echo $row['id'] ?>)" data-toggle="modal" data-target="#edit_village">Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item delete_village" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>' onclick="setup_delete(<?php echo $row['id'] ?>)" data-toggle="modal" data-target="#delete_village">Delete</a>
                                            </div>
                                        </div>
                                    </center>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- village delete modal -->
<div class="modal fade" id="delete_village" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="color : red">Are you sure to delete this village ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                All of groups and village details will be removed and can't undo this process.. <b>are you confirm </b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_delete" onclick="delete_village()">Confirm</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cansel</button>
            </div>
        </div>
    </div>
</div>

<!-- village edit modal -->
<div class="modal fade" id="edit_village" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Village</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">

                    </div>
                    <div class="col-6">
                        <form id="edit_village">
                            <div class="form-group">
                                <center>
                                    <label for="exampleInputEmail1">New Village Name</label>
                                    <input type="text" class="form-control" id="new_village_name" aria-describedby="emailHelp" placeholder="EX: gampaha">
                                </center>
                            </div>
                        </form>
                    </div>
                    <div class="col">

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirm_delete" onclick="edit_village()">Continue</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cansel</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#add-village').submit(function(e) {

        e.preventDefault()
        if (document.getElementById("village").value != "") {
            start_load()
            $.ajax({
                url: 'ajax.php?action=save_village',
                method: 'POST',
                data: $(this).serialize(),
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Village data successfully saved.", "success");
                        setTimeout(function(e) {
                            location.reload()
                        }, 1500)
                        // end_load();
                    }
                }
            })
        } else {
            alert_toast("Please enter village..!", "danger");
        }


    })

    //delete village - 2022-12-28 - Dilshan
    function setup_delete($vid) {
        document.getElementById("vid").value = $vid;
    }

    function delete_village() {
        var vid = document.getElementById("vid").value;

        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_village',
            method: 'POST',
            data: {
                vid: vid,
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Village data deleted..!", "success");
                    setTimeout(function(e) {
                        location.reload()
                    }, 1500)
                    // end_load();
                }
            }
        })
    }

    //setup edit village - 2022-12-29 - Dilshan
    function setup_edit($vid) {
        document.getElementById("vid").value = $vid;
    }

    function edit_village() {
        var vid = document.getElementById("vid").value;

        if (document.getElementById("new_village_name").value == "") {
            alert_toast("Please enter a village..!", "danger");

        } else {
            start_load()
            $.ajax({
                url: 'ajax.php?action=edit_village',
                method: 'POST',
                data: {
                    vid: vid,
                    new_village: document.getElementById("new_village_name").value
                },
                success: function(resp) {
                    if (resp == 1) {
                        alert_toast("Village data updated..!", "success");
                        setTimeout(function(e) {
                            location.reload()
                        }, 1500)
                        // end_load();
                    }
                }
            })
        }
    }
</script>