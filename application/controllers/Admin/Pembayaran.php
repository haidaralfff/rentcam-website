<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Pembayaran_model', 'Booking_model']);
    }

    public function index()
    {
        $this->Booking_model->expire_pending();
        $data = [
            'title'     => 'Verifikasi Pembayaran — Admin RENTCAM',
            'payments'  => $this->Pembayaran_model->get_all(),
        ];
        $this->load->view('admin/pembayaran/index', $data);
    }

    public function detail($id)
    {
        $payment = $this->Pembayaran_model->get_by_id($id);
        if (!$payment) show_404();

        $data = [
            'title'   => 'Detail Pembayaran #' . $id,
            'payment' => $payment,
        ];
        $this->load->view('admin/pembayaran/detail', $data);
    }

    public function verifikasi($id)
    {
        $status   = $this->input->post('status', TRUE);   // 'verified' or 'rejected'
        $catatan  = $this->input->post('catatan', TRUE);
        $payment  = $this->Pembayaran_model->get_by_id($id);

        if (!$payment) show_404();

        $this->Booking_model->expire_pending();
        $booking = $this->Booking_model->get_by_id($payment->booking_id);
        if (!$booking || $booking->status === 'batal') {
            $this->Pembayaran_model->update_status($id, 'rejected', 'Booking sudah batal/expired.');
            $this->session->set_flashdata('error', 'Booking sudah batal/expired. Pembayaran ditolak.');
            redirect('admin/pembayaran');
        }

        $this->Pembayaran_model->update_status($id, $status, $catatan);

        // Jika verified, ubah status booking menjadi confirmed
        if ($status === 'verified') {
            $this->Booking_model->update_status($payment->booking_id, 'confirmed');
        }
        // Jika rejected, biarkan booking tetap pending agar user bisa upload ulang
        if ($status === 'rejected') {
            $this->Booking_model->update_status($payment->booking_id, 'pending');
        }

        $this->session->set_flashdata('success', 'Status pembayaran berhasil diperbarui.');
        redirect('admin/pembayaran');
    }

    public function hapus($id)
    {
        $payment = $this->Pembayaran_model->get_by_id($id);
        if (!$payment) show_404();

        // Opsional: Hapus file bukti pembayaran jika ingin
        if ($payment->bukti_bayar && file_exists(FCPATH . 'assets/uploads/pembayaran/' . $payment->bukti_bayar)) {
            unlink(FCPATH . 'assets/uploads/pembayaran/' . $payment->bukti_bayar);
        }

        $this->Pembayaran_model->delete($id);
        
        $this->session->set_flashdata('success', 'Pembayaran berhasil dihapus.');
        redirect('admin/pembayaran');
    }
}
