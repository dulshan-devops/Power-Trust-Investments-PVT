<?php
session_start();
ini_set('display_errors', 1);
class Action
{
	private $db;

	public function __construct()
	{
		ob_start();
		include 'db_connect.php';

		$this->db = $conn;
	}
	function __destruct()
	{
		$this->db->close();
		ob_end_flush();
	}

	function login()
	{
		extract($_POST);
		$username = $this->db->real_escape_string($username);
		$password = $this->db->real_escape_string($password);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $username . "' and password = '" . $password . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function login2()
	{
		extract($_POST);
		$qry = $this->db->query("SELECT * FROM users where username = '" . $email . "' and password = '" . md5($password) . "' ");
		if ($qry->num_rows > 0) {
			foreach ($qry->fetch_array() as $key => $value) {
				if ($key != 'passwors' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
			return 1;
		} else {
			return 3;
		}
	}
	function logout()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:login.php");
	}
	function logout2()
	{
		session_destroy();
		foreach ($_SESSION as $key => $value) {
			unset($_SESSION[$key]);
		}
		header("location:../index.php");
	}

	function save_user()
	{
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", password = '$password' ";
		$data .= ", type = '$type' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO users set " . $data);
		} else {
			$save = $this->db->query("UPDATE users set " . $data . " where id = " . $id);
		}
		if ($save) {
			return 1;
		}
	}
	function signup()
	{
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", contact = '$contact' ";
		$data .= ", address = '$address' ";
		$data .= ", username = '$email' ";
		$data .= ", password = '" . md5($password) . "' ";
		$data .= ", type = 3";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' ")->num_rows;
		if ($chk > 0) {
			return 2;
			exit;
		}
		$save = $this->db->query("INSERT INTO users set " . $data);
		if ($save) {
			$qry = $this->db->query("SELECT * FROM users where username = '" . $email . "' and password = '" . md5($password) . "' ");
			if ($qry->num_rows > 0) {
				foreach ($qry->fetch_array() as $key => $value) {
					if ($key != 'passwors' && !is_numeric($key))
						$_SESSION['login_' . $key] = $value;
				}
			}
			return 1;
		}
	}

	function save_settings()
	{
		extract($_POST);
		$data = " name = '" . str_replace("'", "&#x2019;", $name) . "' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '" . htmlentities(str_replace("'", "&#x2019;", $about)) . "' ";
		if ($_FILES['img']['tmp_name'] != '') {
			$fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['img']['name'];
			$move = move_uploaded_file($_FILES['img']['tmp_name'], '../assets/img/' . $fname);
			$data .= ", cover_img = '$fname' ";
		}

		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if ($chk->num_rows > 0) {
			$save = $this->db->query("UPDATE system_settings set " . $data);
		} else {
			$save = $this->db->query("INSERT INTO system_settings set " . $data);
		}
		if ($save) {
			$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
			foreach ($query as $key => $value) {
				if (!is_numeric($key))
					$_SESSION['setting_' . $key] = $value;
			}

			return 1;
		}
	}


