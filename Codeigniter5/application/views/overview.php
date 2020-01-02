<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('admin/partials/head');?>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php $this->load->view('admin/partials/sidebar');?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php $this->load->view('admin/partials/navbar');?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading 
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">MENU</h1>-->
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> 
          </div>-->
          <?php if($this->session->userdata('category')=='ADM'):?>
          <!-- Content Row -->
          <div class="form-group row">
            <h2 class="h3 mb-0 text-gray-600">Grup</h2>
          </div> 
          <div class="form-group row"> 
            <!-- Grup -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Cid">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Mapping -->
          <div class="form-group row">
            <h2 class="h3 mb-0 text-gray-600">Mapping</h2>
          </div> 
          <div class="form-group row"> 
            <!-- CID CIF -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Cif">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-info text-uppercase mb-1"> Cif Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- NPP Grup -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Rm">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-success text-uppercase mb-1">NPP Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- NPP Unit -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Unit">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-warning text-uppercase mb-1"> NPP Unit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- NPP AVP -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Avp">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-secondary text-uppercase mb-1"> NPP AVP</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- User -->
          <div class="form-group row">
            <h2 class="h3 mb-0 text-gray-600">User</h2>
          </div> 
          <div class="form-group row">  
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>User">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-danger text-uppercase mb-1"> User</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php else:?>
          <!-- Content Row -->
          <div class="form-group row">
            <h2 class="h3 mb-0 text-gray-600">Grup</h2>
          </div> 
          <div class="form-group row"> 
            <!-- Grup -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Cid">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-primary text-uppercase mb-1">Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Mapping -->
          <div class="form-group row">
            <h2 class="h3 mb-0 text-gray-600">Mapping</h2>
          </div> 
          <div class="form-group row"> 
            <!-- CID CIF -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Cif">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-info text-uppercase mb-1"> Cif Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- NPP Grup -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Rm">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-success text-uppercase mb-1">NPP Grup</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>

            <!-- NPP Unit -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Unit">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-warning text-uppercase mb-1"> NPP Unit</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- NPP AVP -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center"> 
                    <a class="nav-link" href="<?php echo base_url(); ?>Avp">
                    <div class="col mr-2">
                      <div class="text-xl font-weight-bold text-secondary text-uppercase mb-1"> NPP AVP</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                    </div>
                    <!-- <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div> -->
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php endif;?>


        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php $this->load->view('admin/partials/footer'); ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <?php $this->load->view('admin/partials/scrolltop');?>

  <!-- Logout Modal-->
  <?php $this->load->view('admin/partials/modal');?>
  <!-- Bootstrap core JavaScript-->
  <?php $this->load->view('admin/partials/js');?>
</body>

</html>
