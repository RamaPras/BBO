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
				<div class="container-fluid">
					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
            			<h1 class="h3 mb-0 text-gray-800"> User Role</h1>
            			<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
					</div>

						<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="#formuserRole" data-toggle="modal" class="btn btn-green" onclick="submit('a', 'd', 'd')"><i class="fas fa-plus"></i> Add New</a>
							<!--<a href="#" class="btn btn-orange" onclick="ResetTable()"><i class="fas fa-refresh"></i>Refresh</a>-->
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myUserRole" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
									<thead class="btn-green">
										<tr>
                                            <th  style="text-align:center">No</th>
											<th style="text-align:center" >NPP</th>
                                            <th style="text-align:center" >Nama</th>
											<th style="text-align:center" >Role</th>
											<th style="text-align:center" >Unit</th>
											<th style="text-align:center" >Update</th> 
					          				<th style="text-align:center" >Expire</th>
                    						<th style="text-align:center">Action</th>
											</tr> 
									</thead>
									<tbody id="show_data" class="table-secondary text-dark">
									</tbody>
								</table>							
							</div><!--Table-Response-->
							<!--Modal ADD dan Edit-->
							<div class="modal fade" id="formuserRole" tabindex="-1" role="dialog">
       							<div class="modal-dialog modal-xl">
            						<div class="modal-content">
                						<div class="modal-header">
                    						<h4 class="modal-title" id="HeaderForm">ADD Data</h4>
                    						<button type="button" class="close" data-dismiss="modal">×</button>
                						</div>
                						<div class="modal-body form" >
											<div class="form-group row" id="form_id">
                            					<label class="col-md-2 col-form-label">User ID</label>
                            					<div class="col-md-10">
                              						<input type="text" name="id" id="id" class="form-control" placeholder="User ID" disabled>
													  <input type="hidden" name="role_upd" id="role_upd" class="form-control" disabled>
													  <input type="hidden" name="unit_upd" id="unit_upd" class="form-control" disabled>
												</div>
                        					</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama</label>
                            					<div class="col-md-10">
												<select id="user" class="pc form-control">
														<option>Pilih Nama User</option>
                                					</select>
                                                </div>
                        					</div>
                        					<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Role</label>
                            					<div class="col-md-10">
													<select id="role" class="pc form-control">
														<option>Pilih Role</option>
                                					</select>
                            					</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Unit</label>
                            					<div class="col-md-10" >
												<input type="text" name="unit" id="unit" class="form-control" placeholder="Unit">
							        			</div>
                        					</div>
											<div class="form-group row" id="tgl_exp">
                            					<label class="col-md-2 col-form-label">Masa Aktif</label>
                            					<div class="col-md-10">
                            						<input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Masa Aktif Sampai">
                            					</div>
                        					</div> 
                  							<div class="modal-footer">
                    							<button type="button" type="submit" id="add" class="btn btn-primary" onclick="ValidateInsert();">ADD</button>
												<button type="button" type="submit" id="edit" class="btn btn-primary" onclick="ValidateUpdate();">EDIT</button>
												<button type="button" class="btn btn-secondary" data-dismiss="modal">BACK</button>
											</div>
            							</div><!--Modal Body-->
        							</div><!--Modal Content-->
    							</div><!--Modal Dialog-->
							</div><!--Modal Fade-->      
						</div><!--Card Body-->
					</div><!--Card MB3-->
				</div><!-- /.container-fluid -->
      			<!-- Footer -->
      			<?php $this->load->view('admin/partials/footer'); ?>
      			<!-- End of Footer -->
    		</div><!-- End of Content -->
  		</div><!-- End of Page Wrapper -->
	</div><!--Wrapper-->
  <!-- Scroll to Top Button-->
  <?php $this->load->view('admin/partials/scrolltop');?>

  <!-- Logout Modal-->
  <?php $this->load->view('admin/partials/modal');?>
  <!-- Bootstrap core JavaScript-->
  <?php $this->load->view('admin/partials/js');?>
  <?php $this->load->view('script/User_Role_Script');?>

</body>

</html>
