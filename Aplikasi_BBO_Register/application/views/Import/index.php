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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
            			<h1 class="h3 mb-0 text-gray-800">Import Excel Data</h1>
            			<!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
					</div>
                    <div class="card mb-3">
						<div class="card-header">
							<a href="<?php echo base_url("excel/format.xlsx"); ?>" class="btn btn-green"><i class="fas fa-file-excel"></i> Download Template Excel</a>
							<!--<a href="#" class="btn btn-orange" onclick="ResetTable()"><i class="fas fa-refresh"></i>Refresh</a>-->
						</div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url("excel_import/form"); ?>" enctype="multipart/form-data">
		                    <!--
		                        -- Buat sebuah input type file
		                        -- class pull-left berfungsi agar file input berada di sebelah kiri
		                    -->
		                        <input type="file" name="file">
		                    <!--
		                        -- Buat sebuah tombol submit untuk melakukan preview terlebih dahulu data yang akan di import
		                    -->
		                        <input type="submit" name="preview" value="Preview" class="btn btn-green">
	                        </form>
                            <?php
                                if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
									if(isset($upload_error)){ // Jika proses upload gagal
										echo "<div style='color: red;'>".$upload_error."</div>"; // Muncul pesan error upload
										die; // stop skrip
									}
							
									// Buat sebuah tag form untuk proses import data ke database
		                                echo "<form method='post' action='".base_url("excel_import/import")."'>";
                                echo "<br/>";
		                        echo "<table class='table table-striped table-bordered table-sm' cellspacing='0' width='100%'>
		                        <tr>
			                        <th colspan='5' style='text-align:center'>Preview Data</th>
		                        </tr>
								<tr>
									<th>No</th>
			                        <th>CIF</th>
			                        <th>Kode Grup</th>
			                        <th>Tanggal Mulai</th>
			                        <th>Tanggal Akhir</th>
		                        </tr>";

		                        $numrow = 1;
								$kosong = 0;
								$no = 1;

		                        // Lakukan perulangan dari data yang ada di excel
		                        // $sheet adalah variabel yang dikirim dari controller
		                        foreach($sheet as $row){
			                    // Ambil data pada excel sesuai Kolom
			                        $cif = $row['A']; // Ambil data nocif
			                        $cid = $row['B']; 
			                        $tgl_mulai = $row['C']; 
									$tgl_akhir = $row['D']; 
									
									$sql = $this->db->query("SELECT no_cif, cid, tgl_mulai, tgl_akhir FROM a_nasabah.mapping_cid_cif_test where no_cif='$cif' and tgl_mulai ='$tgl_mulai'");

			                    // Cek jika no_cif dan tgl_mulai sudah ada di database
			                    if($sql->num_rows()>0)
				                    continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			                        // Cek $numrow apakah lebih dari 1
			                        // Artinya karena baris pertama adalah nama-nama kolom
			                        // Jadi dilewat saja, tidak usah diimport
			                        if($numrow > 1){
				                        // Validasi apakah semua data telah diisi
				                        $cif_td = ( ! empty($cif))? "" : " style='background: #E07171;'"; // Jika NO_CIF kosong, beri warna merah
				                        $cid_td = ( ! empty($cid))? "" : " style='background: #E07171;'"; 
				                        $tgl_mulai_td = ( ! empty($tgl_mulai))? "" : " style='background: #E07171;'"; 
				                        $tgl_akhir_td = ( ! empty($tgl_akhir))? "" : " style='background: #E07171;'"; 

				                // Jika salah satu data ada yang kosong
				                if($cif == "" or $cid == "" or $tgl_mulai == "" or $tgl_akhir == ""){
					                $kosong++; // Tambah 1 variabel $kosong
				                }

				                echo "<tr>";
								echo "<td>".$no++."</td>";
								echo "<td".$cif_td.">".$cif."</td>";
				                echo "<td".$cid_td.">".$cid."</td>";
				                echo "<td".$tgl_mulai_td.">".$tgl_mulai."</td>";
				                echo "<td".$tgl_akhir_td.">".$tgl_akhir."</td>";
				                echo "</tr>";
			                }

			            $numrow++; // Tambah 1 setiap kali looping
		            }
		        echo "</table>";
			            echo "<hr>";
			            // Buat sebuah tombol untuk mengimport data ke database
                        echo "<button type='submit' class='btn btn-green' name='import'>Import</button>";
                        echo "<tr/> <tr/>";
			                echo "<a href='".base_url("excel_import/form")."' class='btn btn-orange' >Cancel</a>";
                echo "</form>";
	    }
	?>  
                        </div>
                    </div>
                </div>
           
      			<!-- End of Footer -->
    		</div><!-- End of Content -->
            <?php $this->load->view('admin/partials/footer'); ?>
  		</div><!-- End of Page Wrapper -->
	</div><!--Wrapper-->
  <!-- Scroll to Top Button-->
  <?php $this->load->view('admin/partials/scrolltop');?>

  <!-- Logout Modal-->
  <?php $this->load->view('admin/partials/modal');?>
  <!-- Bootstrap core JavaScript-->
  <?php $this->load->view('admin/partials/js');?>
  

</body>

</html>


