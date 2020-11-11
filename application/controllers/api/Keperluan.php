<?php
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Keperluan extends REST_Controller
{ 
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Bukutamu_model', 'bukutamu');
    } 


    //get Keperluan
    public function index_get()
    {
        $kode_keperluan = $this->get('kode_keperluan');
        if ($kode_keperluan === null){
            $keperluan = $this->bukutamu->getKeperluan();
        } else{
            $keperluan = $this->bukutamu->getKeperluan($kode_keperluan);
        }

        if($keperluan){
            $this->response([
                'status' => true,
                'data' => $keperluan
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'kode_keperluan tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $kode_keperluan = $this->delete('kode_keperluan');

        if ($kode_keperluan === NULL) {
            $this->response([
                'status' => false,
                'message' => 'kode_keperluan harap diisi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else{
            if($this->bukutamu->deleteKeperluan($kode_keperluan) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'kode_jenis' => $kode_keperluan,
                    'message' => 'Keperluan berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else{
                //not found
                $this->response([
                    'status' => false,
                    'message' => 'kode_keperluan tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'nama_keperluan' => $this->post('nama_keperluan')
        ];

        if($this->bukutamu->createKeperluan($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'keperluan baru sudah ditambah'
            ], REST_Controller::HTTP_CREATED);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data keperluan baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $kode_keperluan = $this->put('kode_keperluan');
        $data = [
            'nama_keperluan' => $this->put('nama_keperluan')
        ];

        if($this->bukutamu->updateKeperluan($data, $kode_keperluan) > 0){
            $this->response([
                'status' => true,
                'message' => 'Keperluan berhasil diubah'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal mengubah data keperluan'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}