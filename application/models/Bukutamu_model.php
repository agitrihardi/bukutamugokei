<?php

class Bukutamu_model extends CI_Model
{
    // Model Jenis Instansi
    public function getJenisinstansi($kode_jenis = null)
    {
        if($kode_jenis == null){
            return $this->db->get('tb_jenis')->result_array();
        } else{
            return $this->db->get_where('tb_jenis', ['kode_jenis' => $kode_jenis])->result_array();
        }
    }

    public function deleteJenisinstansi($kode_jenis)
    {
        $this->db->delete('tb_jenis', ['kode_jenis' => $kode_jenis]);
        return $this->db->affected_rows();
    }

    public function createJenisinstansi($data)
    {
        $this->db->insert('tb_jenis', $data);
        return $this->db->affected_rows();
    }

    public function updateJenisinstansi($data, $kode_jenis)
    {
        $this->db->update('tb_jenis', $data, ['kode_jenis' => $kode_jenis]);
        return $this->db->affected_rows();
    }


    // Model Instansi
    public function getInstansi($id_instansi = null)
    {
        if($id_instansi == null){
            return $this->db->get('tb_instansi')->result_array();
        } else{
            return $this->db->get_where('tb_instansi', ['id_instansi' => $id_instansi])->result_array();
        }
    }

    public function deleteInstansi($id_instansi)
    {
        $this->db->delete('tb_instansi', ['id_instansi' => $id_instansi]);
        return $this->db->affected_rows();
    }

    public function createInstansi($data)
    {
        $this->db->insert('tb_instansi', $data);
        return $this->db->affected_rows();
    }

    public function updateInstansi($data, $id_instansi)
    {
        $this->db->update('tb_instansi', $data, ['id_instansi' => $id_instansi]);
        return $this->db->affected_rows();
    }


    // Model Keperluan
    public function getKeperluan($kode_keperluan = null)
    {
        if($kode_keperluan == null){
            return $this->db->get('tb_keperluan')->result_array();
        } else{
            return $this->db->get_where('tb_keperluan', ['kode_keperluan' => $kode_keperluan])->result_array();
        }
    }

    public function deleteKeperluan($kode_keperluan)
    {
        $this->db->delete('tb_keperluan', ['kode_keperluan' => $kode_keperluan]);
        return $this->db->affected_rows();
    }

    public function createKeperluan($data)
    {
        $this->db->insert('tb_keperluan', $data);
        return $this->db->affected_rows();
    }

    public function updateKeperluan($data, $kode_keperluan)
    {
        $this->db->update('tb_keperluan', $data, ['kode_keperluan' => $kode_keperluan]);
        return $this->db->affected_rows();
    }


    // Model Tamu
    public function getTamu($id_tamu = null)
    {
        if($id_tamu == null){
            return $this->db->get('tb_tamu')->result_array();
        } else{
            return $this->db->get_where('tb_tamu', ['id_tamu' => $id_tamu])->result_array();
        }
    }

    public function deleteTamu($id_tamu)
    {
        $this->db->delete('tb_tamu', ['id_tamu' => $id_tamu]);
        return $this->db->affected_rows();
    }

    public function createTamu($data)
    {
        $this->db->insert('tb_tamu', $data);
        return $this->db->affected_rows();
    }

    public function updateTamu($data, $id_tamu)
    {
        $this->db->update('tb_tamu', $data, ['id_tamu' => $id_tamu]);
        return $this->db->affected_rows();
    }
}