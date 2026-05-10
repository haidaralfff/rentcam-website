          <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Booking_model', 'Booking_detail_model', 'Produk_model']);
    }

    public function index()
    {
        $this->Booking_model->expire_pending();
        $data = [
            'title'    => 'Manajemen Booking — Admin RENTCAM',
            'bookings' => $this->Booking_model->get_all(),
        ];
        $this->load->view('admin/booking/index', $data);
    }

    public function detail($id)
    {
        $booking = $this->Booking_model->get_by_id($id);
        if (!$booking) show_404();

        $data = [
            'title'   => 'Detail Booking #' . $id,
            'booking' => $booking,
            'detail'  => $this->Booking_detail_model->get_by_booking($id),
        ];
        $this->load->view('admin/booking/detail', $data);
    }

    public function update_status($id)
    {
        $status = $this->input->post('status', TRUE);
        $valid  = ['pending', 'confirmed', 'dipinjam', 'kembali', 'batal'];

        if (!in_array($status, $valid)) {
            $this->session->set_flashdata('error', 'Status tidak valid.');
            redirect('admin/booking/detail/' . $id);
        }

        $data = ['status' => $status];

        // Handle Foto Penerima Upload (Admin Only)
        if (!empty($_FILES['foto_penerima']['name'])) {
            $config['upload_path']   = './assets/uploads/penerima/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['file_name']     = 'penerima_' . time() . '_' . $id;

            if (!is_dir($config['upload_path'])) {
                mkdir($config['upload_path'], 0777, true);
            }

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto_penerima')) {
                $data['foto_penerima'] = $this->upload->data('file_name');
                
                // Hapus foto lama jika ada
                $old = $this->Booking_model->get_by_id($id);
                if ($old && $old->foto_penerima) {
                    @unlink('./assets/uploads/penerima/' . $old->foto_penerima);
                }
            } else {
                $this->session->set_flashdata('error', 'Gagal upload foto penerima: ' . $this->upload->display_errors('', ''));
                redirect('admin/booking/detail/' . $id);
            }
        }

        $this->db->where('id', $id)->update('booking', $data);
        $this->session->set_flashdata('success', 'Status booking berhasil diperbarui.');
        redirect('admin/booking/detail/' . $id);
    }
}
