<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Superadmin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data = [
            'title' => 'Manajemen User — Super Admin RENTCAM',
            'users' => $this->User_model->get_all(),
        ];
        $this->load->view('admin/user/index', $data);
    }

    public function edit($id)
    {
        $user = $this->User_model->get_by_id($id);
        if (!$user) show_404();

        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',  'Nama',  'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            if ($this->form_validation->run() === FALSE) {
                $this->load->view('admin/user/edit', ['user' => $user, 'error' => validation_errors()]);
                return;
            }

            $email = $this->input->post('email', TRUE);
            if ($this->User_model->email_exists($email, $id)) {
                $this->load->view('admin/user/edit', ['user' => $user, 'error' => 'Email sudah digunakan.']);
                return;
            }

            $this->User_model->update($id, [
                'nama'     => $this->input->post('nama', TRUE),
                'email'    => $email,
                'status'   => $this->input->post('status', TRUE),
                'password' => $this->input->post('password'),
            ]);

            $this->session->set_flashdata('success', 'Data user berhasil diperbarui.');
            redirect('superadmin/user');
        }

        $this->load->view('admin/user/edit', [
            'title' => 'Edit User — Super Admin RENTCAM',
            'user'  => $user,
        ]);
    }

    public function toggle_status($id)
    {
        $this->User_model->toggle_status($id);
        $this->session->set_flashdata('success', 'Status user berhasil diubah.');
        redirect('superadmin/user');
    }

    public function hapus($id)
    {
        $this->db->where('id', $id)->delete('users');
        $this->session->set_flashdata('success', 'User berhasil dihapus.');
        redirect('superadmin/user');
    }
}
