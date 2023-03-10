<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poli_model extends CI_Model
{

    public $table = 'poli';
    public $id = 'id';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // datatables
    function json()
    {
        $this->datatables->select('p.id,p.nama_poli,p.keterangan,p.jam_buka, p.jam_tutup');
        $this->datatables->from('poli as p');
        $this->datatables->add_column('action', anchor(site_url('Poli/update/$1'), '<div class="badge badge-warning">Update</div>') .  anchor(site_url('Poli/delete/$1'), '<div class="badge badge-danger">Delete</div>', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
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
        $this->db->or_like('nama_poli', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('jam_buka', $q);
        $this->db->or_like('jam_tutup', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama_poli', $q);
        $this->db->or_like('keterangan', $q);
        $this->db->or_like('jam_buka', $q);
        $this->db->or_like('jam_tutup', $q);
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
