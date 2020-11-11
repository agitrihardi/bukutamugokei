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

        $this->methods['index_get']['limit'] = 12;
    } 


    //get jenis instansi
    public function index_get()
    {
        $kode_jenis = $this->get('kode_jenis');
        if ($kode_jenis === null){
            $jenisinstansi = $this->bukutamu->getJenisinstansi();
        } else{
            $jenisinstansi = $this->bukutamu->getJenisinstansi($kode_jenis);
        }

        if($jenisinstansi){
            $this->response([
                'status' => true,
                'data' => $jenisinstansi
            ], REST_Controller::HTTP_OK);
        } else{
            $this->response([
                'status' => false,
                'message' => 'kode_jenis tidak ditemukan'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $kode_jenis = $this->delete('kode_jenis');

        if ($kode_jenis === NULL) {
            $this->response([
                'status' => false,
                'message' => 'kode_jenis harap diisi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else{
            if($this->bukutamu->deleteJenisinstansi($kode_jenis) > 0){
                //ok
                $this->response([
                    'status' => true,
                    'kode_jenis' => $kode_jenis,
                    'message' => 'jenis instansi berhasil dihapus'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else{
                //not found
                $this->response([
                    'status' => false,
                    'message' => 'kode_jenis tidak ditemukan'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

    public function index_post()
    {
        $data = [
            'jenis_instansi' => $this->post('jenis_instansi')
        ];

        if($this->bukutamu->createJenisinstansi($data) > 0){
            $this->response([
                'status' => true,
                'message' => 'jenis instansi baru sudah ditambah'
            ], REST_Controller::HTTP_CREATED);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal menambahkan data baru'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function index_put()
    {
        $kode_jenis = $this->put('kode_jenis');
        $data = [
            'jenis_instansi' => $this->put('jenis_instansi')
        ];

        if($this->bukutamu->updateJenisinstansi($data, $kode_jenis) > 0){
            $this->response([
                'status' => true,
                'message' => 'jenis instansi berhasil diubah'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else{
            //not found
            $this->response([
                'status' => false,
                'message' => 'gagal mengubah data jenis instansi'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}