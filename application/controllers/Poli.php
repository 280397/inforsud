<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Poli extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Poli_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Poli",
            'action' => site_url('Poli/create_action'),
        );
        $this->load->view('poli/poli_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Poli_model->json();
    }

    // public function read($id)
    // {
    //     $row = $this->Stok_model->get_by_id($id);
    //     if ($row) {
    //         $data = array(
    //             'id' => $row->id,
    //             'kode_barang' => $row->kode_barang,
    //             'stok' => $row->stok,
    //             'id_ruang' => $row->id_ruang,
    //         );
    //         $this->load->view('stok/tb_stok_read', $data);
    //     } else {
    //         $this->session->set_flashdata('message', 'Record Not Found');
    //         redirect(site_url('Stok'));
    //     }
    // }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'title' => 'Poli',
            'page' => 'Poli',
            'action' => site_url('Poli/create_action'),
            'poli_all' => $this->Poli_model->get_all(),
            'id' => set_value('id'),
            'nama_poli' => set_value('nama_poli'),
            'keterangan' => set_value('keterangan'),
            'jam_buka' => set_value('jam_buka'),
            'jam_tutup' => set_value('jam_tutup'),
        );
        $this->load->view('poli/poli_data', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->index();
        } else {

            $data = array(
                'nama_poli' => $this->input->post('nama_poli', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'jam_buka' => $this->input->post('jam_buka', TRUE),
                'jam_tutup' => $this->input->post('jam_tutup', TRUE),
            );

            $this->Poli_model->insert($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect(site_url('Poli'));
        }
    }

    public function update($id)
    {
        $row = $this->Poli_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'title' => 'Update Poli',
                'page' => 'Poli',
                'action' => site_url('Poli/update_action'),
                'id' => set_value('id', $row->id),
                'nama_poli' => set_value('nama_poli', $row->nama_poli),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'jam_buka' => set_value('jam_buka', $row->jam_buka),
                'jam_tutup' => set_value('jam_tutup', $row->jam_tutup),
            );
            $this->load->view('poli/poli_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Artikel'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {

            $data = array(
                'nama_poli' => $this->input->post('nama_poli', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'jam_buka' => $this->input->post('jam_buka', TRUE),
                'jam_tutup' => $this->input->post('jam_tutup', TRUE),
            );

            $this->Poli_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect(site_url('Poli'));
        }
    }

    public function delete($id)
    {
        $row = $this->Poli_model->get_by_id($id);

        if ($row) {
            $this->Poli_model->delete($id);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect(site_url('Poli'));
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
            redirect(site_url('Poli'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama_poli', 'nama_poli', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('jam_buka', 'jam_buka', 'trim|required');
        $this->form_validation->set_rules('jam_tutup', 'jam_tutup', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
