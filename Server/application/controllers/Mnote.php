<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mnote extends CI_Controller {
	public function __construct(){
        parent::__construct();
        $this->load->model('Notemodel');
        $this->load->helper('url_helper');
    }

	public function index(){
		$criteria = ['orderby' => 'created_at DESC'];
		$data['notes'] = $this->Notemodel->getAll($criteria);
		$this->load->view('app/template/header');
		$this->load->view('app/page/notes',$data);
		$this->load->view('app/template/footer');
	}
	public function search(){
		$key = 'php';
		$criteria = ['title like' => sprintf("%%%s%%",$key)];
		$data['notes'] = $this->Notemodel->getAll($criteria);
		$this->load->view('welcome_message',$data);
	}
	public function detail($id){
		$data['note'] = $this->Notemodel->getOne($id);
		$this->load->view('app/template/header');
		$this->load->view('app/page/note',$data);
		$this->load->view('app/template/footer');
	}
}