<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Produk_model', 'Review_model']);
    }

    public function index()
    {
        $filters = [
            'kategori' => $this->input->get('kategori', TRUE),
            'search'   => $this->input->get('search', TRUE),
            'status'   => 'tersedia',
        ];
        $data = [
            'title'  => 'Katalog Produk — RENTCAM',
            'produk' => $this->Produk_model->get_all($filters),
        ];
        $this->load->view('user/produk/index', $data);
    }

    public function detail($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
        if (!$produk) show_404();

        $data = [
            'title'   => $produk->nama . ' — RENTCAM',
            'produk'  => $produk,
            'reviews' => $this->Review_model->get_by_produk($id),
            'rating'  => $this->Produk_model->get_avg_rating($id),
        ];
        $this->load->view('user/produk/detail', $data);
    }
}
