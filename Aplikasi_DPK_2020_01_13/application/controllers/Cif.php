<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Cif extends CI_Controller{
        public function __construct(){
            parent::__construct();
            $this->load->helper('url');
            $this->load->library('session');
            $this->load->model("Cif_model");
            $this->load->library("form_validation");
            $this->load->library("Datatables");
            if($this->session->userdata('logged_in') !== TRUE){
                redirect('login');
              }
        }
        public function index(){
			$this->load->view('data/Cif_view'); 
        }
        public function ajax_list()
        {
            $list = $this->Cif_model->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $customers) {
                $no++;
                $row = array();
                $row[] = $no;
                $row[] = $customers->NO_CIF;
                $row[] = $customers->CUSTOMER_NAME;
                $row[] = $customers->grup;
                $row[] = $customers->DIVISI;
                $row[] = $customers->RM_NAME;
                $row[] =  ' <a href="#formcif" data-toggle="modal" class="btn btn-green btn-sm" onclick="submit('."'".$customers->NO_CIF."'".','."'".$customers->tgl_mulai."'".')"><i class="fas fa-edit"></i> Edit</a> <a href="javascript:void(0);" class="btn btn-orange btn-sm" onclick="deleteConfirm('."'".$customers->NO_CIF."'".','."'".$customers->tgl_mulai."'".')"><i class="fas fa-trash"></i> Delete</a>';        
                $data[] = $row;
            }
     
            $output = array(
                            "draw" => $_POST['draw'],
                            "recordsTotal" => $this->Cif_model->count_all(),
                            "recordsFiltered" => $this->Cif_model->count_filtered(),
                            "data" => $data,
                    );
            //output to json format
            echo json_encode($output);
        }
        public function export(){
            // Load plugin PHPExcel nya
            include APPPATH.'third_party/PHPExcel/PHPExcel.php';
            
            // Panggil class PHPExcel nya
            $csv = new PHPExcel();
            // Settingan awal fil excel
            $csv->getProperties()->setCreator($this->session->userdata('nama'))
                         ->setLastModifiedBy( $this->session->userdata('nama'))
                         ->setTitle("Data CIF Grup ")
                         ->setSubject("Mapping CIF Grup ")
                         ->setDescription("Mapping CID CIF")
                         ->setKeywords("Mapping CID CIF");
            // Buat header tabel nya pada baris ke 1
            $csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); // Set kolom A1 dengan tulisan "NO"
            $csv->setActiveSheetIndex(0)->setCellValue('B1', "CIF"); // Set kolom B1 dengan tulisan "NIS"
            $csv->setActiveSheetIndex(0)->setCellValue('C1', "CID"); // Set kolom C1 dengan tulisan "NAMA"
            $csv->setActiveSheetIndex(0)->setCellValue('D1', "Nama Inisial"); // Set kolom D1 dengan tulisan "JENIS KELAMIN"
            $csv->setActiveSheetIndex(0)->setCellValue('E1', "Tanggal Akhir"); // Set kolom E1 dengan tulisan "ALAMAT"
            // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
            $cif = $this->Cif_model->export();
            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 2
            foreach($cif as $data){ // Lakukan looping pada variabel siswa
              $csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
              $csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->NO_CIF);
              $csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data->CUSTOMER_ID);
              $csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data->CUSTOMER_NAME);
              $csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data->tgl_akhir);
              
              $no++; // Tambah 1 setiap kali looping
              $numrow++; // Tambah 1 setiap kali looping
            }
            // Set orientasi kertas jadi LANDSCAPE
            $csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $csv->getActiveSheet(0)->setTitle("Laporan Data Mapping CIF GRUP");
            $csv->setActiveSheetIndex(0);
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Data.csv"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $write = new PHPExcel_Writer_CSV($csv);
            $write->save('php://output');
          }
        
        public function getCustomer(){
            $data = $this->Cif_model->getCID();
            echo json_encode($data);
        }
        public function getDataCID(){
            $cid= $this->input->post('cid');
            $data = $this->Cif_model->CIDbyID($cid);
            echo json_encode($data);
        }
        public function save(){ 
            $data= array(
                'no_cif'    => $this->input->post('no_cif'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
            );
        $result = $this->Cif_model->save_data($data);
        echo json_encode($result);
        }        
        public function getbyId(){  
           $no_cif = $this->input->post('x');
           $tgl = $this->input->post('y');
           $getdata = $this->Cif_model->get_cif_id($no_cif, $tgl);
           echo json_encode($getdata);
        }
            
        public function edit(){          
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $tgl_akhir = $this->input->post('tgl_akhir');
            $tgl_waktu = new DateTime($tgl_akhir);
            $tgl_waktu->setTime(23, 59, 59);
            $where = array('no_cif' => $id, 'tgl_mulai' => $tgl);
            $data= array(
                'no_cif'    => $this->input->post('no_cif'),
                'cid'       => $this->input->post('cid'), 
                'tgl_mulai' => $this->input->post('tgl_mulai'),
                'tgl_akhir' => $tgl_waktu->format('Y-m-d H:i:s'),
                        );
            $result = $this->Cif_model->edit_data($where, $data);
            echo json_encode($result);
        }
        
        public function delete(){
            $id= $this->input->post('id');
            $tgl= $this->input->post('tgl');
            $where = array('no_cif' => $id, 'tgl_mulai' => $tgl) ;
            $result= $this->Cif_model->delete_data($where);
          }

    }
?>