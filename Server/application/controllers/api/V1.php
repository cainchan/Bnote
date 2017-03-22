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
        $this->user_id = $this->session->userdata('user_id');
    }
    public function reg_post(){
        if (empty($this->post('email')) || empty($this->post('password')) || empty($this->post('password2'))){
            $this->result['code'] = 0;
            $this->result['msg'] = 'param is empty';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        if ($this->post('password') != $this->post('password2')){
            $this->result['code'] = 0;
            $this->result['msg'] = 'password is not same';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $password = md5($this->post('password'));
        $criteria = ['email' => $this->post('email')];
        $user = $this->Usermodel->getone($criteria);
        if (!empty($user)){
            $this->result['code'] = 0;
            $this->result['msg'] = 'user is exists';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $data = ['email' => $this->post('email'),
            'password' => md5($this->post('password')),
            'name' => $this->post('email')];
        $user_id = $this->Usermodel->add($data);
        // 增加默认笔记本
        $data = ['name' => '默认笔记本',
            'user_id' => $id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $notebook_id = $this->Notebookmodel->add($data);
        // 增加默认笔记
        $note = $this->Notemodel->getOne(1);
        $data = ['title' => $note['title'],
            'text' => $note['text'],
            'html' => $note['html'],
            'notebook_id' => $notebook_id,
            'user_id' => $user_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
        $note_id = $this->Notemodel->add($data);
        $this->result['msg'] = "created success";
        $this->result['results'] = ['user_id' => $user_id];
        $this->set_response($this->result, REST_Controller::HTTP_CREATED);
    }
    public function login_post(){
        if (empty($this->post('email')) || empty($this->post('password')) ){
            $this->result['code'] = 0;
            $this->result['msg'] = 'param is empty';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
        }
        $password = md5($this->post('password'));
        $criteria = ['email' => $this->post('email')];
        $user = $this->Usermodel->getone($criteria);
        if (empty($user)){
            $this->result['code'] = 0;
            $this->result['msg'] = 'user is not exists';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        if ($user['password'] != $password){
            $this->result['code'] = 0;
            $this->result['msg'] = 'password is error';
            $this->response($this->result, REST_Controller::HTTP_BAD_REQUEST);
            return;
        }
        $token = md5(rand());
        // 是否生产token
        $userinfo = array(
            'username'  => $user['name'],
            'email'     => $user['email'],
            'user_id' => $user['id'],
            // $token => $user['id'],
        );
        $this->session->set_userdata($userinfo);
        $this->result['token'] = $token;
        $this->result['msg'] = 'login success';
        $this->response($this->result, REST_Controller::HTTP_OK);
        return;
    }
    public function logout_get(){
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('user_id');
        $this->result['msg'] = 'logout success';
        $this->response($this->result, REST_Controller::HTTP_OK);
    }
    public function verifyLogin_get(){
        $email = $this->session->userdata('email');
        if (empty($email)){
            $this->result['code'] = 0;
            $this->result['msg'] = 'no logined';
            $this->response($this->result, REST_Controller::HTTP_OK);
            return;
        }
        $this->result['email'] = $email;
        $this->result['msg'] = 'login success';
        $this->response($this->result, REST_Controller::HTTP_OK);
    }
    public function markdown2html_post(){
        $html = MarkdownExtra::defaultTransform($this->post('text'));
        $result = ["status" => "ok","html" => $html];
        $this->response($result, REST_Controller::HTTP_OK);
    }
    // 获取笔记本
    public function notebook_get(){
        $criteria = ['user_id' => $this->user_id];
        $notebooks = $this->Notebookmodel->getAll($criteria);
        if ($notebooks){
            foreach ($notebooks as $key => $value) {
                $criteria = ['notebook_id' => $value['id']];
                $notebooks[$key]['count'] = $this->Notemodel->getTotal($criteria);
            }
            // OK (200) being the HTTP response code
            $this->response($notebooks, REST_Controller::HTTP_OK);
        }else{
            // NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No notebooks were found',
            ], REST_Controller::HTTP_NOT_FOUND); 
        }
    }
    public function notebook_post(){
        $data = ['name' => $this->post('name'),
            'user_id' => $this->user_id,
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
            $criteria = ['user_id' => $this->user_id,'orderby' => 'updated_at DESC'];
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
            $criteria = ['user_id' => $this->user_id,'notebook_id' => $notebook_id,'orderby' => 'updated_at DESC'];
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
            'notebook_id' => $this->post('notebook_id'),
            'user_id' => $this->user_id,
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