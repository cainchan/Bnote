<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';
// use namespace
use Restserver\Libraries\REST_Controller;
class V1 extends REST_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Notemodel');
        $this->load->model('Notebookmodel');
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

    public function note_get(){
        $notebook_id = $this->get('notebook');
        if ($notebook_id === NULL){
            $criteria = ['orderby' => 'created_at DESC'];
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
            $criteria = ['notebook_id' => $notebook_id,'orderby' => 'created_at DESC'];
        	$notes = $this->Notemodel->getAll($criteria);

            if (!empty($notes)){
                $this->set_response($notes, REST_Controller::HTTP_OK);
            }else{
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'Notes could not be found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }
    public function note_post(){
        $data = ['title' => $this->post('title'),
            'text' => $this->post('text'),
            'html' => $this->post('html'),
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
        $data = ['title' => $this->post('title'),
            'text' => $this->post('text'),
            'html' => $this->post('html'),
        ];
        $this->Notemodel->edit($id,$data);
        $message = [
            'id' => $id,
            'message' => 'Deleted the resource'
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