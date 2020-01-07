<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Excel_import extends CI_Controller
{
    private $filename = "import_data"; // Kita tentukan nama filenya
	
	public function __construct(){
		parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('excel_import_model');
        if($this->session->userdata('logged_in') !== TRUE){
            redirect('login');
          }
	}
	
	public function form(){
		$data = array(); // Buat variabel $data sebagai array
		
		if(isset($_POST['preview'])){ // Jika user menekan tombol Preview pada form
			// lakukan upload file dengan memanggil function upload yang ada di excel_import_model.php
			$upload = $this->excel_import_model->upload_file($this->filename);
			
			if($upload['result'] == "success"){ // Jika proses upload sukses
				// Load plugin PHPExcel nya
				include APPPATH.'third_party/PHPExcel/PHPExcel.php';
				
				$excelreader = new PHPExcel_Reader_Excel2007();
				$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang tadi diupload ke folder excel
				$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				
				// Masukan variabel $sheet ke dalam array data yang nantinya akan di kirim ke file import/index.php
				// Variabel $sheet tersebut berisi data-data yang sudah diinput di dalam excel yang sudah di upload sebelumnya
				$data['sheet'] = $sheet; 
			}else{ // Jika proses upload gagal
				$data['upload_error'] = $upload['error']; // Ambil pesan error uploadnya untuk dikirim ke file index dan ditampilkan
			}
		}
		
		$this->load->view('import/index', $data);
	}
	
	public function import(){
		// Load plugin PHPExcel nya
		include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		
		$excelreader = new PHPExcel_Reader_Excel2007();
		$loadexcel = $excelreader->load('excel/'.$this->filename.'.xlsx'); // Load file yang telah diupload ke folder excel
		$sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
		
		// Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
		$data = array();
		
		$numrow = 1;
		foreach($sheet as $row){
			// Ambil data pada excel sesuai Kolom
			$cif = $row['A']; // Ambil data nocif
			$cid = $row['B']; 
			$tgl_mulai = $row['C']; 
			$tgl_akhir = $row['D']; 
			
			$sql = $this->db->query("SELECT no_cif, cid, tgl_mulai, tgl_akhir FROM a_nasabah.mapping_cid_cif_test where no_cif='$cif' and tgl_mulai ='$tgl_mulai'");

		// Cek jika data no cif sudah terdaftar pada database
		if($sql->num_rows()>0)
			continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)
			// Cek $numrow apakah lebih dari 1
			// Artinya karena baris pertama adalah nama-nama kolom
			// Jadi dilewat saja, tidak usah diimport
			if($numrow > 1){
				// Kita push (add) array data ke variabel data
				array_push($data, array(
					'no_cif'=>$row['A'], // Insert data no cif dari kolom A di excel
					'cid'=>$row['B'], 
					'tgl_mulai'=>$row['C'], 
					'tgl_akhir'=>$row['D'], 
				));
			}
			
			$numrow++; // Tambah 1 setiap kali looping
		}
        
		// Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
		$this->excel_import_model->insert($data);
		
		redirect("Cif"); // Redirect ke halaman awal (ke controller siswa fungsi Cif)
	}
}

?>