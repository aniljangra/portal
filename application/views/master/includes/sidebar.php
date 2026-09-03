	<?php
    $sidemuserid=$this->session->userdata('masterId');
	$sidemuser=$this->customcode->getAdminProfile($sidemuserid);
	
	?>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url("master/dashboard"); ?>">
  <div class="sidebar-brand-icon rotate-n-15"> <i class="fas fa-laugh-wink"></i> </div>
  <div class="sidebar-brand-text mx-3">Welcome <sup> Admin</sup></div>
  </a>
  <hr class="sidebar-divider my-0">
  
  <li class="nav-item active"> <a class="nav-link" href="<?php echo site_url("master/dashboard"); ?>"> <i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
  <hr class="sidebar-divider">
  
  <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <i class="fas fa-fw fa-cog"></i> <span>Admin</span> </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded"> 
     <!-- <h6 class="collapse-header">Custom Components:</h6> --> <a class="collapse-item" href="<?php echo site_url("master/profile"); ?>">Admin Profile</a> <a class="collapse-item" href="<?php echo site_url("master/logout"); ?>">Logout</a> </div>
    </div>
  </li>
  <?php if($sidemuser->ad_temple==1){ ?>
  <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDateManage" aria-expanded="true" aria-controls="collapseDateManage"> <i class="fas fa-calendar-alt"></i> <span>Date Management </span> </a>
    <div id="collapseDateManage" class="collapse" aria-labelledby="headingPages" data-parent="#collapseDateManage">
      <div class="bg-white py-2 collapse-inner rounded"> <a class="collapse-item" href="<?php echo site_url("master/date-setting/manage");  ?>">View All</a>  <a class="collapse-item" href="<?php echo site_url("master/date-setting/add-new");  ?>">Add New</a>
      </div>
    </div>
  </li>
  
  
  
  
  
  <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDevotee" aria-expanded="true" aria-controls="collapseDevotee"> <i class="far fa-user"></i> <span>Devotee</span> </a>
    <div id="collapseDevotee" class="collapse" aria-labelledby="headingPages" data-parent="#collapseDevotee">
      <div class="bg-white py-2 collapse-inner rounded"> <a class="collapse-item" href="<?php echo site_url("master/user/manage");  ?>">View All</a> </div>
    </div>
  </li>
  
  <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDonation" aria-expanded="true" aria-controls="collapseDonation"> <i class="fas fa-calendar-alt"></i> <span>Donations</span> </a>
    <div id="collapseDonation" class="collapse" aria-labelledby="headingPages" data-parent="#collapseDonation">
      <div class="bg-white py-2 collapse-inner rounded"> 
      <a class="collapse-item" href="<?php echo site_url("master/donation/manage");  ?>">Manage Donations</a>
       </div>
    </div>
  </li>

  
   <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoomBooking" aria-expanded="true" aria-controls="collapseRoomBooking"> <i class="fas fa-hotel"></i> <span>Room Booking </span> </a>
    <div id="collapseRoomBooking" class="collapse" aria-labelledby="headingPages" data-parent="#collapseRoomBooking">
      <div class="bg-white py-2 collapse-inner rounded"> <a class="collapse-item" href="<?php echo site_url("master/room-booking/manage");  ?>">View All </a>  </div>
    </div>
  </li>
   <?php } ?>
 <?php if($sidemuser->ad_temple!=""){ ?>
 
  <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCholaDateManage" aria-expanded="true" aria-controls="collapseCholaDateManage"> <i class="fas fa-calendar-alt"></i> <span>Chola Date Settings </span> </a>
    <div id="collapseCholaDateManage" class="collapse" aria-labelledby="headingPages" data-parent="#collapseCholaDateManage">
      <div class="bg-white py-2 collapse-inner rounded"> <a class="collapse-item" href="<?php echo site_url("master/chola-datemgmt/manage");  ?>">View All</a>  <a class="collapse-item" href="<?php echo site_url("master/chola-datemgmt/add");  ?>">Add New</a>
      </div>
    </div>
  </li>


    <li class="nav-item"> <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseChola" aria-expanded="true" aria-controls="collapseChola"> <i class="fas fa-calendar-alt"></i> <span>Chola Booking</span> </a>
    <div id="collapseChola" class="collapse" aria-labelledby="headingPages" data-parent="#collapseChola">
      <div class="bg-white py-2 collapse-inner rounded"> <a class="collapse-item" href="<?php echo site_url("master/chola-booking/manage");  ?>">View Chola Bookings</a>
      
      <a class="collapse-item" href="<?php echo site_url("master/chola-booking/search");  ?>">Search & Export</a>
      <a class="collapse-item" href="<?php echo site_url("master/chola-booking");  ?>">Book Chola</a>
      
       </div>
    </div>
	 </li>
     <?php } ?>
	 
  
  <hr class="sidebar-divider d-none d-md-block">
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
</ul>
