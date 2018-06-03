<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

class Disposisi extends REST_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_disposisi');
        $this->load->model('M_user');
    }

    function index_get(){
        if ($this->get('api')=="disposisiall") {
            $disposisi = $this->M_disposisi->get_all();
            $jml_disposisi = $this->M_disposisi->total_rows();
            $data = array(
                'data'     => $disposisi,
                'jml_data' => $jml_disposisi
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif ($this->get('api')=="disposisiperbagian") {
            $disposisi = $this->M_disposisi->get_by_bagian($this->get('id_bagian'));
            $jml_disposisi = $this->M_disposisi->total_rows_perbagian($this->get('id_bagian'));
            $data = array(
                'data'     => $disposisi,
                'jml_data' => $jml_disposisi
            );
            $this->response($data, REST_Controller::HTTP_OK);
        }elseif ($this->get('api')=="lembardisposisi") {
            $disposisi = $this->M_disposisi->get_by_id($this->get('id'));
            $this->response($disposisi, REST_Controller::HTTP_OK);
        }
    }

    function index_post(){
        if ($this->post('api')=="mendisposisikan") {
            $id_bagian= $this->post('id_bagian');
            $isi_disposisi= $this->post('isi_disposisi');
            $sifat= $this->post('sifat');
            $catatan= $this->post('catatan');
            $id_surat_masuk= $this->post('id_surat_masuk');
            $data = array(
                'id_disposisi'   => "",
                'id_bagian'      => $id_bagian, 
                'isi_disposisi'  => $isi_disposisi, 
                'sifat'          => $sifat, 
                'catatan'        => $catatan, 
                'id_surat_masuk' => $id_surat_masuk, 
                );
            $result = $this->M_disposisi->insert($data);
            if($result>=0){
                $datauser = $this->M_user->get_where_default("LEFT JOIN tb_pegawai ON tb_pegawai.nip=tb_user.nip_user WHERE id_bagian_pegawai='$data[id_bagian]' or level_user = 'kepala desa'")->result();
                $dataterakhir = $this->M_disposisi->get_satu_baru();
                $datasurat = $this->M_surat_masuk->get_by_id($id_surat_masuk);
                foreach ($datauser as $user) {
                    if ($user->level_user=="kepala desa" or $user->level_user=="kepala bagian" or $user->level_user=="staf") {
                        $data_notif = array(
                            'id_notif'      => "",
                            'id_user'       => $user->id_user,
                            'id'            => $dataterakhir->id_disposisi,
                            'jenis_notif'   => "disposisi",
                            'judul_notif'   => "Disposisi Baru ",
                            'isi_notif'     => "No. Surat ".$datasurat->no_surat." Isi Disposisi ".$dataterakhir->isi_disposisi,
                        );
                        $this->M_notifikasi->insert($data_notif);    
                    }
                }
                $this->response(['kode' => 1,'data' => $dataterakhir], REST_Controller::HTTP_OK);
            }else{
                $this->response(['kode' => 2,'pesan' =>'Proses Gagal'], REST_Controller::HTTP_OK);
            }
        }
    }

}