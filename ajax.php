<?php
if (!defined('ABSPATH'))
	define('ABSPATH', __DIR__);

ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();

include 'db_connect.php';

if ($action == 'login') {
	$login = $crud->login();
	if ($login)
		echo $login;
}
if ($action == 'login2') {
	$login = $crud->login2();
	if ($login)
		echo $login;
}
if ($action == 'logout') {
	$logout = $crud->logout();
	if ($logout)
		echo $logout;
}
if ($action == 'logout2') {
	$logout = $crud->logout2();
	if ($logout)
		echo $logout;
}
if ($action == 'save_user') {
	$save = $crud->save_user();
	if ($save)
		echo $save;
}
if ($action == 'delete_user') {
	$save = $crud->delete_user();
	if ($save)
		echo $save;
}
if ($action == 'signup') {
	$save = $crud->signup();
	if ($save)
		echo $save;
}
if ($action == "save_settings") {
	$save = $crud->save_settings();
	if ($save)
		echo $save;
}
if ($action == "save_loan_type") {
	$save = $crud->save_loan_type();
	if ($save)
		echo $save;
}
if ($action == "delete_loan_type") {
	$save = $crud->delete_loan_type();
	if ($save)
		echo $save;
}
if ($action == "save_plan") {
	$save = $crud->save_plan();
	if ($save)
		echo $save;
}
if ($action == "delete_plan") {
	$save = $crud->delete_plan();
	if ($save)
		echo $save;
}
if ($action == "save_borrower") {
	$save = $crud->save_borrower();
	if ($save)
		echo $save;
}
if ($action == "delete_borrower") {
	$save = $crud->delete_borrower();
	if ($save)
		echo $save;
}
if ($action == "save_loan") {
	$save = $crud->save_loan();
	if ($save)
		echo $save;
}
if ($action == "delete_loan") {
	$save = $crud->delete_loan();
	if ($save)
		echo $save;
}

if ($action == "save_payment") {
	$save = $crud->save_payment();
	if ($save)
		echo $save;
}
if ($action == "delete_payment") {
	$save = $crud->delete_payment();
	if ($save)
		echo $save;
}

//add village - 2022-12-26 - Dilshan
if ($action == "save_village") {
	$save = $crud->save_village();
	if ($save)
		echo $save;
}

//delete village - 2022-12-29 - Dilshan
if ($action == "delete_village") {
	$save = $crud->delete_village();
	if ($save)
		echo $save;
}

//view loan application - 2022-12-27 - Dilshan 
if ($action == "load_application") {
	$save = $crud->view_application();
	if ($save)
		echo json_encode($save);
}

//approve loan application - 2022-12-28 - Dilshan 
if ($action == "approve_application") {
	$save = $crud->approve_application();
	if ($save)
		echo $save;
}

//save group - 2022-12-28 - Dilshan 
if ($action == "save_group") {
	$save = $crud->save_group();
	if ($save)
		echo $save;
}

//edit village - 2022-12-31 - Dilshan 
if ($action == "edit_village") {
	$save = $crud->edit_village();
	if ($save)
		echo $save;
}

//load user - 2023-01-03 - Dilshan 
if ($action == "load_user") {
	$save = $crud->load_user();
	if ($save)
		echo json_encode($save);
}

//load groups - 2023-01-06 - Dilshan
// if ($action == "load_groups") {

// 	$save = $crud->load_groups();
// 	if ($save)
// 		echo json_encode($save);

// }

//load users - 2023-01-16 - Dilshan - load users to payments by group id
if ($action == "load_users") {
	$save = $crud->load_users();
	if ($save)
		echo json_encode($save);
}



if ($action == "manage_user") {
	include_once ABSPATH . '/views/actions/manage_user.php';
	ob_flush();
	exit;
}
