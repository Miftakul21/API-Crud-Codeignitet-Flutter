<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApiMhs extends CI_Controller {

    function _construct() {
        parent:: _construct();
        $this->load->model('Mahasiswa');
    }
    // function ambil data mahasaiswa
    function getDataMhs() {
        $query = $this->db->get('tb_mahasiswa');
        if($query->num_rows() > 0){
            $data['message'] = 'Success get data!';
            $data['status'] = 200;
            $data['data'] = $query->result();
        }else {
            $data['message'] = 'Failed get data!';
            $data['status'] = 404;
        }

        echo json_encode($data);
    }

    // function untuk menambahakan data
    function addDataMhs() {
        $nama = $this->input->post('nama');
        $jurusan = $this->input->post('jurusan');

        $save['nama'] = $nama;
        $save['jurusan'] = $jurusan;
        
        $query = $this->db->insert('tb_mahasiswa', $save);

        if($query){
            $data['message'] = 'Success add data!';
            $data['status'] = 200;
            $data['data'] = $save;
        }else {
            $data['message'] = 'Failed get data!';
            $data['status'] = 404;
        }
        echo json_encode($data);
    }

   // functiun untuk menghapus data 
   function deleteDataMhs($id) {
        $this->db->where('id', $id);
        $query = $this->db->delete('tb_mahasiswa');
        if($query) {
            $data['message'] = 'Success delete data';
            $data['status'] = 200;
        } else {
            $data['message'] = 'Failed delete data';
            $data['status'] = 404;
        }
        echo json_encode($data);
   }

   function updateDataMhs() {
    //    $id = $this->input->put('id');
       $id = $this->input->post('id');
    //    $nama = $this->input->put('nama');
       $nama = $this->input->post('nama');
    //    $jurusan = $this->input->put('jurusan');
       $jurusan = $this->input->post('jurusan');
       $data = [
           'nama' => $nama,
           'jurusan' => $jurusan
       ];
       $this->db->where('id', $id);
       $query = $this->db->update('tb_mahasiswa',$data);
       if($query) {
           $data['message'] = 'Success update data';
           $data['status'] = 200;
        } else {
            $data['message'] = 'Failed update data';
            $data['status'] = 404;
        }
        echo json_encode($data);   
   }
}
