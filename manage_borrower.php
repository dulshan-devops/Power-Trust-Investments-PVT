<?php include 'db_connect.php' ?>
<?php

if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM borrowers where id=" . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $val) {
		$$k = $val;
	}
}

?>
<div class="container-fluid">
	<div class="col-lg-12">
		<form id="manage-borrower" method="GET">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">First Name</label>
						<input name="firstname" class="form-control" required="" value="<?php echo isset($firstname) ? $firstname : '' ?>">
					</div>
				</div>

				<div class="col-md-6">
					<div class="form-group">
						<label for="" class="control-label">Last Name</label>
						<input name="lastname" class="form-control" required="" value="<?php echo isset($lastname) ? $lastname : '' ?>">
					</div>
				</div>

				<!-- <div class="col-md-4">
					<div class="form-group">
						<label for="">Middle Name</label>
						<input name="middlename" class="form-control" value="<?php echo isset($middlename) ? $middlename : '' ?>">
					</div>
				</div> -->
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<label for="">Address</label>
					<textarea name="address" id="" cols="30" rows="2" class="form-control" required=""><?php echo isset($address) ? $address : '' ?></textarea>
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">Contact #</label>
						<input type="text" class="form-control" name="contact_no" value="<?php echo isset($contact_no) ? $contact_no : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<label for="">Email</label>
					<input type="email" class="form-control" name="email" value="<?php echo isset($email) ? $email : '' ?>">
				</div>
				<div class="col-md-6">
					<div class="">
						<label for="">NIC</label>
						<input type="text" class="form-control" name="br_nic" value="<?php echo isset($br_nic) ? $br_nic : '' ?>">
					</div>
				</div>
			</div>
			<div class="row form-group">
				<div class="col-md-6">
					<label for="">Village</label>
					<select name="village" id="village" class="custom-select browser-default select2" onchange="setup_groups()">
						<option value=""></option>
						<?php
						$villages = $conn->query("SELECT * from villages;");
						while ($row = $villages->fetch_assoc()) :
						?>
							<option value="<?php echo $vid = $row['id'] ?>"><?php echo $row['village'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-6" id="group_container">

				</div>
			</div>
		</form>

	</div>
</div>

<script>
	// $('[name="village"]').change(function() {
	// 	load_groups()
	// })

	$('.select2').select2({
		placeholder: "select a village",
		width: "100%"
	})

	$('.select_group').select2({
		placeholder: "select a group",
		width: "100%"
	})

	function setup_groups() {
		start_load()
		var villageID = document.getElementById("village").value;
		console.log(villageID)

		$.ajax({
			url: 'groups_borrower.php',
			method: "POST",
			data: {
				village_id: villageID,
			},
			success: function(resp) {
				$('#group_container').html(resp)
				end_load()
			}
		})
	}

	function load_groups() {

		start_load()
		// $.ajax({
		// 	url: 'load_groups.php',
		// 	method: "POST",
		// 	data: {
		// 		village_id: $('[name="village"]').val()
		// 	},
		// 	success: function(resp) {
		// 		if (resp) {
		// 			console.log(resp);
		// 			end_load()
		// 		}
		// 	}
		// })
		end_load()
	}

	$('#manage-borrower').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_borrower',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Borrower data successfully saved.", "success");
					setTimeout(function(e) {
						location.reload()
					}, 1500)
				}
			}
		})
	})
</script>