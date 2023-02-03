<?php include 'db_connect.php' ?>

<div class="container-fluid row mt-3">
	<div class="col-lg-5">
		<div class="card">
			<div class="card-header text-center">
				<large class="card-title">
					<b>Make Payment</b>
					<!-- <button class="btn btn-primary btn-sm btn-block col-md-2 float-center" type="button" id="new_payments"><i class="fa fa-plus"></i> New Payment</button> -->
				</large>

			</div>
			<div class="card-body">
				<form id="manage-payment">
					<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
					<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<label for="" class="control-label">Village</label>
								<select name="village" id="payment-village" class="custom-select browser-default select2">
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
					<hr>



					<div class="row" id="fields">

					</div>

					<div class="row" id="payments_tbl_container">

					</div>

					<div class="row d-flex justify-content-center">
						<div class="col-6">
							<button class="btn btn-success btn-sm btn-block col-md-6 float-right" type="button" id="setup_details"><i class="fa fa-calculator"></i> View Details</button>
						</div>
						<div class="col-6">
							<button class="btn btn-primary btn-sm btn-block col-md-6 float" type="submit" id="new_payments"><i class="fa fa-print"></i> Submit </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-lg-7">
		<div class="card">
			<div class="card-header text-center">
				<large class="card-title">
					<b>Payment List</b>
					<!-- <button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_payments"><i class="fa fa-plus"></i> New Payment</button> -->
				</large>

			</div>
			<div class="card-body">
				<table class="table table-bordered" id="loan-list">
					<colgroup>
						<col width="5%">
						<col width="20%">
						<col width="25%">
						<col width="20%">
						<col width="10%">
						<col width="20%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Loan Reference No</th>
							<th class="text-center">Payee</th>
							<th class="text-center">Amount</th>
							<th class="text-center">Penalty</th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php

						$qry = $conn->query("SELECT p.*,l.ref_no,concat(b.lastname,', ',b.firstname)as name, b.contact_no, b.address from payments p inner join loan_list l on l.id = p.loan_id inner join borrowers b on b.id = l.borrower_id  order by p.id asc");
						while ($row = $qry->fetch_assoc()) :


						?>
							<tr>

								<td class="text-center"><?php echo $row['id'] ?></td>
								<td>
									<?php echo $row['ref_no'] ?>
								</td>
								<td>
									<?php echo $row['payee'] ?>

								</td>
								<td>
									<?php echo number_format($row['amount'], 2) ?>

								</td>
								<td class="text-center">
									<?php echo number_format($row['penalty_amount'], 2) ?>
								</td>
								<td class="text-center">
									<a class="btn btn-outline-success btn-sm" href="http://localhost/micro-loan/index.php?page=billPay&payId=<?= $row['id'] ?>" target="_blank" rel="noopener noreferrer"><i class="fa fa-print"></i></a>

									<button class="btn btn-outline-primary btn-sm edit_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>

									<button class="btn btn-outline-danger btn-sm delete_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
								</td>

							</tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<style>
	td p {
		margin: unset;
	}

	td img {
		width: 8vw;
		height: 12vh;
	}

	td {
		vertical-align: middle !important;
	}
</style>
<script>
	$('#loan-list').dataTable()
	// $('#new_payments').click(function() {
	// 	uni_modal("New Payement", "manage_payment.php", 'mid-large')
	// })
	$('.edit_payment').click(function() {
		uni_modal("Edit Payement", "manage_payment.php?id=" + $(this).attr('data-id'), 'mid-large')
	})
	$('.delete_payment').click(function() {
		_conf("Are you sure to delete this data?", "delete_payment", [$(this).attr('data-id')])
	})

	function delete_payment($id) {
		start_load()
		$.ajax({
			url: 'ajax.php?action=delete_payment',
			method: 'POST',
			data: {
				id: $id
			},
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Payment successfully deleted", 'success')
					setTimeout(function() {
						location.reload()
					}, 1500)

				}
			}
		})
	}

	$('[name="village"]').change(function() {
		load_groups()
	})

	$('.select2').select2({
		placeholder: "Please select here",
		width: "100%"
	})

	$('#setup_details').click(function() {
		setup_table()
	})

	function load_groups() {
		start_load()
		$.ajax({
			url: 'load_groups.php',
			method: "POST",
			data: {
				id: '<?php echo isset($id) ? $id : "" ?>',
				village_id: $('[name="village"]').val()
			},
			success: function(resp) {
				$('#fields').html(resp)
				end_load()
			}
		})
	}

	function setup_table() {

		start_load();

		//validate data
		if (document.getElementById("loan_id") == null) {
			alert_toast("You need select user and loan reference data", "danger");
			end_load();
		} else {
			$.ajax({
				url: "payments_calculation_table.php",
				method: "POST",
				data: {
					loan_id: document.getElementById("loan_id").value,
				},
				success: function(resp) {
					if (resp) {

						$('#payments_tbl_container').html(resp)
						end_load()
					}
				}

			})
		}
	}

	$('#manage-payment').submit(function(e) {
		e.preventDefault()
		start_load()
		$.ajax({
			url: 'ajax.php?action=save_payment',
			method: 'POST',
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					alert_toast("Payment data successfully saved.", "success");
					document.getElementById("amount").value = "";
					end_load();

					//stop input reloading
					// setTimeout(function(e) {
					// 	location.reload()
					// }, 1500)
				}
			}
		})
	})

	
</script>