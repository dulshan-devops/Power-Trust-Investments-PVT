<?php include 'db_connect.php' ?>
<?php
// no longer need this file
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM payments where id=" . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-payment">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="" class="control-label">Village</label>
						<select name="village" id="" class="custom-select browser-default select2">
							<option value=""></option>
							<?php
							$villages = $conn->query("SELECT * from villages;");
							while ($row = $villages->fetch_assoc()) :
							?>
								<option value="<?php echo $row['id'] ?>"><?php echo $row['village'] ?></option>
							<?php endwhile; ?>
						</select>

					</div>
				</div>
			</div>
			
			<div class="row" id="fields">
								
			</div>
		</form>
	</div>
</div>

<script>
	$('[name="village"]').change(function() {
		load_fields()
	})
	
	$('.select2').select2({
		placeholder: "Please select here",
		width: "100%"
	})

	function load_fields() {
		start_load()
		$.ajax({
			url: 'load_fields.php',
			method: "POST",
			data: {
				id: '<?php echo isset($id) ? $id : "" ?>',
				village_id: $('[name="village"]').val()
			},
			success: function(resp) {
				if (resp) {
					$('#fields').html(resp)
					end_load()
				}
			}
		})
	}
	$('#manage-payment').submit(function(e) {
		// e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_payment',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Payment data successfully saved.", "success");
					setTimeout(function(e) {
						location.reload()
					}, 1500)
				}
			}
		})
	})
	$(document).ready(function() {
		if ('<?php echo isset($_GET['id']) ?>' == 1)
			load_fields()
	})
</script>