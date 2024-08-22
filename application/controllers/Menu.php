<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Controller menu ini isinya ambil aja dari controller yang sudah ada seperti controller user, ubah nama class nya jadi Menu
class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        $this->load->model('Menu_model');
    }


    public function index()
    {

        $data['title'] = 'Menu Management'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data

        // Query data menunya
        $data['menu'] = $this->db->get('master_user_menu')->result_array();

        $this->form_validation->set_rules('menu', 'Menu', 'required'); //Set rules menunya

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('menu/index', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $this->db->insert('master_user_menu', ['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Menu Added! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) menu berhasil ditambahkan
            redirect('menu'); //dilempar kembali ke halaman menu
        }
    }

    public function submenu()
    {
        $data['title'] = 'Sub Menu Management'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data
        $this->load->model('Menu_model', 'menu');

        $data['subMenu'] = $this->menu->getSubMenu();
        $data['menu'] = $this->db->get('master_user_menu')->result_array();

        // Set rules sub menunya dari title sampai icon, is_active gak perlu
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('menu_id', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('menu/submenu', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'menu_id' => $this->input->post('menu_id'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active' => $this->input->post('is_active')
            ];
            $this->db->insert('master_user_sub_menu', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Submenu Added! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) menu berhasil ditambahkan
            redirect('menu/submenu'); //dilempar kembali ke halaman submenu
        }
    }

    public function delete($id)
    {
        $this->Menu_model->deleteMenu($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Menu berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('menu');
    }
}
