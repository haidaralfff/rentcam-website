<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends Superadmin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Laporan_model', 'Pembayaran_model', 'Booking_model']);
    }

    public function index()
    {
        $tahun = $this->input->get('tahun', TRUE) ?? date('Y');
        $data  = [
            'title'              => 'Laporan — Super Admin RENTCAM',
            'pendapatan_bulanan' => $this->Laporan_model->get_pendapatan_bulanan($tahun),
            'produk_terlaris'    => $this->Laporan_model->get_produk_terlaris(10),
            'total_pendapatan'   => $this->Pembayaran_model->get_total_pendapatan(),
            'tahun'              => $tahun,
            'all_bookings'       => $this->Booking_model->get_all(), // Pastikan model Booking diload
        ];
        $this->load->view('superadmin/laporan/index', $data);
    }

    public function detail($id)
    {
        $this->load->model(['Booking_model', 'Booking_detail_model']);
        $booking = $this->Booking_model->get_by_id($id);
        if (!$booking) show_404();

        $data = [
            'title'      => 'Detail Laporan #' . $id,
            'booking'    => $booking,
            'detail'     => $this->Booking_detail_model->get_by_booking($id),
            'pembayaran' => $this->Pembayaran_model->get_by_booking($id),
        ];
        $this->load->view('superadmin/laporan/detail', $data);
    }
}
