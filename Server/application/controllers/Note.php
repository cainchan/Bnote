<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Note extends CI_Controller {
	public function __construct(){
        parent::__construct();
    }

	public function index(){
		if (empty($this->session->userdata('email'))){
			redirect('/user/login');
			return;
		}
		$this->load->view('webapp/index');
	}
}