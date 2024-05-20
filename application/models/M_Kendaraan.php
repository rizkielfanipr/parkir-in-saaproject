<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Kendaraan extends CI_Model{
 //$table sebagai tabel yang digunakan, dengan pemanggilannya $this->table
 private $table = 'tb_kendaraan';
 //$pk atau Primary Key yang digunakan, dengan pemanggilannya $this->pk
 private $pk ='id_kendaraan';
 public function GetAll(){
 $this->db->order_by($this->pk, 'desc');
 return $this->db->get($this->table);
 }
 public function save($data){
 return $this->db->insert($this->table, $data);
 }
 public function edit($kd){
 $this->db->where($this->pk, $kd);
 return $this->db->get($this->table)->row_array();
 }
 public function update($kd,$data){
 $this->db->where($this->pk, $kd);
 return $this->db->update($this->table, $data);
 }
 public function delete($data){
 $this->db->where($data);
 return $this->db->delete($this->table);
 }
}