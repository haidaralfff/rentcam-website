<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
    protected $table = 'produk';

    public function get_all($filters = [])
    {
        $this->db->select($this->table . '.*');
        $this->db->select('(SELECT ROUND(AVG(rating), 1) FROM review WHERE review.produk_id = ' . $this->table . '.id) as avg_rating');
        $this->db->select('(SELECT COUNT(id) FROM review WHERE review.produk_id = ' . $this->table . '.id) as total_review');
        
        if (!empty($filters['kategori'])) {
            $this->db->where('kategori', $filters['kategori']);
        }
        if (!empty($filters['status'])) {
            $this->db->where('status', $filters['status']);
        }
        if (!empty($filters['search'])) {
            $this->db->like('nama', $filters['search']);
        }
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result();
    }

    public function get_tersedia()
    {
        return $this->db->where('status', 'tersedia')
                        ->where('stok >', 0)
                        ->order_by('created_at', 'DESC')
                        ->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
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

    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    public function kurangi_stok($id, $qty)
    {
        $this->db->set('stok', 'stok - ' . (int)$qty, FALSE);
        $this->db->where('id', $id);
        $this->db->where('stok >=', (int)$qty); // Mencegah stok minus
        return $this->db->update($this->table);
    }

    public function tambah_stok($id, $qty)
    {
        $this->db->set('stok', 'stok + ' . (int)$qty, FALSE);
        $this->db->where('id', $id);
        return $this->db->update($this->table);
    }

    public function count_all()
    {
        return $this->db->count_all($this->table);
    }

    public function get_avg_rating($produk_id)
    {
        $this->db->select_avg('rating', 'avg_rating');
        $this->db->where('produk_id', $produk_id);
        $result = $this->db->get('review')->row();
        return $result ? round($result->avg_rating, 1) : 0;
    }
}
