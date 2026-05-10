<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends User_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Produk_model', 'Booking_model', 'Booking_detail_model', 'Pembayaran_model']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title'  => 'Buat Booking — RENTCAM',
            'produk' => $this->Produk_model->get_tersedia(),
        ];
        $this->load->view('user/booking/index', $data);
    }

    public function form($produk_id)
    {
        $produk = $this->Produk_model->get_by_id($produk_id);
        if (!$produk || $produk->stok <= 0) {
            $this->session->set_flashdata('error', 'Produk tidak tersedia.');
            redirect('booking');
        }

        $stok_tersedia = $produk->stok;

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('tanggal_mulai',   'Tanggal Mulai',   'required');
            $this->form_validation->set_rules('tanggal_selesai', 'Tanggal Selesai', 'required');
            $this->form_validation->set_rules('qty',             'Jumlah',          'required|is_natural_no_zero');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('user/booking/form', [
                    'produk' => $produk,
                    'stok_tersedia' => $stok_tersedia,
                    'error'  => validation_errors(),
                ]);
                return;
            }

            $mulai   = $this->input->post('tanggal_mulai', TRUE);
            $selesai = $this->input->post('tanggal_selesai', TRUE);
            $qty     = (int) $this->input->post('qty', TRUE);
            $durasi  = hitung_durasi($mulai, $selesai);

            if ($durasi <= 0) {
                $this->load->view('user/booking/form', [
                    'produk' => $produk,
                    'stok_tersedia' => $stok_tersedia,
                    'error'  => 'Tanggal selesai harus lebih besar dari tanggal mulai.',
                ]);
                return;
            }

            // Cek ketersediaan berdasarkan qty
            $reserved_qty   = $this->Booking_model->get_reserved_qty($produk_id, $mulai, $selesai);
            $stok_tersedia  = max(0, $produk->stok - $reserved_qty);
            if ($qty > $stok_tersedia) {
                $this->load->view('user/booking/form', [
                    'produk' => $produk,
                    'stok_tersedia' => $stok_tersedia,
                    'error'  => 'Stok tidak mencukupi pada tanggal tersebut.',
                ]);
                return;
            }

            $total = $produk->harga_per_hari * $qty * $durasi;
            $user  = current_user();

            // Handle KTP Upload
            $ktp_filename = null;
            if (!empty($_FILES['ktp']['name'])) {
                $config['upload_path']   = './assets/uploads/identitas/';
                $config['allowed_types'] = 'jpg|jpeg|png';
                $config['max_size']      = 2048;
                $config['file_name']     = 'ktp_' . time() . '_' . $user['id'];

                if (!is_dir($config['upload_path'])) {
                    mkdir($config['upload_path'], 0777, true);
                }

                $this->load->library('upload', $config);
                if ($this->upload->do_upload('ktp')) {
                    $ktp_filename = $this->upload->data('file_name');
                } else {
                    $this->load->view('user/booking/form', [
                        'produk' => $produk,
                        'stok_tersedia' => $stok_tersedia,
                        'error'  => 'Gagal upload KTP: ' . $this->upload->display_errors('', ''),
                    ]);
                    return;
                }
            }

            // Simpan booking
            $booking_id = $this->Booking_model->create([
                'user_id'         => $user['id'],
                'tanggal_mulai'   => $mulai,
                'tanggal_selesai' => $selesai,
                'total_harga'     => $total,
                'phone'           => $this->input->post('phone', TRUE),
                'alamat'          => $this->input->post('alamat', TRUE),
                'ktp'             => $ktp_filename,
                'status'          => 'pending',
                'deadline_bayar'  => date('Y-m-d H:i:s', strtotime('+1 day')),
            ]);

            // Simpan detail
            $this->Booking_detail_model->create([
                'booking_id'  => $booking_id,
                'produk_id'   => $produk_id,
                'qty'         => $qty,
                'harga_satuan'=> $produk->harga_per_hari,
            ]);

            $this->session->set_flashdata('success', 'Booking berhasil! Silahkan upload bukti pembayaran.');
            redirect('pembayaran/upload/' . $booking_id);
        }

        $this->load->view('user/booking/form', [
            'title'         => 'Form Booking — RENTCAM',
            'produk'        => $produk,
            'stok_tersedia' => $stok_tersedia,
        ]);
    }

    public function riwayat()
    {
        $user = current_user();
        $data = [
            'title'    => 'Riwayat Booking — RENTCAM',
            'bookings' => $this->Booking_model->get_by_user($user['id']),
        ];
        $this->load->view('user/booking/riwayat', $data);
    }
}
