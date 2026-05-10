<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_model extends CI_Model
{
    protected $table = 'booking';

    public function expire_pending()
    {
        $now = date('Y-m-d H:i:s');
        $this->db->select('id');
        $this->db->from($this->table);
        $this->db->where('status', 'pending');
        $this->db->where('deadline_bayar IS NOT NULL', null, false);
        $this->db->where('deadline_bayar <', $now);
        $expired = $this->db->get()->result();

        if (empty($expired)) {
            return false;
        }

        $ids = array_map(function ($row) {
            return $row->id;
        }, $expired);

        $this->db->where_in('id', $ids);
        $this->db->update($this->table, ['status' => 'batal']);

        $this->db->where_in('booking_id', $ids);
        $this->db->update('pembayaran', [
            'status' => 'rejected',
            'catatan_admin' => 'Booking expired (auto-cancel).',
        ]);

        return true;
    }

    public function get_all()
    {
        $this->expire_pending();
        $this->db->select('booking.*, users.nama as nama_user, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = booking.user_id');
        $this->db->order_by('booking.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_user($user_id)
    {
        $this->expire_pending();
        $this->db->select('booking.*, pembayaran.status as status_bayar, review.id as review_id, booking_detail.produk_id, GROUP_CONCAT(produk.nama SEPARATOR ", ") as nama_produk');
        $this->db->from($this->table);
        $this->db->join('pembayaran', 'pembayaran.booking_id = booking.id', 'left');
        $this->db->join('booking_detail', 'booking_detail.booking_id = booking.id', 'left');
        $this->db->join('produk', 'produk.id = booking_detail.produk_id', 'left');
        $this->db->join('review', 'review.booking_id = booking.id', 'left');
        $this->db->where('booking.user_id', $user_id);
        $this->db->group_by('booking.id');
        $this->db->order_by('booking.created_at', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        $this->expire_pending();
        $this->db->select('booking.*, users.nama as nama_user, users.email');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = booking.user_id');
        $this->db->where('booking.id', $id);
        return $this->db->get()->row();
    }

    /**
     * Cek apakah produk tersedia di rentang tanggal tertentu.
     * Mencegah double booking.
     */
    public function cek_ketersediaan($produk_id, $tanggal_mulai, $tanggal_selesai, $exclude_booking_id = null)
    {
        return $this->get_reserved_qty($produk_id, $tanggal_mulai, $tanggal_selesai, $exclude_booking_id);
    }

    public function get_reserved_qty($produk_id, $tanggal_mulai, $tanggal_selesai, $exclude_booking_id = null)
    {
        $this->expire_pending();
        $this->db->select('COALESCE(SUM(booking_detail.qty), 0) as total_qty');
        $this->db->from('booking_detail');
        $this->db->join('booking', 'booking.id = booking_detail.booking_id');
        $this->db->where('booking_detail.produk_id', $produk_id);
        $this->db->where_in('booking.status', ['pending', 'confirmed', 'dipinjam']);
        $this->db->where('booking.tanggal_mulai <', $tanggal_selesai);
        $this->db->where('booking.tanggal_selesai >', $tanggal_mulai);
        if ($exclude_booking_id) {
            $this->db->where('booking.id !=', $exclude_booking_id);
        }
        $result = $this->db->get()->row();
        return (int) $result->total_qty;
    }

    public function create($data)
    {
        if (empty($data['deadline_bayar'])) {
            $data['deadline_bayar'] = date('Y-m-d H:i:s', strtotime('+1 day'));
        }
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_status($id, $status)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, ['status' => $status]);
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function count_by_status($status)
    {
        $this->expire_pending();
        return $this->db->where('status', $status)->count_all_results($this->table);
    }

    public function get_recent($limit = 5)
    {
        $this->expire_pending();
        $this->db->select('booking.*, users.nama as nama_user');
        $this->db->from($this->table);
        $this->db->join('users', 'users.id = booking.user_id');
        $this->db->order_by('booking.created_at', 'DESC');
        $this->db->limit($limit);
        return $this->db->get()->result();
    }
}
