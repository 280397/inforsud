<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stok extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Stok_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        // $this->load->view('frontend/index');
    }

    public function json()
    {
        header('Content-Type: application/json');
        $id = $this->fungsi->user_login()->id_ruang;
        if ($id == 1) {
            # code...
            echo $this->Stok_model->json();
        } else {
            echo $this->Stok_model->json($id);
        }
    }

    public function read($id)
    {
        $row = $this->Stok_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'kode_barang' => $row->kode_barang,
                'stok' => $row->stok,
                'id_ruang' => $row->id_ruang,
            );
            $this->load->view('stok/tb_stok_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Stok'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Stok/create_action'),
            'id' => set_value('id'),
            'kode_barang' => set_value('kode_barang'),
            'stok' => set_value('stok'),
            'id_ruang' => set_value('id_ruang'),
        );
        $this->load->view('stok/tb_stok_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
            );

            $this->Stok_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Stok'));
        }
    }

    public function update($id)
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('Stok/update_action'),
                'id' => set_value('id', $row->id),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'stok' => set_value('stok', $row->stok),
                'id_ruang' => set_value('id_ruang', $row->id_ruang),
            );
            $this->load->view('stok/tb_stok_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Stok'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'id_ruang' => $this->input->post('id_ruang', TRUE),
            );

            $this->Stok_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Stok'));
        }
    }

    public function delete($id)
    {
        $row = $this->Stok_model->get_by_id($id);

        if ($row) {
            $this->Stok_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Stok'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Stok'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
        $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('id_ruang', 'id ruang', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Stok.php */
/* Location: ./application/controllers/Stok.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-06-06 03:21:36 */
/* http://harviacode.com */