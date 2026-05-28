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
        $this->db->select('booking.*, MAX(pembayaran.status) as status_bayar, MAX(review.id) as review_id, MAX(booking_detail.produk_id) as produk_id, GROUP_CONCAT(produk.nama SEPARATOR ", ") as nama_produk, GROUP_CONCAT(produk.foto SEPARATOR ", ") as foto_produk');
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

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        // Delete related records to prevent orphan data
        $this->db->where('booking_id', $id)->delete('review');
        $this->db->where('booking_id', $id)->delete('pembayaran');
        $this->db->where('booking_id', $id)->delete('booking_detail');
        $this->db->where('id', $id)->delete($this->table);
        return true;
    }

    /**
     * Hitung stok yang benar-benar tersedia setelah dikurangi booking yang sedang aktif.
     */
    public function get_available_stok($produk_id, $tanggal_mulai, $tanggal_selesai)
    {
        $this->load->model('Produk_model');
        $produk = $this->Produk_model->get_by_id($produk_id);
        if (!$produk) return 0;

        $reserved = $this->get_reserved_qty($produk_id, $tanggal_mulai, $tanggal_selesai);
        return max(0, $produk->stok - $reserved);
    }

    /**
     * Menyimpan booking dan detail dalam satu transaksi (Atomic).
     */
    public function place_booking($booking_data, $detail_data)
    {
        $this->db->trans_start();

        // 1. Insert Header
        if (empty($booking_data['deadline_bayar'])) {
            $booking_data['deadline_bayar'] = date('Y-m-d H:i:s', strtotime('+1 day'));
        }
        $this->db->insert($this->table, $booking_data);
        $booking_id = $this->db->insert_id();

        // 2. Insert Detail
        $detail_data['booking_id'] = $booking_id;
        $this->db->insert('booking_detail', $detail_data);

        $this->db->trans_complete();

        return ($this->db->trans_status() === FALSE) ? false : $booking_id;
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
