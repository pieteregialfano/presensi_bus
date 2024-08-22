<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Dashboard';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data


        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('admin/index', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data

        $data['role'] = $this->db->get('master_role')->result_array();

        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('admin/role', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    public function roleAccess($role_id)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data

        $data['role'] = $this->db->get_where('master_role', ['id' => $role_id])->row_array();

        $this->db->where('id !=', 1);
        $data['menu'] = $this->db->get('master_user_menu')->result_array();

        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('admin/role-access', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    public function changeAccess()
    {
        $menu_id = $this->input->post('menu_id');
        $role_id = $this->input->post('role_id');

        $data = [
            'role_id' => $role_id,
            'menu_id' => $menu_id
        ];
        $result = $this->db->get_where('master_user_access_menu', $data);

        if ($result->num_rows() < 1) {
            $this->db->insert('master_user_access_menu', $data);
        } else {
            $this->db->delete('master_user_access_menu', $data);
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Access Changed!</div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
    }
}
