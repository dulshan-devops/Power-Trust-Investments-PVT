<?php include 'db_connect.php' ?>
<?php
extract($_POST);


//setup penalty amount inputs
$loan = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id where l.id = " . $loan_id);

foreach ($loan->fetch_array() as $k => $v) {
    $meta[$k] = $v;
}

$plan_arr = $conn->query("SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan FROM loan_plan where id  = '" . $meta['plan_id'] . "' ")->fetch_array();

$monthly = ($meta['amount'] + ($meta['amount'] * ($plan_arr['interest_percentage'] / 100))) / $plan_arr['months'];
$penalty = $monthly * ($plan_arr['penalty_rate'] / 100);

$payments = $conn->query("SELECT * from payments where loan_id =" . $loan_id);
$paid = $payments->num_rows;
$offset = $paid > 0 ? " offset $paid " : "";
$next = $conn->query("SELECT * FROM loan_schedules where loan_id = '" . $loan_id . "'  order by date(date_due) asc limit 1 $offset ")->fetch_assoc()['date_due'];

//relesed date - calculate aries
$relesed_date = $conn->query("SELECT `date_released` as relesed_date from loan_list where id =" . $loan_id);
$relesed_date = $relesed_date->fetch_array(MYSQLI_ASSOC);

//# of months after loan relesed
$start = new DateTime($relesed_date['relesed_date']);
$end = new DateTime();
$difference = $start->diff($end);
$difference = $difference->m + ($difference->y * 12);

//amount of need pay (monthly * # of months)
$total_payble = $monthly * $difference;

//user paid amount
$total_paid = $conn->query("SELECT SUM(`amount`) as total_paid from payments where loan_id =" . $loan_id);
$total_paid = $total_paid->fetch_array(MYSQLI_ASSOC);
$total_paid = $total_paid['total_paid'];

//aries
$aries_amount = $total_payble - $total_paid;

?>

<div class="col-lg-12">
    <hr>
    <table width="100%">
        <tr>
            <th class="text-center" width="25%">Monthly</th>
            <th class="text-center" width="25%">Penalty</th>
            <th class="text-center" width="25%">Payable</th>
            <th class="text-center" width="25%">Aries </th>
        </tr>
        <tr>
            <td class="text-center"><small><?php echo number_format($monthly, 2) ?></small></td>
            <td class="text-center"><small><?php echo $add = (date('Ymd', strtotime($next)) < date("Ymd")) ?  number_format($penalty , 2) : number_format(0 , 2); ?></small></td>
            <td class="text-center"><small><?php echo number_format($monthly + $add, 2) ?></small></td>
            <td class="text-center"><small><?php echo ($aries_amount < 0) ? number_format(0, 2):number_format($aries_amount, 2) ?></small></td>
        </tr>
    </table>
    <hr>
</div>