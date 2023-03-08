<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Artikel extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('Artikel_model');
        $this->load->model('Kategori_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $data = array(
            'title' => "Data Artikel"
        );
        $this->load->view('artikel/artikel_data', $data);
    }

    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Artikel_model->json();
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
            'title' => 'Artikel',
            'page' => 'Artikel',
            'action' => site_url('Artikel/create_action'),
            'id' => set_value('id'),
            'kate_all' => $this->Kategori_model->get_all(),
            'judul' => set_value('judul'),
            'isi' => set_value('isi'),
            'img_sampul' => set_value('img_sampul'),
        );
        $this->load->view('artikel/artikel_form', $data);
    }

    public function create_action()
    {
        $this->_rules();



        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/artikel/';
            $config['file_name']   = 'artikel -' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['sampul']['name'] != null) {

                if ($this->upload->do_upload('sampul')) {
                    $data = array(
                        'kategori' => $this->input->post('kategori', TRUE),
                        'judul' => $this->input->post('judul', TRUE),
                        'isi' => $this->input->post('isi', TRUE),
                        'sampul' => $this->upload->data('file_name')
                    );
                    $this->Artikel_model->insert($data);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Artikel');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan</div>');
                    redirect('Artikel/create');
                }
            } else {


                $this->Artikel_model->insert($data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Artikel');
            }
        }
    }

    public function update($id)
    {
        $row = $this->Artikel_model->get_by_id($id);
        $kate_all = $this->Kategori_model->get_all();

        if ($row) {
            $data = array(
                'button' => 'Update',
                'title' => 'Update',
                'page' => 'Artikel',
                'action' => site_url('Artikel/update_action'),
                'id' => set_value('id', $row->id),
                'kategori' => set_value('kategori', $row->kategori),
                'kate_all' => $kate_all,
                'judul' => set_value('judul', $row->judul),
                'isi' => set_value('isi', $row->isi),
                'sampul' => set_value('sampul', $row->sampul),
            );
            $this->load->view('artikel/artikel_form', $data);
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

            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']      = '2048';
            $config['upload_path']   = './gambar/artikel/';
            $config['file_name']   = 'artikel-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
            $this->load->library('upload', $config);

            if (@$_FILES['sampul']['name'] != null) {
                if ($this->upload->do_upload('sampul')) {

                    //replace image
                    $cari = $this->Artikel_model->get_by_id($this->input->post('id', TRUE));
                    // var_dump($cari)
                    if ($cari->sampul != null) {
                        $target_file = './gambar/artikel/' . $cari->sampul;
                        unlink($target_file);
                    }

                    $data = array(
                        'kategori' => $this->input->post('kategori', TRUE),
                        'judul' => $this->input->post('judul', TRUE),
                        'isi' => $this->input->post('isi', TRUE),
                        'sampul' => $this->upload->data('file_name')
                    );
                    $this->Artikel_model->update($this->input->post('id', TRUE), $data);

                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                    }
                    redirect('Artikel');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error! Data tidak tersimpan!</div>');
                    redirect('Artikel/update/' . $this->input->post('id', TRUE));
                }
            } else {
                $data = array(
                    'kategori' => $this->input->post('kategori', TRUE),
                    'judul' => $this->input->post('judul', TRUE),
                    'isi' => $this->input->post('isi', TRUE),
                );
                $this->Artikel_model->update($this->input->post('id', TRUE), $data);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                }
                redirect('Artikel');
            }
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
        $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
        $this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
        $this->form_validation->set_rules('isi', 'isi', 'trim');
        $this->form_validation->set_rules('img_sampul', 'img_sampul', 'trim');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}
