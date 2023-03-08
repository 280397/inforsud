<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Kategori"
        );
        $this->load->view('kategori/kategori_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Kategori_model->json();
    }

    public function read($id)
    {
        $row = $this->Kategori_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
            );
            $this->load->view('satuan/tb_satuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Satuan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('Kategori/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
        );
        $this->load->view('kategori/kategori_data', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->Kategori_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('Kategori'));
        }
    }

    public function update($id)
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $data = array(
                'title' => 'Kategori',
                'page' => 'Update Kategori',
                'button' => 'Update',
                'action' => site_url('Kategori/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
            );
            // $this->load->view('satuan/tb_satuan_form', $data);
            $this->load->view('kategori/kategori_edit', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Kategori'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
            );

            $this->Kategori_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('Kategori'));
        }
    }

    public function delete($id)
    {
        $row = $this->Kategori_model->get_by_id($id);

        if ($row) {
            $this->Kategori_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Kategori'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Kategori'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
