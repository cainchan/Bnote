<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Michelf/MarkdownExtra.inc.php';
// use namespace
use Restserver\Libraries\REST_Controller;
use \Michelf\MarkdownExtra;

class V1 extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Usermodel');
        $this->load->model('Notemodel');
        $this->load->model('Notebookmodel');
        $this->result = ['code' => 1,'msg' => '','results' => ''];
    }
    public function reg_post(){
        $password = md5($this->post('password'));
        $criteria = ['email' => $this->post('email')];
        $user = $this->Usermodel->getone($criteria);
        if (!empty($user)){
            $this->result['code'] == 0;
            $this->result['msg'] == 'user is exists';
            $this->response($this->result, REST_Controller::HTTP_OK);
        }
        $data = ['email' => $this->post('email'),
            'password' => md5($this->post('password')),
            'name' => ''];
        $id = $this->Usermodel->add($data);
        $this->result['msg'] = "created success";
        $this->result['results'] = ['id' => $id];
        $this->set_response($this->result, REST_Controller::HTTP_CREATED); 
    }
    public function login_post(){
        $password = md5($this->post('password'));
        $criteria = ['email' => $this->post('email')];
        $user = $this->Usermodel->getone($criteria);
        if (empty($user)){
            $this->result['code'] == 0;
            $this->result['msg'] == 'user is not exists';
            $this->response($this->result, REST_Controller::HTTP_OK);
        }
        if ($user['password'] != $password){
            $this->result['code'] == 0;
            $this->result['msg'] == 'password is error';
            $this->response($this->result, REST_Controller::HTTP_OK);
        }
        // 是否生产token
        $userinfo = array(
            'username'  => $user['name'],
            'email'     => $user['email'],
            'logged_in' => TRUE
        );
        $this->session->set_userdata($userinfo);
    }
    public function markdown2html_post(){
        $html = MarkdownExtra::defaultTransform($this->post('text'));
        $result = ["status" => "ok","html" => $html];
        $this->response($result, REST_Controller::HTTP_OK);
    }
    // 获取笔记本
    public function notebook_get(){
        $notebooks = $this->Notebookmodel->getAll();
        if ($notebooks){
            // OK (200) being the HTTP response code
            $this->response($notebooks, REST_Controller::HTTP_OK);
        }else{
            // NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No notes were found'
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
    public function notebook_post(){
        $data = ['name' => $this->post('name'),
            'user_id' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $id = $this->Notebookmodel->add($data);
        $message = [
            "id" => $id,
            "message" => "created success"
        ];
        // CREATED (201) being the HTTP response code
        $this->set_response($message, REST_Controller::HTTP_CREATED); 
    }
    public function notebook_delete(){
        $id = intval($this->get('id'));
        if ($id <= 0){
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $this->Notebookmodel->delete($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }

    public function note_get(){
        $notebook_id = $this->get('notebook');
        if ($notebook_id === NULL){
            $criteria = ['orderby' => 'updated_at DESC'];
            $notes = $this->Notemodel->getAll($criteria);
            if ($notes){
                // OK (200) being the HTTP response code
                $this->response($notes, REST_Controller::HTTP_OK); 
            }else{
                // NOT_FOUND (404) being the HTTP response code
                $this->response([
                    'status' => FALSE,
                    'message' => 'No notes were found'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }
        }else {
            $notebook_id = intval($notebook_id);
            if ($notebook_id <= 0){
                // BAD_REQUEST (400) being the HTTP response code
                $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); 
            }
            $criteria = ['notebook_id' => $notebook_id,'orderby' => 'updated_at DESC'];
        	$notes = $this->Notemodel->getAll($criteria);

            if (!empty($notes)){
                $this->set_response($notes, REST_Controller::HTTP_OK);
            }else{
                $this->response([], REST_Controller::HTTP_OK);
            }
        }
    }
    public function note_post(){
        $data = ['title' => $this->post('title'),
            'text' => $this->post('text'),
            'html' => $this->post('html'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $id = $this->Notemodel->add($data);
        $message = [
            "id" => $id,
            "message" => "created success"
        ];
        // CREATED (201) being the HTTP response code
        $this->set_response($message, REST_Controller::HTTP_CREATED); 
    }
    public function note_put(){
        $id = intval($this->get('id'));
        if ($id <= 0){
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $data = ['title' => $this->put('title'),
            'text' => $this->put('text'),
            'html' => $this->put('html'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $this->Notemodel->edit($id,$data);
        $message = [
            'id' => $id,
            'message' => 'updated the resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
    public function note_delete(){
        $id = intval($this->get('id'));
        if ($id <= 0){
            $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
        }
        $this->Notemodel->delete($id);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
        ];
        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    }
}