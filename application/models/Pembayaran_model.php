<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    protected $table = 'pembayaran';

    public function get_all()
    {
        $this->db->select('pembayaran.*, booking.user_id, booking.total_harga, users.nama as nama_user');
        $this->db->from($this->table);
        $this->db->join('booking', 'booking.id = pembayaran.booking_id');
        $this->db->join('users', 'users.id = booking.user_id');
        $this->db->order_by('pembayaran.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_booking($booking_id)
    {
        return $this->db->get_where($this->table, ['booking_id' => $booking_id])->row();
    }

    public function get_by_user($user_id)
    {
        $this->db->select('pembayaran.*, booking.total_harga, booking.tanggal_mulai, booking.tanggal_selesai, booking.deadline_bayar, booking.status as status_booking');
        $this->db->from($this->table);
        $this->db->join('booking', 'booking.id = pembayaran.booking_id');
        $this->db->where('booking.user_id', $user_id);
        $this->db->order_by('pembayaran.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->db->select('pembayaran.*, booking.user_id, booking.total_harga, booking.tanggal_mulai, booking.tanggal_selesai, users.nama as nama_user, users.email');
        $this->db->from($this->table);
        $this->db->join('booking', 'booking.id = pembayaran.booking_id');
        $this->db->join('users', 'users.id = booking.user_id');
        $this->db->where('pembayaran.id', $id);
        return $this->db->get()->row();
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function update_status($id, $status, $catatan = null)
    {
        $update = ['status' => $status];
        if ($catatan !== null) {
            $update['catatan_admin'] = $catatan;
        }
        $this->db->where('id', $id);
        return $this->db->update($this->table, $update);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function count_by_status($status)
    {
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function get_total_pendapatan($tahun = null)
    {
        $this->db->select_sum('booking.total_harga', 'total');
        $this->db->from($this->table);
        $this->db->join('booking', 'booking.id = pembayaran.booking_id');
        $this->db->where('pembayaran.status', 'verified');
        if ($tahun) {
            $this->db->where('YEAR(pembayaran.created_at)', $tahun);
        }
        $result = $this->db->get()->row();
        return $result ? (int)$result->total : 0;
    }
}
