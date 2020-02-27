<!-- Sidebar -->
<ul class="navbar-nav bg-green sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>Login/Home">
    <i> <img class="img-profile rounded-circle" src="<?php echo base_url('assets/BNI3.jpg') ?>" width="50 px"></i>
  <div class="sidebar-brand-text mx-3">Aplikasi</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo base_url(); ?>Login/Home">
    <!-- <i class="fas fa-fw fa-tachometer-alt"></i> -->
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
  MENU
</div>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item"<?php echo $this->uri->segment(2) == 'Utilities' ? 'active': '' ?>>
  <a class="nav-link" href="<?php echo base_url(); ?>User">
    <span>USER</span>
  </a>
</li>
<li class="nav-item"<?php echo $this->uri->segment(2) == 'Utilities' ? 'active': '' ?>>
  <a class="nav-link" href="<?php echo base_url(); ?>User_Role">
    <span>User Role</span>
  </a>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->