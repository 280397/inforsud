<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artikel_model extends CI_Model
{

    public $table = 'artikel';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('a.id, k.nama as kategori, a.judul, a.isi, a.sampul');
        $this->datatables->from('artikel as a');
        //add this line for join
        $this->datatables->join('kategori as k', 'k.id = a.kategori');
        $this->datatables->add_column('action', anchor(site_url('Artikel/update/$1'), '<div class="badge badge-warning">Update</div>') .  anchor(site_url('Artikel/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');

        return $this->datatables->generate();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('kategori', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('isi', $q);
        $this->db->or_like('img_sampul', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('kategori', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('isi', $q);
        $this->db->or_like('img_sampul', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}
