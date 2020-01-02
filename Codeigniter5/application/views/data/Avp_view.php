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
            			<h1 class="h3 mb-0 text-gray-800">NPP AVP</h1>
            			<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
					</div>

						<!-- DataTables -->
					<div class="card mb-3">
						<div class="card-header">
							<a href="#formavp" data-toggle="modal" class="btn btn-green" onclick="submit('add',null,null)"><i class="fas fa-plus"></i> Add New</a>
							<!--<a href="#" class="btn btn-orange" onclick="ResetTable()"><i class="fas fa-refresh"></i>Refresh</a>-->
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="myAvp" class="table table-striped table-bordered table-sm " cellspacing="0" width="100%">
									<thead class="btn-green">
										<tr>
											<th  style="text-align:center">No</th>
											<th style="text-align:center">NPP RM</th>
                    						<th style="text-align:center">Nama RM</th>
											<th style="text-align:center">NPP AVP</th>
                    						<th style="text-align:center">Nama AVP</th>
					          				<th style="text-align:center" width="10%">Tanggal Mulai</th>
											<th style="text-align:center" width="10%">Tanggal Akhir</th>
                    						<th style="text-align:center" width="15%">Action</th>
											</tr>
									</thead>
									<tbody id="show_data" class="table-secondary text-dark">
									</tbody>
								</table>							
							</div><!--Table-Response-->
							<!--Modal ADD & Edit-->
							<div class="modal fade" id="formavp" tabindex="-1" role="dialog">
       							<div class="modal-dialog modal-xl">
            						<div class="modal-content">
                						<div class="modal-header">
                    						<h4 class="modal-title" id="HeaderForm">ADD Data</h4>
                    						<button type="button" class="close" data-dismiss="modal">×</button>
                						</div>
                						<div class="modal-body form" >
											<div class="alert alert-info" id="info">
												<label class="col-md-10 col-form-label">Apabila Nama RM tidak ditemukan, Pilih Add RM</label>
													<a href="#formrm" data-toggle="modal" class="btn btn-green" onclick="addrm()"><i class="fas fa-plus"></i> Add RM </a>
											</div>
											<div class="form-group row" id="addnpp">
                            					<label class="col-md-2 col-form-label">Nama RM</label>
                            					<div class="col-md-10">
                                                    <select id="npprm" class="pc form-control">
                                						<option>Pilih nama RM</option>
                                					</select>
                            					</div>
                        					</div>
											<div class="form-group row" id="nppid">
                            					<label class="col-md-2 col-form-label">NPP</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="npp" id="npp" class="form-control" placeholder="NPP">
													<input type="hidden" name="id" id="id" class="form-control" disabled>
							        			</div>
                        					</div>
                                            <div class="form-group row" id="nama">
                            					<label class="col-md-2 col-form-label">Nama RM</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="namarm" id="namarm" class="form-control" placeholder="Nama RM">
							        			</div>
                        					</div>
											<div class="form-group row" id="avpid">
                            					<label class="col-md-2 col-form-label">AVP</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="avp" id="avp" class="form-control" placeholder="AVP">
							        				<input type="hidden" name="idavp" id="idavp" class="form-control" disabled>
												</div>
                        					</div>
                                            <div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama AVP</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="namaavp" id="namaavp" class="form-control" placeholder="Nama RM">
							        			</div>
                        					</div>
											<div class="form-group row" id="tgl_awl">
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
							<!--Modal ADD RM-->
							<div class="modal fade" id="formrm" tabindex="-1" role="dialog">
       							<div class="modal-dialog modal-xl">
            						<div class="modal-content">
                						<div class="modal-header">
                    						<h4 class="modal-title" id="HeaderForm">ADD RM</h4>
                    						<button type="button" class="close" data-dismiss="modal">×</button>
                						</div>
                						<div class="modal-body form" >
											<div class="form-group row" id="npprm">
                            					<label class="col-md-2 col-form-label">NPP</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="norm" id="norm" class="form-control" placeholder="NPP">
													<input type="hidden" name="idrm" id="idrm" class="form-control" disabled>
							        			</div>
                        					</div>
                                            <div class="form-group row">
                            					<label class="col-md-2 col-form-label">Nama RM</label>
                            					<div class="col-md-10" >
                                                    <input type="text" name="namarmbaru" id="namarmbaru" class="form-control" placeholder="Nama RM">
							        			</div>
                        					</div>
                  							<div class="modal-footer">
                    							<button type="button" type="submit" id="rmbaru" class="btn btn-primary" onclick="ValidateRM()">ADD</button>
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
  <?php $this->load->view('script/Avp_Script');?>

</body>

</html>
