<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Review_model extends CI_Model
{
    protected $table = 'review';

    public function get_by_produk($produk_id, $limit = 10)
    {
        $this->db->select('review.*, users.nama as nama_user');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = review.user_id');
        $this->db->where('review.produk_id', $produk_id);
        $this->db->order_by('review.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }

    public function get_by_user($user_id)
    {
        $this->db->select('review.*, produk.nama as nama_produk, produk.foto');
        $this->db->from($this->table);
        $this->db->join('produk', 'produk.id = review.produk_id');
        $this->db->where('review.user_id', $user_id);
        $this->db->order_by('review.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function already_reviewed($user_id, $booking_id)
    {
        return $this->db->where([
            'user_id'    => $user_id,
            'booking_id' => $booking_id,
        ])->count_all_results($this->table) > 0;
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }
}
