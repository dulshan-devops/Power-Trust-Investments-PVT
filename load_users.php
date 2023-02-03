<?php include 'db_connect.php' ?>
<?php
extract($_POST);
?>

<div class="form-group">
    <label for="">Loan Reference</label>
    <select name="loan_id" id="loan_id" class="custom-select browser-default select2">
        <option value=""></option>
        <?php
        $loan_refs_data = $conn->query("SELECT * FROM loan_list where group_id = '" . $group_id . "' and status = 2 ");
        while ($row = $loan_refs_data->fetch_assoc()) :

            $user_data = $conn->query("SELECT * from borrowers where id = " . $row['borrower_id']);
            $user_data = $user_data->fetch_array(MYSQLI_ASSOC);

            //setup penalty amount inputs
            $loan = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id where l.id = " . $row['id']);

            foreach ($loan->fetch_array() as $k => $v) {
                $meta[$k] = $v;
            }

            $plan_arr = $conn->query("SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan FROM loan_plan where id  = '" . $meta['plan_id'] . "' ")->fetch_array();

            $monthly = ($meta['amount'] + ($meta['amount'] * ($plan_arr['interest_percentage'] / 100))) / $plan_arr['months'];
            $penalty = $monthly * ($plan_arr['penalty_rate'] / 100);

            $add = (date('Ymd', strtotime($next)) < date("Ymd")) ?  $penalty : 0;
            $p_amt = number_format($monthly + $add, 2);
        ?>
            <option value="<?php echo $row['id'] ?>"><?php echo "ID : " . $row['ref_no'] . " | NAME : " . $user_data['firstname'] . " " . $user_data['lastname'] ?></option>
        <?php endwhile; ?>
    </select>
    <input type="hidden" name="penalty_amount" value="<?php echo $add ?>">
    <input type="hidden" name="overdue" value="<?php echo $add > 0 ? 1 : 0 ?>">
</div>

<script>
    $('.select2').select2({
        placeholder: "Please select here",
        width: "100%"
    })
</script>