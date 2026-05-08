<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('user_id')) {
            redirect('login');
        }
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $id   = $this->session->userdata('user_id');
        $user = $this->User_model->get_by_id($id);
        
        if ($this->input->method() === 'post') {
            $this->form_validation->set_rules('nama',  'Nama',  'required|min_length[3]');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            
            if (!empty($this->input->post('password'))) {
                $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
            }

            if ($this->form_validation->run() === TRUE) {
                $data = [
                    'nama'  => $this->input->post('nama', TRUE),
                    'email' => $this->input->post('email', TRUE),
                ];
                
                if (!empty($this->input->post('password'))) {
                    $data['password'] = $this->input->post('password');
                }

                if ($this->User_model->email_exists($data['email'], $id)) {
                    $this->session->set_flashdata('error', 'Email sudah digunakan.');
                } else {
                    $this->User_model->update($id, $data);
                    $this->session->set_userdata('nama', $data['nama']);
                    $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
                    redirect('profile');
                }
            }
        }

        $data = [
            'title' => 'Profil Saya — RENTCAM',
            'user'  => $user,
        ];
        $this->load->view('profile/index', $data);
    }
}
