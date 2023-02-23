<div class="container">
    <div class="row">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">
                        <center>
                            Date
                        </center>
                    </th>
                    <th scope="col">
                        <center>
                        Loan Disbursement (With Interest)
                        </center>
                    </th>
                    <th scope="col">
                        <center>
                        Installments
                        </center>
                    </th>
                    <th scope="col">
                        <center>
                            Aries
                        </center>
                    </th>
                    <th scope="col">
                        <center>
                            Outsanding
                        </center>
                    </th>
                </tr>
            </thead>


            <tbody>
                <?php
                include 'db_connect.php';
                $payments = $conn->query("SELECT * FROM payments where loan_id=" . $_GET['id']);

                $loan_list = $conn->query("SELECT * FROM loan_list where id=" . $_GET['id']);
                $loan_list = $loan_list->fetch_array(MYSQLI_ASSOC);

                $loan_plan_data = $conn->query("SELECT * FROM loan_plan where id = '" . $loan_list['plan_id'] . "' ");
                $loan_plan_data = $loan_plan_data->fetch_array(MYSQLI_ASSOC);

                //total payble
                $total_payble = $loan_plan_data['months'] * $loan_list['monthly_payment'];

                //need validate if payments = null user not have do any payments

                while ($row = $payments->fetch_assoc()) :

                ?>
                    <tr>
                        <td>
                            <center>
                                <?php echo $row['date_created'] ?>
                            </center>
                        </td>
                        <td>
                            <center>
                            <?php echo number_format($total_payble, 2) ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo number_format($row['amount'], 2) ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo number_format($loan_list['monthly_payment'] - $row['amount'], 2) ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo ($row['payment_type'] == 1) ? "<span class='badge badge-success'>Cash</span>" : "<span class='badge badge-primary'>Card</span>"; ?>
                            </center>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
    $('[name="village"]').change(function() {
        load_groups()
    })

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

        $.ajax({
            url: 'ajax.php?action=load_groups',
            method: "POST",
            data: {
                village_id: villageID
            },
            success: function(resp) {
                if (resp) {
                    console.log(resp);
                    end_load()
                }
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