	function save_loan_type()
	{
		extract($_POST);
		$data = " type_name = '$type_name' ";
		$data .= " , description = '$description' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO loan_types set " . $data);
		} else {
			$save = $this->db->query("UPDATE loan_types set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_loan_type()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM loan_types where id = " . $id);
		if ($delete)
			return 1;
	}
	function delete_user()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM users where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_plan()
	{
		extract($_POST);
		$data = " months = '$months' ";
		$data .= ", interest_percentage = '$interest_percentage' ";
		$data .= ", penalty_rate = '$penalty_rate' ";

		if (empty($id)) {
			$save = $this->db->query("INSERT INTO loan_plan set " . $data);
		} else {
			$save = $this->db->query("UPDATE loan_plan set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_plan()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM loan_plan where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_borrower()
	{
		extract($_POST);
		$data = " lastname = '$lastname' ";
		$data .= ", firstname = '$firstname' ";
		// $data .= ", middlename = '$middlename' ";
		$data .= ", address = '$address' ";
		$data .= ", contact_no = '$contact_no' ";
		$data .= ", email = '$email' ";
		$data .= ", nic = '$br_nic' ";
		// $data .= ", village = '$village' ";
		$data .= ", group_id = '$group' ";

		if (empty($id)) {
			$save = $this->db->query("INSERT INTO borrowers set " . $data);
		} else {
			$save = $this->db->query("UPDATE borrowers set " . $data . " where id=" . $id);
		}
		if ($save)
			return 1;
	}
	function delete_borrower()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM borrowers where id = " . $id);
		if ($delete)
			return 1;
	}
	function save_loan()
	{
		extract($_POST);
		$status = (empty($status)) ? 0 : $status;
		$created_at = date("Y/m/d");

		// loan list data set
		$loan_data = " loan_type_id = '$loan_type_id' ";
		$loan_data .= " , borrower_id = '$borrower_id' ";
		$loan_data .= " , amount = '$amount' ";
		$loan_data .= " , purpose = '$purpose' ";
		$loan_data .= " , plan_id = '$plan_id' ";
		$loan_data .= " , group_id = '2' ";
		$loan_data .= " , monthly_payment = '$monthlyPaybleAmt' ";
		$loan_data .= " , penlty_amount = '$penaltyAmt' ";
		$loan_data .= " , status = '0' ";
		$loan_data .= " , date_released = '$created_at' ";
		$loan_data .= " , ex_date = '$created_at' ";
		$loan_data .= " , date_created = '$created_at' ";

		//gurantors data set
		$gurantor_data = " mg_name = '$main_gr_name' ";
		$gurantor_data .= " , mg_nic = '$main_gr_nic' ";
		$gurantor_data .= " , mg_address = '$main_gr_address' ";
		$gurantor_data .= " , mg_mobile = '$main_gr_contact' ";
		$gurantor_data .= " , g1_name = '$gr_01_name' ";
		$gurantor_data .= " , g1_nic = '$gr_01_nic' ";
		$gurantor_data .= " , g1_mobile = '$gr_01_contact' ";
		$gurantor_data .= " , g2_name = '$gr_02_name' ";
		$gurantor_data .= " , g2_nic = '$gr_02_nic' ";
		$gurantor_data .= " , g2_mobile = '$gr_02_contact' ";
		$gurantor_data .= " , g3_name = '$gr_03_name' ";
		$gurantor_data .= " , g3_nic = '$gr_03_nic' ";
		$gurantor_data .= " , g3_mobile = '$gr_03_contact' ";

		$gurantor_data .= " , g4_name = '$gr_04_name' ";
		$gurantor_data .= " , g4_nic = '$gr_04_nic' ";
		$gurantor_data .= " , g4_mobile = '$gr_04_contact' ";
		$gurantor_data .= " , g5_name = '$gr_05_name' ";
		$gurantor_data .= " , g5_nic = '$gr_05_nic' ";
		$gurantor_data .= " , g5_mobile = '$gr_05_contact' ";
		$gurantor_data .= " , officer = '$officer_id' ";

		if (isset($status)) {
			if ($status == 2) {
				$plan = $this->db->query("SELECT * FROM loan_plan where id = $plan_id ")->fetch_array();
				for ($i = 1; $i <= $plan['months']; $i++) {
					$date = date("Y-m-d", strtotime(date("Y-m-d") . " +" . $i . " months"));
					$chk = $this->db->query("SELECT * FROM loan_schedules where loan_id = $id and date(date_due) ='$date'  ");
					if ($chk->num_rows > 0) {
						$ls_id = $chk->fetch_array()['id'];
						$this->db->query("UPDATE loan_schedules set loan_id = $id, date_due ='$date' where id = $ls_id ");
					} else {
						$this->db->query("INSERT INTO loan_schedules set loan_id = $id, date_due ='$date' ");
						$ls_id = $this->db->insert_id;
					}
					$sid[] = $ls_id;
				}
				$sid = implode(",", $sid);
				$this->db->query("DELETE FROM loan_schedules where loan_id = $id and id not in ($sid) ");
				$data .= " , date_released = '" . date("Y-m-d H:i") . "' ";
			} else {
				$chk = $this->db->query("SELECT * FROM loan_schedules where loan_id = $id");
				if (!empty($chk) && $chk->num_rows > 0) {
					$this->db->query("DELETE FROM loan_schedules where loan_id = $id ");
				}
			}
		}
		if (empty($id)) {
			$ref_no = mt_rand(1, 99999999);
			$i = 1;

			while ($i == 1) {
				$check = $this->db->query("SELECT * FROM loan_list where ref_no ='$ref_no' ");
				if (!empty($check) && $check->num_rows > 0) {
					$ref_no = mt_rand(1, 99999999);
				} else {
					$i = 0;
				}
			}
			$loan_data .= " , ref_no = '$ref_no' ";
			$gurantor_data .= " , ref_no = '$ref_no' ";
		}
		if (empty($id)) {
			//save loan list
			$save = $this->db->query("INSERT INTO loan_list set " . $loan_data);

			//save garantors
			$save = $this->db->query("INSERT INTO gurantors set " . $gurantor_data);
		} else {
			$save = $this->db->query("UPDATE `loan_list` set $data WHERE id=$id");
		}
		if ($save)
			return 1;
	}
	function delete_loan()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM loan_list where id = " . $id);

		//need delete gurantors
		if ($delete)
			return 1;
	}
	function save_payment()
	{
		extract($_POST);

		//setup payee
		$loan_data = $this->db->query("SELECT * from loan_list where id = " . $loan_id);
		$loan_data = $loan_data->fetch_array(MYSQLI_ASSOC);

		$payee_data = $this->db->query("SELECT * from borrowers where id = " . $loan_data['borrower_id']);
		$payee_data = $payee_data->fetch_array(MYSQLI_ASSOC);
		$payee = $payee_data['id'];

		$data = " loan_id = $loan_id ";
		$data .= " , payee = '$payee' ";
		$data .= " , amount = '$amount' ";
		$data .= " , penalty_amount = '$penalty_amount' ";
		$data .= " , overdue = '$overdue' ";
		$data .= " , payment_type = '$payment_type' ";
		if (empty($id)) {
			$save = $this->db->query("INSERT INTO payments set " . $data);
		} else {
			$save = $this->db->query("UPDATE payments set " . $data . " where id = " . $id);
		}
		if ($save)
			return 1;
	}
	function delete_payment()
	{
		extract($_POST);
		$delete = $this->db->query("DELETE FROM payments where id = " . $id);
		if ($delete)
			return 1;
	}

	//add village - 2022-12-26 - d
	function save_village()
	{
		extract($_POST);
		$save = $this->db->query("INSERT INTO `villages`(`village`) VALUES ('$village');");

		if ($save) {
			return 1;
		}
	}

	//delete village - 2022-12-29 - d
	function delete_village()
	{
		extract($_POST);

		$delete = $this->db->query("DELETE FROM villages where id = " . $vid);
		if ($delete)
			return 1;
	}

	//view loan application - 2022-12-27 - d
	function view_application()
	{
		extract($_POST);
		//loan application data
		$loan_data = $this->db->query("SELECT * FROM loan_list where ref_no = '" . $id . "';");
		$row = $loan_data->fetch_array(MYSQLI_ASSOC);

		//loan id (table_id)
		$loan_id = $row['id'];

		//borrower details
		$borrower_id = $row['borrower_id'];
		$user_data = $this->db->query("SELECT * FROM borrowers where id = '" . $borrower_id . "';");
		$user = $user_data->fetch_array(MYSQLI_ASSOC);

		//loan type details
		$type_id = $row['loan_type_id'];
		$loan_type_data = $this->db->query("SELECT * FROM loan_types where id = '" . $type_id . "';");
		$loan_type = $loan_type_data->fetch_array(MYSQLI_ASSOC);

		$plan_id = $row['plan_id'];
		$loan_plan_data = $this->db->query("SELECT * FROM loan_plan where id = '" . $plan_id . "';");
		$loan_plan = $loan_plan_data->fetch_array(MYSQLI_ASSOC);

		//loan amount
		$loan_amount = $row['amount'];

		//loan plan details
		$plan_id = $row['plan_id'];

		//gurantors details
		$gurantors_data = $this->db->query("SELECT * FROM gurantors where ref_no = '" . $id . "';");
		$gurantors_data = $gurantors_data->fetch_array(MYSQLI_ASSOC);

		//office details
		$officer = $this->db->query("SELECT * FROM users where id = '" . $gurantors_data['officer'] . "';");
		$officer = $officer->fetch_array(MYSQLI_ASSOC);

		return array("loan_id" => $loan_id, "type_id" => $type_id, "user" => $user, "date" => $row['date_created'], "loan_purpose" => $row['purpose'], "loan_amount" => $loan_amount, "loan_plan" => $loan_plan, "loan_type" => $loan_type, "gurantors" => $gurantors_data , "officer" => $officer);
	}

	function approve_application()
	{
		extract($_POST);
		$result = $this->db->query("UPDATE `loan_list` SET `status`=2 WHERE `ref_no`='" . $id . "';");

		if ($result) {
			return 1;
		}
	}

	function save_group()
	{
		extract($_POST);
		$save = $this->db->query("INSERT INTO `groups`(`village_id` , `group`) VALUES ('$village' , '$group_name');");

		if ($save) {
			return 1;
		}
	}

	function edit_village()
	{
		extract($_POST);
		$result = $this->db->query("UPDATE `villages` SET `village`='" . $new_village . "' WHERE `id`='" . $vid . "';");

		if ($result) {
			return 1;
		}
	}

	function load_user()
	{
		extract($_POST);
		$result = $this->db->query("SELECT borrowers.contact_no, borrowers.address, borrowers.email,borrowers.nic,groups.village_id, groups.group FROM borrowers INNER JOIN groups ON borrowers.group_id=groups.id WHERE borrowers.id='" . $user_id . "';");
		$user_data = $result->fetch_array(MYSQLI_ASSOC);

		$village_result = $this->db->query("SELECT villages.village FROM villages INNER JOIN groups ON groups.village_id=villages.id WHERE groups.village_id='" . $user_data['village_id'] . "';");
		$village_data = $village_result->fetch_array(MYSQLI_ASSOC);
		if ($result) {
			return array("user" => $user_data, "village" => $village_data);
		}
	}

	//view loan application - 2022-1-16 - d - load users to payments by group id
	function load_users()
	{
		extract($_POST);
		$loan_list_data = $this->db->query("SELECT `borrower_id`,`ref_no` from loan_list where group_id = " . $group_id);
		$loan_list_data = $loan_list_data->fetch_array(MYSQLI_ASSOC);

		return array("loan_list" => $loan_list_data);
	}
}
