<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengunjung extends CI_Controller{
 /*
 $view berfungsi untuk membaca file view seperti read.php, create.php
 dan edit.php dengan lokasi folder views/backend/v_admin/
 */
 private $view = "backend/v_pengunjung/";
 //memanggil control Admin/index dalam keadaan refresh
 private $redirect = "Pengunjung";
 public function __construct()
 {
 parent::__construct();
//control Admin menghubungkan model M_admin
$this->load->model('M_Pengunjung');
}
function index(){
//memanggil model M_admin dengan function GetAll
$read = $this->M_Pengunjung->GetAll();
$data = array(
//'read' variabel yang akan dipanggil pada view read.php
'read'=> $read
);
/*
dengan $this->view artinya memanggil private $view="backend/v_admin/"
dilanjutkan dengan 'read' untuk memanggil read.php
*/
$this->load->view($this->view.'read', $data);
}
public function create(){
//untuk create tidak memangil model, langsung ke view dengan data baru
$data = array(
'create' => ''
);
$this->load->view($this->view.'create', $data);
}
public function save(){
$data = array(
'id_parkir'=> $this->input->post('id_parkir'),
'nama_pengunjung'=> $this->input->post('nama_pengunjung'),
'waktu_masuk'=> $this->input->post('waktu_masuk'),
'waktu_keluar'=> $this->input->post('waktu_keluar'),
);
$this->M_Pengunjung->save($data);
//dengan $this->redirect artinya memanggil private $redirect = "Admin"
redirect($this->redirect,'refresh');
}
public function edit(){
/*
segment 1 adalah control, segment 2 adalah function, segment 2 adalah PK,
data yang akan ditambilkan hanya yang dipilih saja sesuai PK yang dipilih
*/
$kd = $this->uri->segment(3);
$data = array(
//'edit' variabel yang akan dipanggil pada view edit.php
'edit' => $this->M_Pengunjung->edit($kd)
);
$this->load->view($this->view.'edit', $data);
}
public function update(){
    $kd = $this->uri->segment(3);
    $data = array(
    /*
    'nama_admin' =nama yang diambil dari fild pada tabel
    $this->input->post('nama_admin') =nama yang diambil dari form
    */
'id_parkir'=> $this->input->post('id_parkir'),
'nama_pengunjung'=> $this->input->post('nama_pengunjung'),
'waktu_masuk'=> $this->input->post('waktu_masuk'),
'waktu_keluar'=> $this->input->post('waktu_keluar'),
    );
    $this->M_Pengunjung->update($kd,$data);
    redirect($this->redirect,'refresh');
    }
    public function delete(){
    $kd = $this->uri->segment(3);
    $data = array(
    //data akan dihapus sesuai uri->segment(3) yang dipilih
    'id_parkir' => $kd
    );
    $this->M_Pengunjung->delete($data);
    redirect($this->redirect,'refresh');
    }
   }