<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layanan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Layanan_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Layanan"
        );
        $this->load->view('Layanan/Layanan_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Layanan_model->json();
    }


    public function create()
    {
        $data = array(
            'button' => 'Create',
            'title' => 'Layanan',
            'page' => 'Layanan',
            'action' => site_url('Layanan/create_action'),
            'id' => set_value('id'),
            'judul' => set_value('judul'),
            'ket' => set_value('ket'),
            'img' => set_value('img'),
        );
        $this->load->view('Layanan/Layanan_form', $data);
    }

    public function create_action()
    {
        $this->_rules();



        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/layanan/';
            $config['file_name']   = 'layanan -' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img']['name'] != null) {

                if ($this->upload->do_upload('img')) {
                    $data = array(
                        'judul' => $this->input->post('judul', TRUE),
                        'ket' => $this->input->post('ket', TRUE),
                        'img' => $this->upload->data('file_name')
                    );
                    $this->Layanan_model->insert($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Layanan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
                    redirect('Layanan/create');
                }
            } else {
                $data = array(
                    'judul' => $this->input->post('judul', TRUE),
                    'ket' => $this->input->post('ket', TRUE),
                );

                $this->Layanan_model->insert($data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Layanan');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'title' => 'Update',
                'page' => 'Layanan',
                'action' => site_url('Layanan/update_action'),
                'id' => set_value('id', $row->id),
                'judul' => set_value('judul', $row->judul),
                'ket' => set_value('ket', $row->ket),
                'img' => set_value('img', $row->img),
            );
            $this->load->view('Layanan/Layanan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Layanan'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/layanan/';
            $config['file_name']   = 'Layanan-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['img']['name'] != null) {
                if ($this->upload->do_upload('img')) {

                    //replace image
                    $cari = $this->Layanan_model->get_by_id($this->input->post('id', TRUE));
                    // var_dump($cari)
                    if ($cari->img != null) {
                        $target_file = './gambar/layanan/' . $cari->img;
                        unlink($target_file);
                    }

                    $data = array(
                        'judul' => $this->input->post('judul', TRUE),
                        'ket' => $this->input->post('ket', TRUE),
                        'img' => $this->upload->data('file_name')
                    );
                    $this->Layanan_model->update($this->input->post('id', TRUE), $data);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Layanan');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
                    redirect('Layanan/update/' . $this->input->post('id', TRUE));
                }
            } else {
                $data = array(
                    'judul' => $this->input->post('judul', TRUE),
                    'ket' => $this->input->post('ket', TRUE),
                );
                $this->Layanan_model->update($this->input->post('id', TRUE), $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Layanan');
            }
        }
    }

    public function delete($id)
    {
        $row = $this->Layanan_model->get_by_id($id);

        if ($row) {
            $this->Layanan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('Layanan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('Layanan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('ket', 'ket', 'trim');
        $this->form_validation->set_rules('img', 'img', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
