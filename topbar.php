<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
  				<!-- <span class="fa fa-money-bill-wave"></span> -->
          <img src="https://media.istockphoto.com/id/1265397540/vector/business-profit-chart-icon.jpg?s=612x612&w=0&k=20&c=XLoVmfcZOEfJg35S96ItOOUwntpc3swGOV_HwVaLEvI=" alt="" style="height: 27px; width : 27px;">
  			</div>
  		</div>
      <div class="col-md-4 float-left text-white">
        <large><b>Loan Management System</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white">
	  		<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>