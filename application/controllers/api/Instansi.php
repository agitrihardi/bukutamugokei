<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Instansi extends REST_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bukutamu_model', 'bukutamu');
    } 


    //get jenis instansi
    public function index_get()
    {
        $id_instansi = $this->get('id_instansi');
        if ($id_instansi === null){
            $instansi = $this->bukutamu->getInstansi();
        } else{
            $instansi = $this->bukutamu->getInstansi($id_instansi);
        }

        if($instansi){
            $this->response([
                'status' => true,
                'data' => $instansi
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'Instansi tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id_instansi = $this->delete('id_instansi');

        if ($id_instansi === NULL) {
            $this->response([
                'status' => false,
                'message' => 'id_instansi harap diisi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else{
            if($this->bukutamu->deleteinstansi($id_instansi) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'kode_jenis' => $id_instansi,
                    'message' => 'instansi berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else{
                //not found
                $this->response([
                    'status' => false,
                    'message' => 'id_instansi tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama_instansi' => $this->post('nama_instansi'),
            'alamat' => $this->post('alamat'),
            'kode_jenis' => $this->post('kode_jenis')
        ];

        if($this->bukutamu->createInstansi($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'instansi baru sudah ditambah'
            ], REST_Controller::HTTP_CREATED);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan instansi baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_instansi = $this->put('id_instansi');
        $data = array(
            'nama_instansi' => $this->put('nama_instansi'),
            'alamat'        => $this->put('alamat'),
            'kode_jenis'    => $this->put('kode_jenis'));
        $this->db->where('id_instansi', $id_instansi);
        $update = $this->db->update('tb_instansi', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}