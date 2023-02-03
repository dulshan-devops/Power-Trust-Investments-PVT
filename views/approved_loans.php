<div class="container-fluid">

    <!-- <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
        </div>
    </div> -->
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">Loan ID</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'db_connect.php';
                        $loan_list = $conn->query("SELECT  * from borrowers INNER JOIN  loan_list on borrowers.id=loan_list.borrower_id where loan_list.status = 2;");
                        $i = 1;
                        while ($row = $loan_list->fetch_assoc()) :
                        ?>
                            <tr>
                                <td>
                                    <center>
                                        <?php echo $row['ref_no'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $row['firstname'] . ' ' . $row['lastname'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <?php echo $row['contact_no'] ?>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary btn-sm" id="view_application" onclick="view_modal(<?php echo $row['ref_no'] ?>)" data-toggle="modal" data-target="#view_application_modal">View Only</button>
                                    </center>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="ref_no" name="ref_no" value="">


<!-- Modal -->
<div class="modal fade" id="view_application_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Loan Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row" style="border:solid 2px black; height : 3rem;">
                        <div class="col-sm " style="border-right:solid 2px black;">
                            <p id="loan_id"> </p>
                        </div>
                        <div class="col-sm" style="border-right:solid 2px black;">
                            <center>
                                <h4 id="name"></h4>
                            </center>
                        </div>
                        <div class="col-sm" id="name">

                        </div>
                    </div>

                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black; height : 3rem;">
                        <div class="col-sm " style="border-right:solid 2px black;">
                            <p><b id="ref_id">REFERENCE NO : </b></p>
                        </div>
                        <div class="col-sm" style="border-right:solid 2px black;">
                            <center>
                                <P><b id="loan_amount">AMOUNT : Rs.0</b></P>
                            </center>
                        </div>
                        <div class="col-sm">
                            Date : <b id="date_created"></b>
                        </div>
                    </div>

                    <div class="row mt-2" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black; height : 3rem;">
                        <div class="col">

                        </div>
                        <div class="col-8">
                            <h4><b>COVER STANDARD OPERATING PROCEDURE</b></h4>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <!-- applicant details -->
                    <div class="row mt-2" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>1). Applicant Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b id="">FULL NAME : <p id="full_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC : <p id="nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO : <p id="mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>EMAIL : <p id="email" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>ADDRESS : <p id="address" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>LOAN PURPOSE : <p id="purpose" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- loan type details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>2). Loan Plan Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>LOAN TYPE : <p id="type" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NO OF MONTHS : <p id="months" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>INTEREST (%) : <p id="interest_per" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>PENALTY RATE : <p id="rate" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- main gurantor details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>3). Main Gurantor Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME :<p id="mg_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC :<p id="mg_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>ADDRESS :<p id="mg_address" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO :<p id="mg_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- gurantor 1 details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>4).Gurantor 01 Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME :<p id="g1_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC :<p id="g1_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO :<p id="g1_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- gurantor 2 details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>5).Gurantor 02 Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME :<p id="g2_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC :<p id="g2_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO :<p id="g2_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- gurantor 3 details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>6).Gurantor 03 Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME :<p id="g3_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC :<p id="g3_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO :<p id="g3_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- gurantor 4 details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>7).Gurantor 04 Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME : <p id="g4_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC : <p id="g4_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO : <p id="g4_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- gurantor 5 details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>8).Gurantor 05 Details :</b></h5>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NAME : <p id="g5_name" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>NIC : <p id="g5_nic" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>CONTACT NO : <p id="g5_mobile" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- office details -->
                    <div class="row mt-1" style="border-top:solid 2px black; border-left:solid 2px black; border-right:solid 2px black;">
                        <h5 style="margin-left: 5px;"><b>9).Office Details : <p id="g5_mobile" style="margin-left: 15px;"></p></b></h5>
                    </div>
                    <!-- <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>BRANCH :</b></p>
                    </div> -->
                    <div class="row" style="border-left:solid 2px black; border-right:solid 2px black;">
                        <p style="margin-left: 30px;"><b>OFFICER IN CHARGE : <p id="officer" style="margin-left: 15px;"></p></b></p>
                    </div>
                    <!-- <div class="row" style="border-left:solid 2px black; border-right:solid 2px black; border-bottom:solid 2px black;">
                        <p style="margin-left: 30px;"><b>SIGNATURE :</b></p>
                    </div> -->
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-success" onclick="approve_loan()">Approve</button> -->
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.edit_user').click(function() {
        uni_modal('Edit User', 'ajax.php?action=manage_user&id=' + $(this).attr('data-id'))
    })
    $('.delete_user').click(function() {
        _conf("Are you sure to delete this user?", "delete_user", [$(this).attr('data-id')])
    })

    function approve_loan() {
        var ref_no = document.getElementById("ref_no").value;
        start_load()
        $.ajax({
            url: 'ajax.php?action=approve_application',
            method: 'POST',
            data: {
                id: ref_no
            },
            success: function(resp) {
                end_load();

                if (resp == 1) {
                    alert_toast("Loan Approved Successfully", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })

        console.log(ref_no)
    }

    function view_modal($application_id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=load_application',
            method: 'POST',
            data: {
                id: $application_id
            },
            success: function(resp) {
                end_load();

                //setup application
                resp = JSON.parse(resp);

                // document.getElementById("loan_id").innerHTML = "LOAN ID : " + resp.loan_id;
                document.getElementById("ref_id").innerHTML = "REFERENCE NO : " + $application_id;
                document.getElementById("name").innerHTML = resp.user.firstname + " " + resp.user.lastname;

                document.getElementById("full_name").innerHTML = resp.user.firstname + " " + resp.user.middlename + " " + resp.user.lastname;
                document.getElementById("nic").innerHTML = resp.user.nic;
                document.getElementById("email").innerHTML = resp.user.email;
                document.getElementById("mobile").innerHTML = resp.user.contact_no;
                document.getElementById("address").innerHTML = resp.user.address;
                document.getElementById("date_created").innerHTML = resp.date;
                document.getElementById("purpose").innerHTML = resp.loan_purpose;
                document.getElementById("loan_amount").innerHTML = "AMOUNT : Rs." + resp.loan_amount;

                document.getElementById("type").innerHTML = resp.loan_type.type_name;
                document.getElementById("months").innerHTML = resp.loan_plan.months;
                document.getElementById("interest_per").innerHTML = resp.loan_plan.interest_percentage;
                document.getElementById("rate").innerHTML = resp.loan_plan.penalty_rate;

                document.getElementById("ref_no").value = $application_id;

                document.getElementById("mg_name").innerHTML = resp.gurantors.mg_name;
                document.getElementById("mg_nic").innerHTML = resp.gurantors.mg_nic;
                document.getElementById("mg_address").innerHTML = resp.gurantors.mg_address;
                document.getElementById("mg_mobile").innerHTML = resp.gurantors.mg_mobile;

                document.getElementById("g1_name").innerHTML = resp.gurantors.g1_name;
                document.getElementById("g1_nic").innerHTML = resp.gurantors.g1_nic;
                document.getElementById("g1_mobile").innerHTML = resp.gurantors.g1_mobile;

                document.getElementById("g1_name").innerHTML = resp.gurantors.g1_name;
                document.getElementById("g1_nic").innerHTML = resp.gurantors.g1_nic;
                document.getElementById("g1_mobile").innerHTML = resp.gurantors.g1_mobile;

                document.getElementById("g2_name").innerHTML = resp.gurantors.g2_name;
                document.getElementById("g2_nic").innerHTML = resp.gurantors.g2_nic;
                document.getElementById("g2_mobile").innerHTML = resp.gurantors.g2_mobile;

                document.getElementById("g3_name").innerHTML = resp.gurantors.g3_name;
                document.getElementById("g3_nic").innerHTML = resp.gurantors.g3_nic;
                document.getElementById("g3_mobile").innerHTML = resp.gurantors.g3_mobile;

                document.getElementById("g4_name").innerHTML = resp.gurantors.g4_name;
                document.getElementById("g4_nic").innerHTML = resp.gurantors.g4_nic;
                document.getElementById("g4_mobile").innerHTML = resp.gurantors.g4_mobile;

                document.getElementById("g5_name").innerHTML = resp.gurantors.g5_name;
                document.getElementById("g5_nic").innerHTML = resp.gurantors.g5_nic;
                document.getElementById("g5_mobile").innerHTML = resp.gurantors.g5_mobile;

                document.getElementById("officer").innerHTML = resp.officer.name;
            }
        })
    }

    function delete_user($id) {
        start_load()
        $.ajax({
            url: 'ajax.php?action=delete_user',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }
            }
        })
    }
</script>