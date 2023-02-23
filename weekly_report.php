<?php include 'db_connect.php' ?>
<?php
extract($_POST);
$village = $conn->query("SELECT * FROM villages where id = '" . $village_id . "' ");
$village = $village->fetch_array(MYSQLI_ASSOC);

//groups tbl data
$groups_data = $conn->query("SELECT * FROM groups where village_id = '" . $village_id . "' order by `group` ASC;");
?>




<div class="card col-lg-12" id="print">

    <div style="text-align: center; vertical-align:middle;">
        <img src="assets/img/log-logo.jpeg" alt="" style="width:150px; height : 150px; margin:auto;">

    </div>
    <h4 style="text-align: center; vertical-align:middle;"><b>POWER TRUST INVESTMENTS (PVT) LTD</b></h4>
    <h5 style="text-align: center; vertical-align:middle;margin-top : 5px;margin-bottom : 5px;"><b>Micro Finance Repayment Sheet ................................. <?php echo $village['village'] ?> </b></h5>

    <div class="card-body">
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">GROUPS</th>
                    <th scope="col">LOAN ID</th>
                    <th scope="col">NAME</th>
                    <th scope="col">LOAN AMT</th>
                    <th scope="col">DUE INSTALLMENTS</th>
                    <th scope="col">NEW LOAN AMT</th>
                    <th scope="col">DATE
                        <div class="row" style="border-top: solid 1px LightGray;">
                            <div class="col-6" style="border-right: solid 1px LightGray;">
                                Paid
                            </div>
                            <div class="col-6">
                                Collect
                            </div>
                        </div>
                    </th>
                    <th scope="col">DATE<div class="row" style="border-top: solid 1px LightGray;">
                            <div class="col-6" style="border-right: solid 1px LightGray;">
                                Paid
                            </div>
                            <div class="col-6">
                                Collect
                            </div>
                        </div>
                    </th>
                    <th scope="col">DATE<div class="row" style="border-top: solid 1px LightGray;">
                            <div class="col-6" style="border-right: solid 1px LightGray;">
                                Paid
                            </div>
                            <div class="col-6">
                                Collect
                            </div>
                        </div>
                    </th>
                    <th scope="col">DATE<div class="row" style="border-top: solid 1px LightGray;">
                            <div class="col-6" style="border-right: solid 1px LightGray;">
                                Paid
                            </div>
                            <div class="col-6">
                                Collect
                            </div>
                        </div>
                    </th>
                    <th scope="col">DATE<div class="row" style="border-top: solid 1px LightGray;">
                            <div class="col-6" style="border-right: solid 1px LightGray;">
                                Paid
                            </div>
                            <div class="col-6">
                                Collect
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($group = $groups_data->fetch_assoc()) :
                    //loan_list tbl data
                    $loan_list_data = $conn->query("SELECT * FROM loan_list where group_id = '" . $group['id'] . "' ");
                ?>
                    <?php
                    while ($loan_list = $loan_list_data->fetch_assoc()) :

                        //loan
                        $borrowers_data = $conn->query("SELECT * FROM borrowers where id = '" . $loan_list['borrower_id'] . "' ");
                        $borrowers_data = $borrowers_data->fetch_array(MYSQLI_ASSOC);

                        //total paid
                        $total_paid = $conn->query("SELECT SUM(`amount`) AS total_paid
                        FROM payments
                        WHERE loan_id = '" . $loan_list['id'] . "';");

                        $total_paid = $total_paid->fetch_array(MYSQLI_ASSOC);

                        //loan plan 
                        $loan_plan_data = $conn->query("SELECT * FROM loan_plan where id = '" . $loan_list['plan_id'] . "' ");
                        $loan_plan_data = $loan_plan_data->fetch_array(MYSQLI_ASSOC);

                        //total payble
                        $total_payble = $loan_plan_data['months'] * $loan_list['monthly_payment'];
                    ?>
                        <tr>
                            <td>
                                <p><b id=""><?php echo $group['group'] ?> </b></p>
                            </td>
                            <td>
                                <div>
                                    <p><b id=""><?php echo $loan_list['ref_no'] ?></b></p>
                                </div>
                            </td>
                            <td>
                                <p><b id=""><?php echo $borrowers_data['firstname'] . " " . $borrowers_data['lastname'] ?></b></p>

                            </td>
                            <td>
                                <p><b id=""><?php echo number_format($loan_list['amount'], 2) ?></b></p>
                            </td>
                            <td>
                                <p><b id=""><?php echo number_format($loan_list['monthly_payment'], 2) ?></b></p>
                            </td>
                            <td>
                                <p><b id=""><?php echo number_format($total_payble - $total_paid['total_paid'], 2) ?></b></p>
                            </td>
                            <td>

                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                    <?php endwhile; ?>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>

<div class="container text-center">
    <button type="button" id="toprint" class="btn btn-primary mt-2" data-dismiss="modal" style="width : 100px"><i class="fa fa-print" style="margin-right: 5px;"></i>Print</button>

</div>

<script>
    document.querySelector("#toprint").addEventListener('click', function() {
        var template = document.querySelector("#print").innerHTML;
        Popup(template);
    });

    function Popup(data) {
        var myWindow = window.open('', 'Receipt', 'height=800,width=1200');
        myWindow.document.write('<html><head><title>Receipt</title>');
        myWindow.document.write('<style type="text/css"> *, html {margin:0;padding:0;}th,td{border: 1px solid #dee2e6;}tr{border-bottom:1px solid #dee2e6}table{border: 1px solid #dee2e6;border-collapse: collapse; margin : 10px;} </style>');
        myWindow.document.write('</head><body>');
        myWindow.document.write(data);
        myWindow.document.write('</body></html>');
        myWindow.document.close();

        myWindow.onload = function() {
            myWindow.focus();
            myWindow.print();
            myWindow.close();
        };
    }
</script>