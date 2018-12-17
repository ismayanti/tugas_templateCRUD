<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->ceklogin();
	}
	private function ceklogin()
	{
		$id_user = $this->session->userdata('userid');
		$status = $this->session->userdata('status');
		if ($id_user == null OR $status != 'ok') {
			redirect("auth");
		}
	}
	public function index()
	{
		$data = array(
			'title'=>'user',
			'title_level1'=>'Data_user',
			'title_level2'=>'',
			'datauser'=>$this->model->getusers(),
			'konten'=>'administrator/users/Tusers',
		);
		$this->load->view('administrator/template',$data);
	}

	public function tambah()
	{
		$data = array(
			'title'=>'user',
			'title_level1'=>'Data user',
			'title_level2'=>'Tambah user',
			'konten'=>'administrator/users/tambah',
		);
		$this->load->view('administrator/template',$data);
	}

	public function simpan()
	{
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
			'fullname'=>$fullname,
			'username'=>$username,
			'password'=>md5($password)
		);
	$result = $this->model->simpan('users',$data);
	if ($result == 1)
	{
		echo "<script>alert('Data Berhasil disimpan')</script>";
		$this->index();
	}else{
		echo "<script>alert('Data Gagal disimpan')</script>";
		$this->tambah();
	}
	}

	public function edit($kode=0)
	{
		if ($this->uri->segment(3)==null) {
			echo "<script>alert('Kamu Belum Memilih Data Yang di Edit')</script>";
			$this->index();
		}
		$users = $this->model->getusers(" WHERE id_user='$kode'")->row_array();
		$data = array(
			'title'=>'user',
			'title_level1'=>'Data_user',
			'title_level2'=>'Edit user',
			'id'=>$users['id_user'],
			'fullname'=>$users['fullname'],
			'username'=>$users['username'],
			'konten'=>'administrator/users/edit',
		);
		$this->load->view('administrator/template',$data);
	}

	public function update()
	{
		if (!$_POST['update']) {
			redirect('administrator');
		}
		$id = $this->input->post('id_user');
		$fullname = $this->input->post('fullname');
		$username = $this->input->post('username');
		$data = array(
			'fullname'=>$fullname,
			'username'=>$username
		);
	$result = $this->model->update('users',$data, array('id_user'=>$id));
	if ($result == 1)
	{
		echo "<script>alert('Data Berhasil diupdate')</script>";
		$this->index();
	}else{
		echo "<script>alert('Data Gagal diupdate')</script>";
		$this->edit();
	}
	}

	public function hapus($kode=0)
	{
		if ($this->uri->segment(3)==null) {
			echo "<script>alert('Kamu Belum Memilih Data Yang Ingin dihapus')</script>";
			$this->index();
		}
		
		$result = $this->model->hapus('users', array('id_user'=>$kode));

		if ($result ==1) {
			echo "<script>alert('Data berhasil dihapus')</script>";
			$this->index();
		}else{
			echo "<script>alert('Data gagal dihapus')</script>";
			$this->index();
		}
	}	
}
?>    