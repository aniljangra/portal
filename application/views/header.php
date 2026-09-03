<header id="header">
  <div class="header-top header-top-borders">
    <div class="container h-100">
      <div class="header-row h-100">
        <div class="header-column justify-content-start">
          <div class="header-row">
            <nav class="header-nav-top">
              <ul class="nav nav-pills">
                <li class="nav-item nav-item-borders py-2 d-none d-lg-inline-flex"> <a href="tel:123-456-7890">Call us on <span><i class="fas fa-phone text-4" style="top: 0;"></i> 0172-2556328</span></a> </li>
                <li class="nav-item nav-item-borders py-2 d-none d-sm-inline-flex"> <a href="mailto: jaimansadevimaa@gmail.com">Mail us at <span><i class="far fa-envelope text-4" style="top: 1px;"></i> jaimansadevimaa@gmail.com</span></a> </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="header-column justify-content-end">
          <div class="header-row">
            <nav class="header-nav-top">
              <ul class="nav nav-pills">
                <?php 
		   	if(isset($this->session->userdata['custsesid'])){ 
	   		$custsesid=$this->session->userdata['custsesid'];
	   		$custweldata=$this->customcode->getUserAccount($custsesid); 
				$top_name=$custweldata->reg_firstname;
				if($custweldata->reg_lastname!=""){
					$top_name." ".$custweldata->reg_lastname;
				}

			?>
                <li class="nav-item nav-item-anim-icon d-none d-md-block welcome-info"> <a class="nav-link pl-0" href=""><i class="fas fa-angle-right"></i> Welcome, <span><?php echo $top_name; ?></span></a> </li>
                <li class="nav-item dropdown nav-item-left-border d-none d-sm-block"> <a class="nav-link pl-0" href="<?php echo site_url("logout"); ?>"> Logout</a> </li>
                <?php } ?>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-bottom">
    <div class="header-container container">
      <div class="header-row py-1">
        <div class="header-column">
          <div class="header-row">
            <div class="header-logo"> <a href="<?php echo site_url(); ?>" title="Mata Mansa Devi Shrine Board"> <img alt=""  src="<?php echo base_url();  ?>assets/img/logo.png" align="Mata Mansa Devi Shrine Board"> </a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="header-nav-bar mb-3 px-3 px-lg-0">
    <div class="container">
      <div class="header-row">
        <div class="header-column">
          <div class="header-row justify-content-end">
            <div class="header-nav header-nav-links justify-content-start" data-sticky-header-style-deactive="{'margin-left': '0'}">
              <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-dropdown-arrow header-nav-main-effect-3 header-nav-main-sub-effect-1">
                <nav class="collapse">
                  <ul class="nav nav-pills" id="mainNav">
                 <li> <a class="dropdown-item" href="<?php echo site_url(); ?>" title="Home"> Home </a> </li>   
                    

             <!-- <li class="dropdown"> <a class="dropdown-item" href="<?php //echo site_url("hawan-booking"); ?>" title="Hawan Booking"> Hawan Booking </a> </li>-->

              <li class="dropdown"> <a class="dropdown-item" href="<?php echo site_url("room-booking"); ?>" title="Room Bookings"> Room Bookings </a> </li>
                    
                    <?php 

	   		

			if(isset($this->session->userdata['custsesid'])){ ?>
            		
            <li> <a class="dropdown-item" href="<?php echo site_url("online-donation"); ?>" title="Online Donation"> Donation </a> </li>
            <li> <a class="dropdown-item" href="<?php echo site_url("online-chola-booking"); ?>" title="Chola Booking"> Chola Booking </a> </li>
            
            
            
            
            
                    <li class="dropdown"> <a class="dropdown-item" href="javascript:void(0)"><i class="far fa-user"></i>&nbsp;&nbsp;  My Account </a>
                      <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="<?php echo site_url('my-profile'); ?>" title="User Profile">User Profile</a></li>
           <li><a class="dropdown-item" href="<?php echo site_url('transactions/donation'); ?>" title="Donation Transactions">Donation Transactions</a></li>
          <li><a class="dropdown-item" href="<?php echo site_url('transactions/chola-booking'); ?>" title="Chola Booking Transactions">Chola Booking Transactions</a></li>
          
          <li><a class="dropdown-item" href="<?php echo site_url('transactions/room-booking'); ?>" title="Room Booking Transactions">Room Booking Transactions</a></li>
          <!--
             <li><a class="dropdown-item" href="<?php //echo site_url('transactions/hawan-booking'); ?>" title="Hawan Booking Transactions">Hawan Booking Transactions</a></li>-->
               <li><a class="dropdown-item" href="<?php echo site_url('change-password'); ?>" title="Change Password">Change Password</a></li>
                      </ul>
                    </li>
                    <li class="dropdown"> <a class="dropdown-item" href="<?php echo site_url("logout"); ?>" title="Online Mundan"> Logout</a> </li>
                    <?php  }else{ ?>
                    <!--<li class="dropdown"> <a class="dropdown-item" href="<?php echo site_url("create-account"); ?>" title="Devotee Registration "> Devotee Registration </a> </li>
                    <li class="dropdown"> <a class="dropdown-item" href="<?php echo site_url("login"); ?>" title="Login"> Login </a> </li>-->
                    <?php }

			

			   ?>
                  </ul>
                </nav>
              </div>
              <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav"> <i class="fas fa-bars"></i> </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
