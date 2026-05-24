<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * upload_config.php
 * Library for centralized file upload configuration.
 */
class Upload_config
{
    private $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    /**
     * Upload bukti pembayaran (image only).
     * Returns array ['status' => bool, 'data' => filename|error_msg]
     */
    public function upload_bukti($field_name = 'bukti_bayar')
    {
        $upload_path = FCPATH . 'assets/uploads/bukti/';
        if (!is_dir($upload_path)) {
            mkdir($upload_path, 0755, true);
        }

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp|jfif',
            'max_size'      => 71680, // 70MB (KB)
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) {
            $this->CI->load->library('upload', $config);
        } else {
            $this->CI->upload->initialize($config);
        }

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }

    /**
     * Upload identitas / KTP.
     */
    public function upload_ktp($field_name = 'ktp')
    {
        $upload_path = FCPATH . 'assets/uploads/identitas/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) $this->CI->load->library('upload', $config);
        else $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }

    /**
     * Upload foto penerima saat handover.
     */
    public function upload_penerima($field_name = 'foto_penerima')
    {
        $upload_path = FCPATH . 'assets/uploads/penerima/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png',
            'max_size'      => 2048,
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) $this->CI->load->library('upload', $config);
        else $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }

    /**
     * Upload foto produk.
     */
    public function upload_produk($field_name = 'foto')
    {
        $upload_path = FCPATH . 'assets/uploads/produk/';
        if (!is_dir($upload_path)) mkdir($upload_path, 0755, true);

        $config = [
            'upload_path'   => $upload_path,
            'allowed_types' => 'jpg|jpeg|png|gif|webp',
            'max_size'      => 5120, // 5MB (KB)
            'encrypt_name'  => TRUE,
        ];

        if (!isset($this->CI->upload)) $this->CI->load->library('upload', $config);
        else $this->CI->upload->initialize($config);

        if (!$this->CI->upload->do_upload($field_name)) {
            return ['status' => false, 'data' => $this->CI->upload->display_errors('', '')];
        }

        $upload_data = $this->CI->upload->data();
        return ['status' => true, 'data' => $upload_data['file_name']];
    }

    /**
     * Fungsi pembantu untuk menghapus file lama.
     */
    public function remove_file($folder, $filename)
    {
        $file_path = FCPATH . 'assets/uploads/' . $folder . '/' . $filename;
        if (file_exists($file_path) && !is_dir($file_path)) {
            return @unlink($file_path);
        }
        return false;
    }
}
