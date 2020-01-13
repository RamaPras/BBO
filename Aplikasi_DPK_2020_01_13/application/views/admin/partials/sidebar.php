<!-- Sidebar -->
<ul class="navbar-nav bg-green sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url(); ?>Login/Home">
    <i> <img class="img-profile rounded-circle" src="<?php echo base_url('assets/BNI3.jpg') ?>" width="50 px"></i>
  <div class="sidebar-brand-text mx-3">Aplikasi DPK </div>
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
<!--ACCESS MENUS FOR ADMIN-->
<?php if($this->session->userdata('category')=='ADM'):?>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item"<?php echo $this->uri->segment(2) == 'Utilities' ? 'active': '' ?>>
  <a class="nav-link" href="<?php echo base_url(); ?>Cid">
    <span>Grup</span>
  </a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item" <?php echo $this->uri->segment(2) == 'Components' ? 'active': '' ?>>
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <span>Mapping</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url(); ?>Rm">Mapping NPP Grup</a>
      <a class="collapse-item" href="<?php echo base_url(); ?>Cif">Mapping CIF Grup</a>
      <a class="collapse-item" href="<?php echo base_url(); ?>Unit">Mapping NPP Unit</a>    
      <a class="collapse-item" href="<?php echo base_url(); ?>Avp">Mapping NPP AVP</a>
    </div>
  </div>
</li>

<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item"<?php echo $this->uri->segment(2) == 'Utilities' ? 'active': '' ?>>
  <a class="nav-link" href="<?php echo base_url(); ?>User">
    <span>User</span>
  </a>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

<!--ACCESS MENUS FOR USER-->
<?php else:?>
<!-- Nav Item - Utilities Collapse Menu -->
<li class="nav-item"<?php echo $this->uri->segment(2) == 'Utilities' ? 'active': '' ?>>
  <a class="nav-link" href="<?php echo base_url(); ?>Cid">
    <span>Grup</span>
  </a>
</li>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item" <?php echo $this->uri->segment(2) == 'Components' ? 'active': '' ?>>
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <span>Mapping</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url(); ?>Rm">Mapping NPP Grup</a>
      <a class="collapse-item" href="<?php echo base_url(); ?>Cif">Mapping CIF Grup</a>
      <a class="collapse-item" href="<?php echo base_url(); ?>Unit">Mapping NPP Unit</a>
      <a class="collapse-item" href="<?php echo base_url(); ?>Avp">Mapping NPP AVP</a>
    </div>
  </div>
</li>

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
<?php endif;?>
</ul>
<!-- End of Sidebar -->