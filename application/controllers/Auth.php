<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
private $redirect = "admin";
public function __construct(){
parent::__construct();
//Load model
$this->load->model('M_auth');
}
public function index(){
$this->session->sess_destroy();
$data = array(
'login' => ''
);
$this->load->view('backend/login', $data);
}
 public function login(){
$kd = $this->input->post('kd_admin');
$pwd = md5($this->input->post('pswd_admin'));
$data = $this->M_auth->CekLogin('admin','kd_admin',$kd);
 //jika login
 if($data['pswd_admin'] == $pwd AND $data['kd_admin'] == $kd){
 $array = array(
 'kd_admin' => $data['kd_admin'],
 'nama_admin' => $data['nama_admin'],
 'IsAdmin' => 1
);
$this->session->set_userdata($array);
redirect('Home','refresh');
}else{
echo "<script>alert('Username atau Password 
salah!');</script>";
redirect('Auth','refresh');
}
}
public function logout()
{
//data session akan di hancurkan
$this->session->sess_destroy();
redirect('Auth','refresh');
}
}