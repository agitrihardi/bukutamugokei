<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Tamu extends REST_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bukutamu_model', 'bukutamu');
    } 


    //get jenis instansi
    public function index_get()
    {
        $id_tamu = $this->get('id_tamu');
        if ($id_tamu === null){
            $tamu = $this->bukutamu->getTamu();
        } else{
            $tamu = $this->bukutamu->getTamu($id_tamu);
        }

        if($tamu){
            $this->response([
                'status' => true,
                'data' => $tamu
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'Data tamu tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id_tamu = $this->delete('id_tamu');

        if ($id_tamu === NULL) {
            $this->response([
                'status' => false,
                'message' => 'id_tamu harap diisi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else{
            if($this->bukutamu->deleteTamu($id_tamu) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'kode_jenis' => $id_tamu,
                    'message' => 'Tamu berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else{
                //not found
                $this->response([
                    'status' => false,
                    'message' => 'id_tamu tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama_pj' => $this->post('nama_pj'),
            'jabatan' => $this->post('jabatan'),
            'nik' => $this->post('nik'),
            'no_hp' => $this->post('no_hp'),
            'alamat' => $this->post('alamat'),
            'id_instansi' => $this->post('id_instansi'),
            'kode_keperluan' => $this->post('kode_keperluan')
        ];

        if($this->bukutamu->createTamu($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'Tamu baru sudah ditambah'
            ], REST_Controller::HTTP_CREATED);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan tamu baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $id_tamu = $this->put('id_tamu');
        $data = array(
            'nama_pj' => $this->put('nama_pj'),
            'jabatan' => $this->put('jabatan'),
            'nik' => $this->put('nik'),
            'no_hp' => $this->put('no_hp'),
            'alamat' => $this->put('alamat'),
            'id_instansi' => $this->put('id_instansi'),
            'kode_keperluan' => $this->put('kode_keperluan'));
        $this->db->where('id_tamu', $id_tamu);
        $update = $this->db->update('tb_tamu', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}