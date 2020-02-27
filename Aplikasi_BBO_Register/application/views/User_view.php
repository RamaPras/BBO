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
            			<h1 class="h3 mb-0 text-gray-800"> USER </h1>
            			<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
					</div>

						<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="#formuser" data-toggle="modal" class="btn btn-green" onclick="submit('add')"><i class="fas fa-plus"></i> Add New</a>
							<!--<a href="#" class="btn btn-orange" onclick="ResetTable()"><i class="fas fa-refresh"></i>Refresh</a>-->
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myUser" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
									<thead class="btn-green">
										<tr>
											<th style="text-align:center" width="5%">NPP</th>
											<th style="text-align:center" width="15%">Nama</th>
											<th style="text-align:center" width="15%">Email</th>
                    						<th style="text-align:center" width="5%">Kategori</th>
											<th style="text-align:center" width="5%">Sentra Code</th>
											<th style="text-align:center" width="5%">Handling Code</th>
											<th style="text-align:center" width="5%">Status</th>
											<th style="text-align:center" width="10%">Update</th>
					          				<th style="text-align:center" width="10%">Expire</th>
                    						<th style="text-align:center" width="5%">Action</th>
											</tr> 
									</thead>
									<tbody id="show_data" class="table-secondary text-dark">
									</tbody>
								</table>							
							</div><!--Table-Response-->
							<!--Modal ADD dan Edit-->
							<div class="modal fade" id="formuser" tabindex="-1" role="dialog">
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
                                                </div>
                        					</div>
											<div class="form-group row" id="form_npp">
                            					<label class="col-md-2 col-form-label">NPP</label>
                            					<div class="col-md-10">
                                                    <input type="text" name="npp" id="npp" class="form-control" placeholder="NPP">
                                                </div>
                        					</div>
                        					<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama</label>
                            					<div class="col-md-10" >
												<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama">
							        			</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Email</label>
                            					<div class="col-md-10" >
												<input type="text" name="email" id="email" class="form-control" placeholder="Email">
							        			</div>
                        					</div>
                                            <div class="form-group row">
                            					<label class="col-md-2 col-form-label">Kategori</label>
                            					<div class="col-md-10">
													<select id="kategori" class="pc form-control">
														<option>Pilih Kategori</option>
                                					</select> 
                            					</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Sentra Code</label>
                            					<div class="col-md-10" >
												<input type="text" name="sc" id="sc" class="form-control" placeholder="Sentra Code">
							        			</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Handling Code</label>
                            					<div class="col-md-10" >
												<input type="text" name="hc" id="hc" class="form-control" placeholder="Handling code">
							        			</div>
											</div>
											<!-- <div class="form-group row">
                            					<label class="col-md-2 col-form-label">Hak Admin</label>
                            					<div class="col-md-10">
													<select id="HakAdm" class="pc form-control">
														<option value="" disabled selected>Pilih Hak Admin</option>
														<option>YA</option>
														<option>TIDAK</option>
                                					</select>
                            					</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Hak Update</label>
                            					<div class="col-md-10">
													<select id="HakUpd" class="pc form-control">
														<option value="" disabled selected>Pilih Hak Update</option>
														<option>YA</option>
														<option>TIDAK</option>
                                					</select>
                            					</div>
											</div> -->
                        					<div class="form-group row" id=form_status >
                            					<label class="col-md-2 col-form-label">Status</label>
                            					<div class="col-md-10">
                                                <select id="status" class="pc form-control">
														<option value="" disabled selected>Pilih Status</option>
														<option>Aktif</option>
														<option>Nonaktif</option>
                                					</select>
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
  <?php $this->load->view('script/User_Script');?>

</body>

</html>
