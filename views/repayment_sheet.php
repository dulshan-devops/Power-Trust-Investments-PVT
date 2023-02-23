<?php include 'db_connect.php' ?>
<?php
extract($_POST);
// $village = $conn->query("SELECT * FROM villages where id = '" . $village_id . "' ");
// $village = $village->fetch_array(MYSQLI_ASSOC);

//groups tbl data
// $groups_data = $conn->query("SELECT * FROM groups where village_id = '" . $village_id . "' order by `group` ASC;");
?>




<div class="card col-lg-12" id="print">

    <div style="text-align: center; vertical-align:middle;">
        <img src="assets/img/log-logo.jpeg" alt="" style="width:150px; height : 150px; margin:auto;">

    </div>
    <h4 style="text-align: center; vertical-align:middle;"><b>POWER TRUST INVESTMENTS (PVT) LTD</b></h4>
    <h5 style="text-align: center; vertical-align:middle;margin-top : 5px;margin-bottom : 5px;"><b>Micro Finance Repayment Sheet ................................. Balangoda </b></h5>

    <div class="card-body">
        <hr>
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">MEM NO</th>
                    <th scope="col">MEM NAME</th>
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
                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Page Collection</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Page Due</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Cumulative Collection</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Cumulative Due</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Excess</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Total</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Active Member</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">No Of Under Payment</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Amount</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">No Of Not Paid</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Amount</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">No Of Settlement</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <div>
                            <p><b id="">Full Signature (Center Manager)</b></p>
                            <p><b id="">Cashier</b></p>
                            <p><b id="">Head Of Division</b></p>
                            <p><b id="">Branch Manager</b></p>
                        </div>
                    </td>
                    <td>
                        <p><b id=""></b></p>

                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>
                        <p><b id=""></b></p>
                    </td>
                    <td>

                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

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