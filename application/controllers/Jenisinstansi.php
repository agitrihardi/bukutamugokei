<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Jenisinstansi extends REST_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bukutamu_model', 'bukutamu');
    } 


    //get jenis instansi
    public function index_get()
    {
        $jenisinstansi = $this->bukutamu->getJenisinstansi();
        $this->response([
            'status' => true,
            'data' => $jenisinstansi
        ], REST_Controller::HTTP_OK);
    }

}