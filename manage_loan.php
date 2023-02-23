<?php
include('db_connect.php');
if (isset($_GET['id'])) {
	$qry = $conn->query("SELECT * FROM loan_list where id = " . $_GET['id']);
	foreach ($qry->fetch_array() as $k => $v) {
		$$k = $v;
	}
}
?>
<div class="container-fluid">
	<div class="col-lg-12 overflow-scroll">
		<form id="loan-application" enctype="multipart/form-data">
			<input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
			<div class="row">
				<div class="col-md-6">
					<label class="control-label">Member Name</label>
					<?php
					$borrower = $conn->query("SELECT *,concat(lastname,', ',firstname) as name FROM borrowers order by concat(lastname,', ',firstname) asc ");
					?>
					<select name="borrower_id" id="borrower_id" class="custom-select browser-default select2" onchange="setup_selected_user_data()">
						<option value=""></option>
						<?php while ($row = $borrower->fetch_assoc()) : ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($borrower_id) && $borrower_id == $row['id'] ? "selected" : '' ?>><?php echo $row['name'] . ' | NIC : ' . $row['nic'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
				<div class="col-md-6">
					<label class="control-label">Loan Type</label>
					<?php
					$type = $conn->query("SELECT * FROM loan_types order by `type_name` desc ");
					?>
					<select name="loan_type_id" id="loan_type_id" class="custom-select browser-default select2">
						<option value=""></option>
						<?php while ($row = $type->fetch_assoc()) : ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($loan_type_id) && $loan_type_id == $row['id'] ? "selected" : '' ?>><?php echo $row['type_name'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>

			</div>

			<div class="row">
				<div class="col-md-6">
					<label class="control-label">Loan Plan</label>
					<?php
					$plan = $conn->query("SELECT * FROM loan_plan order by `months` desc ");
					?>
					<select name="plan_id" id="plan_id" class="custom-select browser-default select2">
						<option value=""></option>
						<?php while ($row = $plan->fetch_assoc()) : ?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($plan_id) && $plan_id == $row['id'] ? "selected" : '' ?> data-months="<?php echo $row['months'] ?>" data-interest_percentage="<?php echo $row['interest_percentage'] ?>" data-penalty_rate="<?php echo $row['penalty_rate'] ?>"><?php echo $row['months'] . ' month/s [ ' . $row['interest_percentage'] . '%, ' . $row['penalty_rate'] . '% ]' ?></option>
						<?php endwhile; ?>
					</select>
					<small>months [ interest%,penalty% ]</small>
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Loan Amount</label>
					<input type="number" name="amount" class="form-control text-right" step="any" id="" value="<?php echo isset($amount) ? $amount : '' ?>">
				</div>
			</div>

			<!-- new form else.. -->
			<div class="row">
				<div class="col-md-6">
					<label class="control-label">Village</label>
					<input readonly type="text" name="branch" class="form-control text-right" step="any" id="village" value="<?php echo isset($branch) ? $branch : '' ?>">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Group</label>
					<input readonly type="text" name="group_name" class="form-control text-right" step="any" id="group_name" value="<?php echo isset($center) ? $center : '' ?>">
					<input type="hidden" name="group" class="form-control text-right" step="any" id="group" value="<?php echo isset($center) ? $center : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Reference Number</label>
					<input type="text" name="ref_no" class="form-control text-right" step="any" id="" value="<?php echo isset($ref_no) ? $ref_no : '' ?>">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Contact Number</label>
					<input readonly type="text" name="m_contact" class="form-control text-right" step="any" id="mobile" value="<?php echo isset($m_contact) ? $m_contact : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Permanant Address</label>
					<input readonly type="text" name="m_address" class="form-control text-right" step="any" id="address" value="<?php echo isset($m_address) ? $m_address : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Loan Purpose</label>
					<textarea name="purpose" id="" cols="30" rows="2" class="form-control"><?php echo isset($purpose) ? $purpose : '' ?></textarea>
				</div>
			</div>

			<hr>

			<div class="row">
				<!-- main guarantor -->
				<div class="form-group col-md-12 text-center">
					<label class="control-label"><strong>Main Guarantor Details (Family Member)</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor Name</label>
					<input type="text" name="main_gr_name" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_name) ? $main_gr_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor Address</label>
					<input type="text" name="main_gr_address" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_address) ? $main_gr_address : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor NIC</label>
					<input type="text" name="main_gr_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_nic) ? $main_gr_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Contact Number</label>
					<input type="text" name="main_gr_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">
				</div>
			</div>
			<hr>

			<div class="row">
				<!-- guarantor #1 -->
				<div class="form-group col-md-4">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
						<label class="form-check-label" for="flexSwitchCheckChecked">View Guarantor 01</label>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label class="control-label"><strong>Guarantor 01 Details</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor 01 Name</label>
					<input type="text" name="gr_01_name" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_01_name) ? $gr_01_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor 01 NIC</label>
					<input type="text" name="gr_01_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_01_nic) ? $gr_01_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">
					<label class="control-label">Contact Number</label>
					<input type="text" name="gr_01_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">

					<!-- <label class="control-label">Guarantor 01 Signature</label>
					<p class="text-start mt-3">............................................</p> -->
				</div>
			</div>

			<hr>

			<div class="row">
				<!-- guarantor #2 -->
				<div class="form-group col-md-4">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
						<label class="form-check-label" for="flexSwitchCheckChecked">View Guarantor 02</label>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label class="control-label"><strong>Guarantor 02 Details</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor 02 Name</label>
					<input type="text" name="gr_02_name" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_02_name) ? $gr_02_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor 02 NIC</label>
					<input type="text" name="gr_02_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_02_nic) ? $gr_02_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">

					<label class="control-label">Contact Number</label>
					<input type="text" name="gr_02_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">
					<!-- <label class="control-label">Guarantor 02 Signature</label>
					<p class="text-start mt-3">............................................</p> -->
				</div>
			</div>

			<hr>

			<div class="row">
				<!-- guarantor #3 -->
				<div class="form-group col-md-4">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
						<label class="form-check-label" for="flexSwitchCheckChecked">View Guarantor 03</label>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label class="control-label"><strong>Guarantor 03 Details</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor 03 Name</label>
					<input type="text" name="gr_03_name" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_03_name) ? $gr_03_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor 03 NIC</label>
					<input type="text" name="gr_03_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_03_nic) ? $gr_03_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">

					<label class="control-label">Contact Number</label>
					<input type="text" name="gr_03_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">

					<!-- <label class="control-label">Guarantor 03 Signature</label>
					<p class="text-start mt-3">............................................</p> -->
				</div>
			</div>

			<hr>

			<div class="row">
				<!-- guarantor #4 -->
				<div class="form-group col-md-4">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
						<label class="form-check-label" for="flexSwitchCheckChecked">View Guarantor 04</label>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label class="control-label"><strong>Guarantor 04 Details</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor 04 Name</label>
					<input type="text" name="gr_04_name" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_04_name) ? $gr_04_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor 04 NIC</label>
					<input type="text" name="gr_04_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_04_nic) ? $gr_04_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">

					<label class="control-label">Contact Number</label>
					<input type="text" name="gr_04_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">

					<!-- <label class="control-label">Guarantor 04 Signature</label>
					<p class="text-start mt-3">............................................</p> -->
				</div>
			</div>

			<hr>

			<div class="row">
				<!-- guarantor #5 -->
				<div class="form-group col-md-4">
					<div class="form-check form-switch">
						<input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
						<label class="form-check-label" for="flexSwitchCheckChecked">View Guarantor 05</label>
					</div>
				</div>
				<div class="form-group col-md-8">
					<label class="control-label"><strong>Guarantor 05 Details</strong></label>
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label">Guarantor 05 Name</label>
					<input type="text" name="gr_05_name" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_05_name) ? $gr_05_name : '' ?>">
				</div>
			</div>

			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Guarantor 05 NIC</label>
					<input type="text" name="gr_05_nic" class="form-control text-right" step="any" id="" value="<?php echo isset($gr_05_nic) ? $gr_05_nic : '' ?>">
				</div>
				<div class="form-group col-md-6">

					<label class="control-label">Contact Number</label>
					<input type="text" name="gr_05_contact" class="form-control text-right" step="any" id="" value="<?php echo isset($main_gr_contact) ? $main_gr_contact : '' ?>">

					<!-- <label class="control-label">Guarantor 05 Signature</label>
					<p class="text-start mt-3">............................................</p> -->
				</div>
			</div>

			<hr>
			<div class="row">
				<div class="form-group col-md-12">
					<div class="custom-file">
						<input type="file" class="custom-file-input" id="customFile">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>
			</div>

			<hr>

			<div class="row">
				<div class="form-group col-md-12">
					<label class="control-label"><strong>For Office Use Only</strong></label>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-6">
					<label class="control-label">Name of the officer in charge of the Center</label>
					<!-- <input type="text" name="amount" class="form-control text-right" step="any" id="" value="<?php echo isset($oic_name) ? $oic_name : '' ?>"> -->

					<?php
					$users = $conn->query("SELECT * FROM users order by `id` desc ");
					?>
					<select name="officer_id" id="" class="custom-select browser-default select2">
						<option value=""></option>
						<?php while ($row = $users->fetch_assoc()) : ?>
							<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<!-- end of new form ele.. -->

			<div class="row">
				<div class="form-group col-md-12 justify-content-center">
					<input type="hidden" id="monthlyPaybleAmt" name="monthlyPaybleAmt" value="">
					<input type="hidden" id="penaltyAmt" name="penaltyAmt" value="">
					<label class="control-label">&nbsp;</label>
					<button class="btn btn-primary btn-sm btn-block align-self-end" type="button" id="calculate">Calculate Loan</button>
				</div>
			</div>

			<div id="calculation_table">

			</div>
			<?php if (isset($status)) : ?>
				<div class="row">
					<div class="form-group col-md-6">
						<label class="control-label">&nbsp;</label>
						<select class="custom-select browser-default" name="status">
							<option value="0" <?php echo $status == 0 ? "selected" : '' ?>>For Approval</option>
							<option value="1" <?php echo $status == 1 ? "selected" : '' ?>>Approved</option>
							<?php if ($status != '4') : ?>
								<option value="2" <?php echo $status == 2 ? "selected" : '' ?>>Released</option>
							<?php endif ?>
							<?php if ($status == '2') : ?>
								<option value="3" <?php echo $status == 3 ? "selected" : '' ?>>Complete</option>
							<?php endif ?>
							<?php if ($status != '2') : ?>
								<option value="4" <?php echo $status == 4 ? "selected" : '' ?>>Denied</option>
							<?php endif ?>
						</select>
					</div>
				</div>
				<hr>
			<?php endif ?>
			<div id="row-field">
				<div class="row ">
					<div class="col-md-12 text-center">
						<button class="btn btn-primary btn-md delaysubmit">Submit</button>
						<button class="btn btn-danger btn-md" type="button" data-dismiss="modal">Cancel</button>
					</div>
				</div>
			</div>

		</form>
	</div>
