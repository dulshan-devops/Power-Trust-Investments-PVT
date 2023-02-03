<table class="table-striped table-bordered col-md-12">
    <thead>
        <tr>
            <th class="text-center">Village Name</th>
            <th class="text-centetr">Group ID</th>
            <th class="text-center">Loan Facility No</th>
            <th class="text-center">Name</th>
            <th class="text-center">Personal Details</th>
            <th class="text-center">Orginal Loan Amount</th>
            <th class="text-center">Total Outsanding</th>
            <th class="text-center">Monthly Payment</th>
            <th class="text-center">History View</th>
        </tr>
    </thead>
    <tbody>
        <?php
        include 'db_connect.php';
        extract($_POST);

        if ($event == 0) {
            $qry = "SELECT * from loan_list;";
            $loan_list = $conn->query($qry);
        } else if ($event == 1) {
            //village_id
            $village_id = $conn->query("SELECT * FROM villages WHERE village = '" . $village . "';");
            $village_id = $village_id->fetch_array(MYSQLI_ASSOC);
            $village_id = $village_id['id'];

            //all loan_list in grp_id
            $loan_list = $conn->query("SELECT * FROM loan_list WHERE group_id = '" . $village_id . "';");
        } else if ($event == 2) {
            //get groups data related to selected village
            $groups = $conn->query("SELECT * FROM groups WHERE village_id = '" . $village . "';");
            $groups = $groups->fetch_array(MYSQLI_ASSOC);
            // echo json_encode($village);
            // echo json_encode($groups['id']);

            //get loan_list data related to groups data
            $loan_list = $conn->query("SELECT * FROM loan_list WHERE group_id = '" . $groups['id'] . "';");
        }

        $i = 1;

        while ($row = $loan_list->fetch_assoc()) :

            //groups data
            $groups_data = $conn->query("SELECT * FROM groups WHERE id='" . $row['group_id'] . "';");
            $groups_data = mysqli_fetch_assoc($groups_data);

            //village details
            $village_data = $conn->query("SELECT * FROM villages WHERE id='" . $groups_data['village_id'] . "';");
            $village_data = mysqli_fetch_assoc($village_data);

            //user details
            $user_data = $conn->query("SELECT  * from borrowers WHERE id = '" . $row['borrower_id'] . "';");
            $user_data = mysqli_fetch_assoc($user_data);

            //get this month payment
            $today = date("Y-m-d");
            $today_year = date('Y', strtotime($today));
            $today_month = date('F', strtotime($today));

            $latest_payment = $conn->query("SELECT * FROM payments WHERE loan_id = '" . $row['id'] . "' ORDER BY date_created desc;");
            $latest_payment = $latest_payment->fetch_array(MYSQLI_ASSOC);

            if (!is_null($latest_payment)) {
                $latest_payment_year = date('Y', strtotime($latest_payment['date_created']));
                $latest_payment_month = date('F', strtotime($latest_payment['date_created']));

                if ($today_year == $latest_payment_year && $today_month == $latest_payment_month) {
                    $monthly_balance = ($row['monthly_payment'] - $latest_payment['amount']);
                }
            }

            $loan_plan_data = $conn->query("SELECT  `months` from loan_plan WHERE id = '" . $row['plan_id'] . "';");
            $loan_plan_data = mysqli_fetch_assoc($loan_plan_data);

            $total_paid = $conn->query("SELECT SUM(amount) AS total_paid FROM payments WHERE loan_id = '" . $row['id'] . "';");
            $total_paid = mysqli_fetch_assoc($total_paid);

        ?>
            <tr>
                <td>
                    <center>
                        <?php echo $village_data['village'] ?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php echo $groups_data['group'] ?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php echo $row['ref_no'] ?>
                    </center>
                </td>
                <td>
                    <center>
                        <?php echo $user_data['firstname'] . " " . $user_data['lastname'] ?>
                    </center>
                </td>
                <td>
                    <center>
                        <button type="button" class="btn btn-primary btn-sm btn-block" id="view_application" onclick="view_modal(<?php echo $row['ref_no'] ?>)" data-toggle="modal" data-target="#view_application_modal">View</button>
                    </center>
                </td>
                <td>
                    <center>
                        <?php echo number_format($row['amount'], 2) ?>
                    </center>
                </td>

                <td>
                    <center>
                        <?php echo number_format(($row['monthly_payment'] * $loan_plan_data['months'] - $total_paid['total_paid']), 2) ?>
                    </center>
                </td>

                <td>
                    <center>
                        <?php
                        echo number_format($row['monthly_payment'], 2); ?>
                    </center>
                </td>

                <td>
                    <center>
                        <button type="button" class="btn btn-primary btn-sm btn-block" id="view_history" onclick="setup_loan_id_to_history(<?php echo $row['id'] ?>)">View</button>
                    </center>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>