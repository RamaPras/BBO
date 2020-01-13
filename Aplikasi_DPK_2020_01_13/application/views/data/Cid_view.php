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
            			<h1 class="h3 mb-0 text-gray-800"> Grup </h1>
            			<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
					</div>

						<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="#formcid" data-toggle="modal" class="btn btn-green" onclick="submit('add',null)"><i class="fas fa-plus"></i> Add New</a>
							<!--<a href="#" class="btn btn-orange" onclick="ResetTable()"><i class="fas fa-refresh"></i>Refresh</a>-->
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myCid" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
									<thead class="btn-green">
										<tr>
											<th  style="text-align:center">No</th>
											<th style="text-align:center">Kode Grup</th>
											<th style="text-align:center">Nama Inisial</th>
                    						<th style="text-align:center">Kementerian</th>
                    						<th style="text-align:center">Nama Grup</th>
					          				<th style="text-align:center">Segmen</th>
											<th style="text-align:center" width="10%">Tanggal Mulai</th>
                                            <th style="text-align:center" width="10%">Tanggal Akhir</th>
                    						<th style="text-align:center">Action</th>
											</tr> 
									</thead>
									<tbody id="show_data" class="table-secondary text-dark">
									</tbody>
								</table>							
							</div><!--Table-Response-->
							<!--Modal ADD dan Edit-->
							<div class="modal fade" id="formcid" tabindex="-1" role="dialog">
       							<div class="modal-dialog modal-xl">
            						<div class="modal-content">
                						<div class="modal-header">
                    						<h4 class="modal-title" id="HeaderForm">ADD Data</h4>
                    						<button type="button" class="close" data-dismiss="modal">×</button>
                						</div>
                						<div class="modal-body form" >
											<div class="form-group row" id="form_id">
                            					<label class="col-md-2 col-form-label">Kode Grup</label>
                            					<div class="col-md-10">
                              						<input type="text" name="cid" id="cid" class="form-control" disabled>
												</div>
                        					</div>
                        					<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama Inisial</label>
                            					<div class="col-md-10" >
												<input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Inisial">
							        			</div>
                        					</div>
                                            <div class="form-group row">
                            					<label class="col-md-2 col-form-label">Kementerian</label>
                            					<div class="col-md-10">
													<select id="flag" class="pc form-control">
														<option value="" disabled selected>Kementerian</option>
														<option>Ya</option>
														<option>Tidak</option>
                                					</select>
                            					</div>
											</div>
                        					<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama Grup</label>
                            					<div class="col-md-10">
                              						<input type="text" name="grup" id="grup" class="form-control" placeholder="Grup">
                            					</div>
											</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Segmen</label>
                            					<div class="col-md-10">
                              						<input type="text" name="segmen" id="segmen" class="form-control" placeholder="Segmen">
                            					</div>
                        					</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label" >Tanggal Mulai</label>
                            					<div class="col-md-10">
													<input type="text" class="form-control" name="tgl_mulai" id="tgl_mulai" placeholder="Tanggal Mulai">
													<input type="hidden" name="tgl" id="tgl" class="form-control" disabled>
												</div>
                        					</div>
											<div class="form-group row" id="tgl_akh">
                            					<label class="col-md-2 col-form-label">Tanggal Akhir</label>
                            					<div class="col-md-10">
                            						<input type="text" class="form-control" name="tgl_akhir" id="tgl_akhir" placeholder="Tanggal Akhir">
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
							<!--Modal Tgl akhir-->
							<div class="modal fade" id="formtgl" tabindex="-1" role="dialog">
       							<div class="modal-dialog">
            						<div class="modal-content">
                						<div class="modal-header">
                    						<h4 class="modal-title" id="HeaderForm">Tanggal Akhir</h4>
                    						<button type="button" class="close" data-dismiss="modal">×</button>
                						</div>
                						<div class="modal-body form" >
											<div class="form-group row" id="form_id">
                            					<label class="col-md-2 col-form-label">Kode Grup</label>
                            					<div class="col-md-10">
                              						<input type="text" name="cid2" id="cid2" class="form-control" disabled>
												</div>
                        					</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label" >Tanggal Mulai</label>
                            					<div class="col-md-10">
													<input type="text" class="form-control" name="tgl_mulai2" id="tgl_mulai2" disabled>
													<input type="hidden" name="tgl2" id="tgl2" class="form-control" disabled>
												</div>
                        					</div>
											<div class="form-group row">
                            					<label class="col-md-2 col-form-label">Tanggal Akhir</label>
                            					<div class="col-md-10">
                            						<input type="text" class="form-control" name="tgl_akhir2" id="tgl_akhir2" placeholder="Tanggal Akhir">
                            					</div>
                        					</div>
                  							<div class="modal-footer">
												<button type="button" type="submit" id="confirm" class="btn btn-primary" onclick="save_tgl();">Confirm</button>
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
  <?php $this->load->view('script/Cid_Script');?>

</body>

</html>
