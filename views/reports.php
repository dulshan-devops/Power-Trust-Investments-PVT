<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <form class="form-inline" id="" method="POST">
                <div class="form-group mx-sm-3 mb-2">
                    <div class="form-group" style="margin-right: 5px;" id="filter_village">

                    </div>

                    <input class="form-control form-control-sm" type="text" placeholder="Enter a village or group ID" style="margin-right: 5px; width : 15rem;" name="village_group" id="village_group">

                    <div class="form-group" style="margin-right: 5px;">
                        <label for="exampleFormControlSelect1" class="form-control-sm">Filter By</label>
                        <select class="form-control form-control-sm" id="filter_by" onchange="setup_filter(this.value)">
                            <option value="1">Village</option>
                            <option value="2">Group ID</option>
                        </select>
                    </div>


                    <button type="button" class="btn btn-success float-right btn-sm" id="filter_data"><i class="fa fa-search" style="margin-right: 5px;"></i> Search</button>
                </div>

            </form>

        </div>
    </div>
    <div class="row mt-2">
        <div class="card col-lg-12">
            <div class="card-body" id="table_container">

            </div>
        </div>
    </div>
</div>

 <input type="hidden" id="ref_no" name="ref_no" value="">

<!-- personal view modal -->
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

                document.getElementById("full_name").innerHTML = resp.user.firstname + " " + resp.user.lastname;
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

    function setup_loan_id_to_history($id) {
        document.getElementById("loan_id").value = $id;

        var id = document.getElementById("loan_id").value;
        uni_modal("Loan History", "view_history.php?id=" + $id, 'mid-large')
    }

    //load filtered data to table
    $('#filter_data').click(function() {
        var filter_by = document.getElementById("filter_by").value;
        var village , group;

        if (filter_by == 1) {
            village = document.getElementById("village_group").value;
            setup_table(1, village , "");
        } else if (filter_by == 2) {
            village = document.getElementById("child_select").value;
            group = document.getElementById("village_group").value;
            setup_table(2, village , group);
        }

    })

    window.addEventListener("load", (event) => {

        //load full data to table
        setup_table(0, "" , "");
    });

    function setup_table(event, village , group) {
        start_load()
        $.ajax({
            url: 'reports_table.php',
            method: "POST",
            data: {
                event: event,
                village: village,
                group : group,
            },
            success: function(resp) {
                $('#table_container').html(resp)
                end_load()
            }
        })
    }

    function setup_filter(value) {
        if (value == 1) {
            //hide villages list
            start_load();
            var parent = document.getElementById("filter_village");
            var child = document.getElementById("child_select");

            if (child) {
                parent.removeChild(child);
            }
            end_load();

            //change input field placeholder
        } else if (value == 2) {
            //show villages list
            start_load();
            $.ajax({
                url: 'reports_village_filter.php',
                method: "POST",
                data: {

                },
                success: function(resp) {
                    $('#filter_village').html(resp);
                    end_load()
                }
            })


            //change input field placeholder
        }
    }
</script>