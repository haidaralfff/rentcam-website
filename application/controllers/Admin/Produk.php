<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Produk_model');
        $this->load->library(['form_validation', 'Upload_config']);
    }

    public function index()
    {
        $data = [
            'title'  => 'Manajemen Produk — Admin RENTCAM',
            'produk' => $this->Produk_model->get_all(),
        ];
        $this->load->view('admin/produk/index', $data);
    }

    public function tambah()
    {
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',          'Nama',          'required');
            $this->form_validation->set_rules('kategori',      'Kategori',      'required');
            $this->form_validation->set_rules('harga_per_hari','Harga',         'required|is_natural_no_zero');
            $this->form_validation->set_rules('stok',         'Stok',          'required|is_natural');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/produk/tambah', ['error' => validation_errors()]);
                return;
            }

            $data = [
                'nama'          => $this->input->post('nama', TRUE),
                'kategori'      => $this->input->post('kategori', TRUE),
                'spesifikasi'   => $this->input->post('spesifikasi', TRUE),
                'harga_per_hari'=> $this->input->post('harga_per_hari', TRUE),
                'stok'          => $this->input->post('stok', TRUE),
                'status'        => $this->input->post('status', TRUE),
            ];

            if (!empty($_FILES['foto']['name'])) {
                $result = $this->upload_config->upload_produk('foto');
                if (!$result['status']) {
                    $this->load->view('admin/produk/tambah', ['error' => $result['data']]);
                    return;
                }
                $data['foto'] = $result['data'];
            }

            $this->Produk_model->create($data);
            $this->session->set_flashdata('success', 'Produk berhasil ditambahkan.');
            redirect('admin/produk');
        }

        $this->load->view('admin/produk/tambah', ['title' => 'Tambah Produk — Admin RENTCAM']);
    }

    public function edit($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
        if (!$produk) show_404();

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',          'Nama',          'required');
            $this->form_validation->set_rules('kategori',      'Kategori',      'required');
            $this->form_validation->set_rules('harga_per_hari','Harga',         'required|is_natural_no_zero');
            $this->form_validation->set_rules('stok',         'Stok',          'required|is_natural');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/produk/edit', [
                    'title'  => 'Edit Produk — Admin RENTCAM',
                    'produk' => $produk,
                    'error'  => validation_errors()
                ]);
                return;
            }

            $data = [
                'nama'          => $this->input->post('nama', TRUE),
                'kategori'      => $this->input->post('kategori', TRUE),
                'spesifikasi'   => $this->input->post('spesifikasi', TRUE),
                'harga_per_hari'=> $this->input->post('harga_per_hari', TRUE),
                'stok'          => $this->input->post('stok', TRUE),
                'status'        => $this->input->post('status', TRUE),
            ];

            if (!empty($_FILES['foto']['name'])) {
                $result = $this->upload_config->upload_produk('foto');
                if (!$result['status']) {
                    $this->load->view('admin/produk/edit', ['produk' => $produk, 'error' => $result['data']]);
                    return;
                }
                // Hapus foto lama
                if ($produk->foto && file_exists(FCPATH . 'assets/uploads/produk/' . $produk->foto)) {
                    unlink(FCPATH . 'assets/uploads/produk/' . $produk->foto);
                }
                $data['foto'] = $result['data'];
            }

            $this->Produk_model->update($id, $data);
            $this->session->set_flashdata('success', 'Produk berhasil diperbarui.');
            redirect('admin/produk');
        }

        $this->load->view('admin/produk/edit', [
            'title'  => 'Edit Produk — Admin RENTCAM',
            'produk' => $produk,
        ]);
    }

    public function hapus($id)
    {
        $produk = $this->Produk_model->get_by_id($id);
        if ($produk && $produk->foto && file_exists(FCPATH . 'assets/uploads/produk/' . $produk->foto)) {
            unlink(FCPATH . 'assets/uploads/produk/' . $produk->foto);
        }
        $this->Produk_model->delete($id);
        $this->session->set_flashdata('success', 'Produk berhasil dihapus.');
        redirect('admin/produk');
    }
}
