<?php include 'db_connect.php' ?>
<?php
date_default_timezone_set("Asia/Colombo");

$id = $_GET['payId'];

$loan = $conn->query("SELECT p.*,l.ref_no,concat(b.lastname,', ',b.firstname)as name, b.contact_no, b.address from payments p inner join loan_list l on l.id = p.loan_id inner join borrowers b on b.id = l.borrower_id  order by p.id asc");
$loan_data = $loan->fetch_array(MYSQLI_ASSOC);

$total_paid = $conn->query("SELECT SUM(amount) AS total_paid FROM payments WHERE loan_id = " . $loan_data['loan_id'] . ";");
$total_paid = $total_paid->fetch_array(MYSQLI_ASSOC);

//loan application data
$loan_list_data = $conn->query("SELECT * FROM loan_list where ref_no = '" . $loan_data['ref_no'] . "';");
$row = $loan_list_data->fetch_array(MYSQLI_ASSOC);

//loan plan details
$type_id = $row['loan_type_id'];
$loan_type_data = $conn->query("SELECT * FROM loan_types where id = '" . $type_id . "';");
$loan_type = $loan_type_data->fetch_array(MYSQLI_ASSOC);

// echo json_encode();
$loan_plan_data = $conn->query("SELECT * FROM loan_plan where id = '" . $row['plan_id'] . "';");
$loan_plan = $loan_plan_data->fetch_array(MYSQLI_ASSOC);

$monthly = ($row['amount'] + ($row['amount'] * ($loan_plan['interest_percentage'] / 100))) / $loan_plan['months'];
$total_payble = $monthly * $loan_plan['months'];

//group
$borrower_id = $row['group_id'];

$groups_data = $conn->query("SELECT * FROM groups where id = '" . $borrower_id . "';");
$groups_data = $groups_data->fetch_array(MYSQLI_ASSOC);

//village
$villages_data = $conn->query("SELECT * FROM villages where id = '" . $groups_data['village_id'] . "';");
$villages_data = $villages_data->fetch_array(MYSQLI_ASSOC);

//Name



?>
<section id="print" class="center" style="background-color : white; margin-top : 10px;height:55rem;width:45rem">
    <style>
        /* body {
            font-size: 10px;
            font-family: Calibri;
        } */

        table {
            font-size: 25px;
            font-family: Calibri;
        }

        #print {
            width: 400px;
            border: 1px solid gray;
            padding: 10px;
        }

        .center {
            display: block;
            text-align: center;
            margin: auto;
        }

        .mt-1 {
            margin-top: 20px;
        }

        .d-flex {
            display: flex;
        }

        .sign {
            border-top: 1px dashed gray;
            width: 200px;
        }
    </style>

    <header>
        <h3 class="center">POWER TRUST INVESTMENTS (PVT) LTD</h3>
        <p style="width:100%">--------------------------------------------------------------------------------------------------------------------</p>
        <p class="center"><span>Date: <?php echo date("Y-m-d h:i:sa") ?></span></p>
        <p style="width:100%">--------------------------------------------------------------------------------------------------------------------</p>

        <!-- <p class="center">Micro Finance Company</p>
        <p class="center"><span>Contact Us: 0273 279 422</span> <br> <span>Email: mloancompany@gmail.com</span></p>
        <p style="border:solid 1px gray"></p> -->
    </header>
    <br>
    <table style="width:100%; margin-left : 60px;">

    <tr>
            <td align="left">Branch</td>
            <td align="left"> Balangoda (BG)</td>
        </tr>
        <tr>
            <td align="left">Mem Name</td>
            <td align="left"> <?php echo $loan_data['name'] ?></td>
        </tr>
        <tr>
            <td align="left">Mem Number</td>
            <td align="left"> <?php echo $loan_data['payee'] ?></td>
        </tr>
        <tr>
            <td align="left">Acc No</td>
            <td align="left"><?php echo $loan_data['ref_no'] ?></td>
        </tr>
        <!-- <tr>
            <td align="left">Village</td>
            <td align="left"><?php echo $villages_data['village'] ?></td>
        </tr>
        <tr>
            <td align="left">Group</td>
            <td align="left"><?php echo $groups_data['group'] ?></td>
        </tr> -->
    </table>
    <tr>
        <h5 class="center mt-3">Payment Details</h5>
        <p style="width:100%">-----------------------------------------------------------------------------------------------</p>
    </tr>
    <table style="width:100%; margin-left : 40px">
        <!-- <tr>
            <td align="left">Amount</td>
            <td align="right"> <?php echo number_format($loan_data['amount'], 2) ?></td>
        </tr> -->

        <tr>
            <td align="left">Loan Amt</td>
            <!-- check this outsanding -->
            <td align="left"><?php echo number_format($row['amount'], 2) ?></td>
        </tr>
        <tr>
            <td align="left">Total Payble (Capital+Int)</td>
            <!-- check this outsanding -->
            <td align="left"><?php echo number_format($total_payble, 2) ?></td>
        </tr>
        <tr>
            <td align="left">Total Paid</td>
            <td align="left"><?php echo number_format($total_paid['total_paid'], 2) ?></td>
        </tr>
        <tr>
            <td align="left">Rent Amount</td>
            <td align="left"><?php echo number_format($monthly, 2) ?></td>
        </tr>
        <!-- <tr>
            <td align="left">Date</td>
            <td align="left"><?php echo date("Y-m-d h:i:sa") ?></td>
        </tr> -->
    </table>
    <tr style="margin: 10px;">
        <p style="width:100%">-----------------------------------------------------------------------------------------------</p>
        <h5 class="center m-2">Paid Amt : Rs. <?php echo number_format($loan_data['amount'], 2) ?></h5>
        <!-- <p style="width:100%">-----------------------------------------------------------------------------------------------</p> -->
    </tr>

    <br>
    <p class="center mt-1 sign">Officer Signature</p>
</section>
<button id="toprint" class="center mt-1">Click to Print</button>
<script>
    document.querySelector("#toprint").addEventListener('click', function() {
        var template = document.querySelector("#print").innerHTML;
        Popup(template);
    });

    function Popup(data) {
        var myWindow = window.open('', 'Receipt', 'height=400,width=600');
        myWindow.document.write('<html><head><title>Receipt</title>');
        myWindow.document.write('<style type="text/css"> *, html {margin:0;padding:0;} </style>');
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