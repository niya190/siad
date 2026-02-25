<?php

namespace App\Controllers\Staf;

use App\Controllers\BaseController;
use App\Models\ArsipModel;

class NotaDinasController extends BaseController
{
    public function index()
    {
        $model = new ArsipModel();
        $keyword = $this->request->getGet('keyword');

        // Query Dasar: Ambil data khusus 'Nota Dinas'
        $model->select('data_arsip.*, master_lemari.nama_lemari, master_rak.nama_rak')
              ->join('master_rak', 'master_rak.id_rak = data_arsip.id_rak', 'left')
              ->join('master_lemari', 'master_lemari.id_lemari = master_rak.id_lemari', 'left')
              ->where('data_arsip.jenis_arsip', 'Nota Dinas');

        if ($keyword) {
            $model->groupStart()
                  ->like('data_arsip.nomor_surat', $keyword)
                  ->orLike('data_arsip.perihal', $keyword)
                  ->groupEnd();
        }

        $data = [
            'title' => 'Nota Dinas',
            'arsip' => $model->orderBy('data_arsip.created_at', 'DESC')->paginate(10, 'arsip'),
            'pager' => $model->pager,
            'filter_keyword' => $keyword
        ];

        return view('staf/nota_dinas/index_view', $data);
    }
}