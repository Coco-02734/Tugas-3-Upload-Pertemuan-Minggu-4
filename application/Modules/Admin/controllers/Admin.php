<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    // public function __construct()
    // {
    //     parent::__construct();
    //     is_logged_in();
    // }

    public function index()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('Admin/index', $data);
        $this->load->view('template/footer');
    }

    public function inputproduk()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->db->get('kategori')->result_array();
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('Admin/input', $data);
        $this->load->view('template/footer');
    }

    public function upload()
    {
        $user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data = [
            'id_user' => $user['id'],
            'nama_produk' => $this->input->post('namaproduk'),
            'harga' => $this->input->post('harga'),
            'stok' => $this->input->post('stok'),
            'id_kategori' => $this->input->post('id_kategori'),
            'keterangan' => $this->input->post('keterangan'),
            'aktif' => $this->input->post('aktif'),
            'date_created' => time(),
            'date_updated' => time(),
        ];

        $upload_gambar = $_FILES['foto']['name'];

        if ($upload_gambar) {
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_size']     = '500000';
            $config['upload_path'] = './assets/img/foto_produk/';

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {

                $new_gambar = $this->upload->data('file_name');
                $this->db->set('gambar', $new_gambar);
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Maksimal Berkas 200Mb </div>');
            }
        }

        $this->db->insert('produk', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Produk Berhasil Ditambahkan</div>');
        redirect('admin/daftarprodukl');
    }

    public function daftarprodukl()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->db->get_where('produk', ['id_user' => $data['user']['id']])->result_array();

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('template/topbar', $data);
        $this->load->view('Admin/produk', $data);
        $this->load->view('template/footer');
    }
}
