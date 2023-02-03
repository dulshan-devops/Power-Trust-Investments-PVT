<div class="container-fluid">
    <div class="row">
		<div class="col-lg-12 mt-2">
			<button class="btn btn-primary float-right btn-sm" id="new_group"><i class="fa fa-plus"></i> Add Group</button>
		</div>
	</div>
    <div class="row mt-2">
		<div class="card col-lg-12">
			<div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">Group ID</th>
                            <th class="text-center">Group</th>
                            <th class="text-center">Village</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        include 'db_connect.php';
                        $groups = $conn->query("SELECT  * from villages INNER JOIN  groups on villages.id=groups.village_id;");
                        $i = 1;
                        while ($row = $groups->fetch_assoc()) :
                        ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $row['id'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $row['group'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                    <center>
                                        <?php echo $row['village'] ?>
                                    </center>
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

<script>
    $('#new_group').click(function(){
		uni_modal("New Group","new_group.php",'mid-large')
	})
</script>
