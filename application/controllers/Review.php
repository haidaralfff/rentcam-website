<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review extends User_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Booking_model', 'Booking_detail_model', 'Review_model', 'Produk_model']);
        $this->load->library('form_validation');
    }

    public function form($booking_id)
    {
        $user    = current_user();
        $booking = $this->Booking_model->get_by_id($booking_id);
        
        if (!$booking || $booking->user_id !== $user['id']) show_404();
        if ($booking->status !== 'kembali') {
            $this->session->set_flashdata('error', 'Anda hanya bisa memberi review setelah masa sewa selesai.');
            redirect('booking/riwayat');
        }

        // Ambil detail produk dari booking ini (asumsi 1 booking 1 produk utama)
        $detail = $this->Booking_detail_model->get_by_booking($booking_id);
        if (empty($detail)) show_404();
        $item   = $detail[0]; 
        $produk = $this->Produk_model->get_by_id($item->produk_id);

        if ($this->Review_model->already_reviewed($user['id'], $booking_id)) {
            $this->session->set_flashdata('error', 'Anda sudah memberikan review untuk transaksi ini.');
            redirect('booking/riwayat');
        }

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('rating',   'Rating',   'required|is_natural_no_zero|less_than_equal_to[5]');
            $this->form_validation->set_rules('komentar', 'Komentar', 'required|min_length[10]');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('user/review/form', [
                    'produk'     => $produk,
                    'booking_id' => $booking_id,
                    'error'      => validation_errors()
                ]);
                return;
            }

            $this->Review_model->create([
                'user_id'    => $user['id'],
                'produk_id'  => $item->produk_id,
                'booking_id' => $booking_id,
                'rating'     => $this->input->post('rating', TRUE),
                'komentar'   => $this->input->post('komentar', TRUE),
            ]);

            $this->session->set_flashdata('success', 'Terima kasih atas review Anda!');
            redirect('produk/detail/' . $item->produk_id);
        }

        $this->load->view('user/review/form', [
            'title'      => 'Beri Review — RENTCAM',
            'produk'     => $produk,
            'booking_id' => $booking_id,
        ]);
    }
}
