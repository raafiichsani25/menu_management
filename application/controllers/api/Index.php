<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Index extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function index_get($id = 0)
    {
        $check_data = $this->db->get_where('barang',['$id' => $id])->row_array();


        // Users from a data store e.g. database
        // jika mengisi id atau data ada
        if($id)
        {
                    if($check_data)
                    {
                        $data = $this->db->get_where('barang',['$id' => $id])->row_array();

                        $this->response($data, RestController::HTTP_OK);
                    }else{


                            $this->response([
                            'status'=>false,
                            'message' => 'Data Tidak Ditemukan'
                            ], 404);
                    }
        
        }else{

            $data = $this->db->get('barang')->result_array();
            $this->response($data,RestController::HTTP_OK);
        }



}

public function index_post()
{
    $data = array(
                    'nama_barang' => strtolower(url_title($this->post('nama_barang'))),
                    'gambar' => $this->post('gambar'),
                    'modal' => $this->post('modal'),
                    'harga_jual' => $this->post('harga_jual'),
                    'stok' => $this->post('stok'),
                    'qrcode_path' => 'API',
                    'qrcode_data' => $this->post('qrcode_data'),
                    'date' => 'API'
    );


    $insert = $this->db->insert('barang',$data);

    if($insert)
    {
        $this->response($data, RestController::HTTP_OK);
    }else
    {
        $this->response(array('status' => 'failed', 502));
    }
}

}