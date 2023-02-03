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

                $ref_id = $conn->query("SELECT `ref_no` AS load_id FROM loan_list where id=" . $_GET['id']);
                $ref_id = $ref_id->fetch_array(MYSQLI_ASSOC);

                $monthly_payble = $conn->query("SELECT `monthly_payment` AS monthly_payble FROM loan_list where id=" . $_GET['id']);
                $monthly_payble = $monthly_payble->fetch_array(MYSQLI_ASSOC);

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
                                0
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo number_format($row['amount'], 2) ?>
                            </center>
                        </td>
                        <td>
                            <center>
                                <?php echo number_format($monthly_payble['monthly_payble'] - $row['amount'], 2) ?>
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