</div>
<script>
	$('.select2').select2({
		placeholder: "Please select here",
		width: "100%"
	})
	$('#calculate').click(function() {
		calculate()
	})

	function calculate() {
		start_load()
		if ($('#loan_plan_id').val() == '' || $('[name="amount"]').val() == '') {
			alert_toast("Select plan and enter amount first.", "warning");
			return false;
		}
		var plan = $("#plan_id option[value='" + $("#plan_id").val() + "']")
		$.ajax({
			url: "calculation_table.php",
			method: "POST",
			data: {
				amount: $('[name="amount"]').val(),
				months: plan.attr('data-months'),
				interest: plan.attr('data-interest_percentage'),
				penalty: plan.attr('data-penalty_rate')
			},
			success: function(resp) {
				if (resp) {

					$('#calculation_table').html(resp)
					end_load()
				}
			}

		})
	}

	function setup_selected_user_data() {
		var user_id = document.getElementById("borrower_id").value;

		$.ajax({
			url: 'ajax.php?action=load_user',
			method: "POST",
			data: {
				user_id: user_id,
			},
			success: function(resp) {
				resp = JSON.parse(resp);
				// console.log(resp)

				document.getElementById("village").value = resp.village.village
				document.getElementById("group_name").value = resp.user.group
				document.getElementById("group").value = resp.user.id
				document.getElementById("mobile").value = resp.user.contact_no
				document.getElementById("address").value = resp.user.address
			}
		})
	}

	$('#loan-application').submit(function(e) {
		e.preventDefault()
		start_load()
		calculateMonthlyRate();
		$.ajax({
			url: 'ajax.php?action=save_loan',
			method: "POST",
			data: $(this).serialize(),
			success: function(resp) {
				if (resp == 1) {
					$('.modal').modal('hide')
					alert_toast("Loan Data successfully saved.", "success")
					setTimeout(function() {
						location.reload();
					}, 1500)
				}
			}
		})
	})

	function calculateMonthlyRate() {
		var plan = $("#plan_id option[value='" + $("#plan_id").val() + "']")

		var amount = $('[name="amount"]').val();
		var months = plan.attr('data-months');
		var interest = plan.attr('data-interest_percentage');
		var penalty = plan.attr('data-penalty_rate');

		//calculate value
		var monthlyPaybleAmt = (parseFloat(amount) + (parseFloat(amount) * (parseInt(interest) / 100))) / parseInt(months);
		var penaltyAmt = parseFloat(monthlyPaybleAmt) * (parseFloat(penalty) / 100);
		// var totalPayble = parseFloat(monthlyPaybleAmt) * parseInt(months);

		//set calculated values to input
		document.getElementById("monthlyPaybleAmt").value = parseFloat(monthlyPaybleAmt)
		document.getElementById("penaltyAmt").value = parseFloat(penaltyAmt)
	}

	$(document).ready(function() {
		if ('<?php echo isset($_GET['id']) ?>' == 1)
			calculate()
	});

	// name of the file appear on select
	$(".custom-file-input").on("change", function() {
		var fup = document.getElementById('customFile');
		var fileName = fup.value;
		var ext = fileName.substring(fileName.lastIndexOf('.') + 1);

		if (ext == "pdf") {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);

			//save uploaded file to project directory
			alert_toast("PDF File Uploaded !", "success")
		} else {
			alert_toast("PDF Files Only Allowed !", "danger")
			fup.focus();
		}
	});
</script>
<style>
	#uni_modal .modal-footer {
		display: none
	}
</style>