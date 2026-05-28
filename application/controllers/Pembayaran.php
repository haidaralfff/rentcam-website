<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends User_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Booking_model', 'Pembayaran_model', 'Booking_detail_model']);
        $this->load->library('Upload_config');
    }

    public function upload($booking_id)
    {
        $this->Booking_model->expire_pending();
        $booking = $this->Booking_model->get_by_id($booking_id);
        $user    = current_user();

        if (!$booking || $booking->user_id != $user['id']) show_404();

        if ($booking->status === 'batal') {
            $this->session->set_flashdata('error', 'Booking sudah dibatalkan karena melewati batas waktu pembayaran.');
            redirect('booking/riwayat');
        }

        if (!empty($booking->deadline_bayar) && strtotime($booking->deadline_bayar) < time()) {
            $this->Booking_model->update_status($booking_id, 'batal');
            $this->session->set_flashdata('error', 'Booking melewati batas waktu pembayaran dan otomatis dibatalkan.');
            redirect('booking/riwayat');
        }

        if ($booking->status !== 'pending') {
            $this->session->set_flashdata('error', 'Status booking tidak valid untuk upload pembayaran.');
            redirect('booking/riwayat');
        }

        // Cek apakah sudah ada pembayaran
        $existing = $this->Pembayaran_model->get_by_booking($booking_id);
        if ($existing && $existing->status === 'verified') {
            $this->session->set_flashdata('error', 'Pembayaran sudah terverifikasi.');
            redirect('booking/riwayat');
        }

        if ($this->input->method() === 'post') {
            $metode = $this->input->post('metode', TRUE);
            $bukti_bayar_filename = null;

            if ($metode === 'cash' && empty($_FILES['bukti_bayar']['name'])) {
                // Opsional, tidak perlu upload bukti
            } else {
                $result = $this->upload_config->upload_bukti('bukti_bayar');

                if (!$result['status']) {
                    $data = [
                        'title'   => 'Upload Bukti Pembayaran',
                        'booking' => $booking,
                        'detail'  => $this->Booking_detail_model->get_by_booking($booking_id),
                        'error'   => $result['data'],
                    ];
                    $this->load->view('user/pembayaran/upload', $data);
                    return;
                }
                $bukti_bayar_filename = $result['data'];
            }

            $pay_data = [
                'booking_id'  => $booking_id,
                'metode'      => $metode,
                'bukti_bayar' => $bukti_bayar_filename,
                'status'      => 'pending',
            ];

            if ($existing) {
                $this->Pembayaran_model->update($existing->id, $pay_data);
            } else {
                $this->Pembayaran_model->create($pay_data);
            }

            $this->session->set_flashdata('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
            redirect('pembayaran/status');
        }

        $data = [
            'title'   => 'Upload Bukti Pembayaran — RENTCAM',
            'booking' => $booking,
            'detail'  => $this->Booking_detail_model->get_by_booking($booking_id),
        ];
        $this->load->view('user/pembayaran/upload', $data);
    }

    public function status()
    {
        $this->Booking_model->expire_pending();
        $user = current_user();
        $payments = $this->Pembayaran_model->get_by_user($user['id']);

        $data = [
            'title'    => 'Status Pembayaran — RENTCAM',
            'payments' => $payments,
        ];
        $this->load->view('user/pembayaran/status', $data);
    }
}
