<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends User_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Produk_model', 'Booking_model', 'Booking_detail_model', 'Pembayaran_model']);
        $this->load->library(['form_validation', 'Upload_config']);
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
                    'produk' => $produk, 'stok_tersedia' => $stok_tersedia,
                    'error'  => 'Tanggal selesai harus lebih besar dari tanggal mulai.',
                ]);
                return;
            }

            // Cek ketersediaan via Model (Refactored)
            $stok_tersedia = $this->Booking_model->get_available_stok($produk_id, $mulai, $selesai);
            if ($qty > $stok_tersedia) {
                $this->load->view('user/booking/form', [
                    'produk' => $produk, 'stok_tersedia' => $stok_tersedia,
                    'error'  => 'Stok tidak mencukupi pada tanggal tersebut.',
                ]);
                return;
            }

            $user = current_user();
            $total_harga = $produk->harga_per_hari * $qty * $durasi;

            // Handle KTP Upload (Refactored using Library)
            $ktp_filename = null;
            if (!empty($_FILES['ktp']['name'])) {
                $upload = $this->upload_config->upload_ktp('ktp');
                if ($upload['status']) {
                    $ktp_filename = $upload['data'];
                } else {
                    $this->load->view('user/booking/form', [
                        'produk' => $produk, 'stok_tersedia' => $stok_tersedia,
                        'error'  => 'Gagal upload KTP: ' . $upload['data'],
                    ]);
                    return;
                }
            }

            // Simpan Booking via Model Transaction (Refactored)
            $booking_data = [
                'user_id'         => $user['id'],
                'tanggal_mulai'   => $mulai,
                'tanggal_selesai' => $selesai,
                'total_harga'     => $total_harga,
                'phone'           => $this->input->post('phone', TRUE),
                'alamat'          => $this->input->post('alamat', TRUE),
                'ktp'             => $ktp_filename,
                'status'          => 'pending',
            ];

            $detail_data = [
                'produk_id'    => $produk_id,
                'qty'          => $qty,
                'harga_satuan' => $produk->harga_per_hari,
            ];

            $booking_id = $this->Booking_model->place_booking($booking_data, $detail_data);

            if ($booking_id) {
                $this->session->set_flashdata('success', 'Booking berhasil! Silahkan upload bukti pembayaran.');
                redirect('pembayaran/upload/' . $booking_id);
            } else {
                $this->session->set_flashdata('error', 'Gagal memproses booking. Silahkan coba lagi.');
                redirect('booking/form/' . $produk_id);
            }
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

    public function hapus($id)
    {
        $user = current_user();
        $booking = $this->Booking_model->get_by_id($id);

        if (!$booking || $booking->user_id != $user['id']) {
            show_404();
        }

        $this->Booking_model->delete($id);
        
        $this->session->set_flashdata('success', 'Riwayat booking berhasil dihapus.');
        redirect('booking/riwayat');
    }
}
