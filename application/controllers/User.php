<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Menu_model');
        $this->load->library('Pdf');
    }

    // Controller untuk menampilkan my profil
    public function index()
    {

        $data['title'] = 'My Profile';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data


        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('user/index', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    // Controller menu edit profil pengguna
    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();
        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');
        $this->form_validation->set_rules('address', 'Address', 'required|trim');
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_edit_profile', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $phone_number = $this->input->post('phone_number');
            $email = $this->input->post('email');

            // Check if there's a file to upload
            if (!empty($_FILES['image']['name'])) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . '/assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    // Display upload errors
                    echo $this->upload->display_errors();
                    return;
                }
            }

            $this->db->set('email', $email);
            $this->db->set('name', $name);
            $this->db->set('address', $address);
            $this->db->set('phone_number', $phone_number);
            $this->db->where('email', $email);
            $this->db->update('master_user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your profile has been updated! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('user');
        }
    }

    // Controller menu ubah password akun 
    public function changePassword()
    {

        $data['title'] = 'Change Password';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_change_password', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Current Password! </div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
                redirect('user/changepassword'); //setelah berhasil, dilempar kembali ke halaman login
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password cannot be the same as current password! </div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
                    redirect('user/changepassword'); //setelah berhasil, dilempar kembali ke halaman login
                } else {
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('master_user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been changed! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
                    redirect('user/changepassword'); //setelah berhasil, dilempar kembali ke halaman login
                }
            }
        }
    }
    // =============================================================================================================================================






    // =============================================================================================================================================
    // BAGIAN MELAKUKAN PRESENSI
    // Controller menu presensi setelah klik tombol "Add presensi bus"
    public function presensi()
    {
        $data['title'] = 'Presensi Bus Antar Jemput Karyawan'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data

        // Mendapatkan data dari model Menu_model
        $data['denda_reasons'] = $this->Menu_model->getDendaReasons();

        // Paginationnya
        $this->load->library('pagination');

        // Config
        $config['base_url'] = 'http://localhost/miniproject/user/presensi';

        $data['start'] = $this->uri->segment(3);
        $data['presensi'] = $this->Menu_model->getPresensi();
        $data['no_bus_list'] = $this->Menu_model->getNoBusList();

        // Set rules presensinya
        $this->form_validation->set_rules('no_bus', 'No. Bus', 'required');
        $this->form_validation->set_rules('per_oto_bus', 'Per. Oto Bus', 'required');
        $this->form_validation->set_rules('type_bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('route', 'Route', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required|trim');
        $this->form_validation->set_rules('tgl_presensi', 'Tanggal Presensi', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required');
        // $this->form_validation->set_rules('jml_pnp', 'Jumlah Penumpang', 'required|less_than[60]');
        // $this->form_validation->set_rules('ket_denda', 'Keterangan Denda', 'required');
        // $this->form_validation->set_rules('jml_denda', 'Jumlah Denda', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_bus_presensi', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $userData = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();
            $no_transaksi = $this->generateNoTransaksi();
            $data = [
                'no_transaksi' => $no_transaksi,
                'jum_rit' => 1,
                'no_bus' => $this->input->post('no_bus'),
                'per_oto_bus' => $this->input->post('per_oto_bus'),
                'type_bus' => $this->input->post('type_bus'),
                'route' => $this->input->post('route'),
                'no_polisi' => $this->input->post('no_polisi'),
                'shift' => $this->input->post('shift'),
                'tgl_presensi' => $this->input->post('tgl_presensi'),
                'tgl_masuk' => $this->input->post('tgl_masuk'),
                'jam_masuk' => $this->input->post('jam_masuk'),
                'tgl_keluar' => $this->input->post('tgl_keluar'),
                'jam_keluar' => $this->input->post('jam_keluar'),
                'create_by' => $userData['name'],
                'jml_pnp' => $this->input->post('jml_pnp'),
                'ket_denda' => $this->input->post("ket_denda"),
                'jml_denda' => $this->input->post('jml_denda'),
                'ket' => $this->input->post('ket')
            ];
            $this->Menu_model->insertPresensi($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

            redirect('user/presensi');
        }
    }

    // Fungsi untuk generate nomor transaksi
    private function generateNoTransaksi()
    {
        // Generate angka random ribuan (contoh)
        $random_number = rand(1000, 9999);

        // Cek apakah nomor transaksi sudah ada di database
        $existing_no_transaksi = $this->Menu_model->getPresensiByNoTransaksi($random_number);

        // Jika nomor transaksi sudah ada, generate ulang
        while ($existing_no_transaksi) {
            $random_number = rand(1000, 9999);
            $existing_no_transaksi = $this->Menu_model->getPresensiByNoTransaksi($random_number);
        }

        return $random_number;
    }

    // Controller edit presensi
    public function edit_presensi($no_transaksi)
    {
        $data['denda_reasons'] = $this->Menu_model->getDendaReasons();
        // Set rules presensinya
        $this->form_validation->set_rules('no_bus', 'No. Bus', 'required');
        $this->form_validation->set_rules('per_oto_bus', 'Per. Oto Bus', 'required');
        $this->form_validation->set_rules('type_bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('route', 'Route', 'required');
        $this->form_validation->set_rules('shift', 'Shift', 'required');
        $this->form_validation->set_rules('tgl_presensi', 'Tanggal Presensi', 'required');
        $this->form_validation->set_rules('tgl_masuk', 'Tanggal Masuk', 'required');
        $this->form_validation->set_rules('jam_masuk', 'Jam Masuk', 'required');
        $this->form_validation->set_rules('tgl_keluar', 'Tanggal Keluar', 'required');
        $this->form_validation->set_rules('jam_keluar', 'Jam Keluar', 'required');
        $this->form_validation->set_rules('jml_pnp', 'Jumlah Penumpang', 'required|less_than[60]');
        $this->form_validation->set_rules('ket_denda', 'Keterangan Denda', 'required');
        $this->form_validation->set_rules('jml_denda', 'Jumlah Denda', 'required');
        $this->form_validation->set_rules('ket', 'Keterangan', 'required');

        $this->Menu_model->edit_presensi($no_transaksi);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/presensi');
    }


    // Controller menampilkan detail dari data presensi
    public function detail_presensi($id)
    {
        $data['presensi'] = $this->Menu_model->getdetailPresensi('id');
        $data['denda_reasons'] = $this->Menu_model->getDendaReasons();

        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('user/master_bus_presensi', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    public function delete($id)
    {

        $this->Menu_model->deletePresensi($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presensi berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/presensi');
        // Lalu, dalam tampilan HTML, Anda dapat menangani SweetAlert dengan JavaScript
    }

    // Bagian Ambil Data, Autofill per_oto_bus, type_bus, route
    public function get_bus_info()
    {
        $no_bus = $this->input->post('no_bus');
        $bus_info = $this->Menu_model->getBusInfo($no_bus);

        if ($bus_info) {
            echo json_encode($bus_info);
        } else {
            echo json_encode(false);
        }
    }

    // Memanggil nilai jumlah denda sesuai dengan reason yang dipilih
    public function get_jumlah_denda()
    {
        $reason = $this->input->post('reason');
        $jumlah_denda = $this->Menu_model->getJumlahDenda($reason);

        // Mengirim jumlah denda sebagai respons AJAX
        echo json_encode($jumlah_denda);
    }
    // =============================================================================================================================================



    // =============================================================================================================================================
    // Bagian Tambah & Hapus denda
    public function master_denda()
    {
        $data['title'] = 'Tambah dan Hapus Denda'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data
        $data['denda'] = $this->Menu_model->getdetailDenda();

        // Paginationnya
        $this->load->library('pagination');

        // Config
        $config['base_url'] = 'http://localhost/miniproject/user/master_denda';

        $data['start'] = $this->uri->segment(3);

        $this->form_validation->set_rules('reason', 'Reason', 'required|trim'); //Set rules menunya
        $this->form_validation->set_rules('denda', 'Jumlah Denda', 'required'); //Set rules menunya

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_denda', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $data = [
                'reason' => $this->input->post('reason'),
                'denda' => $this->input->post('denda')
            ];
            $this->db->insert('bus_denda', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New Denda Added! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) menu berhasil ditambahkan
            redirect('user/master_denda'); //dilempar kembali ke halaman submenu
        }
    }

    // Controller edit denda
    public function edit_denda($id)
    {
        $data['title'] = 'Edit Denda'; //Judulnya disesuaikan aja
        // Set rules presensinya
        $this->form_validation->set_rules('reason', 'Reason', 'required|trim');
        $this->form_validation->set_rules('denda', 'Jumlah Denda', 'required');

        // Validasi berhasil, proses penyuntingan data denda
        $this->Menu_model->editDenda($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/master_denda');
    }

    public function delete_denda($id)
    {
        $this->Menu_model->deleteDenda($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Denda berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/master_denda');
        // Lalu, dalam tampilan HTML, Anda dapat menangani SweetAlert dengan JavaScript
    }
    // ======================================================================================================================



    // ======================================================================================================================
    // Bagian Master Bus
    public function master_bus()
    {
        $data['title'] = 'Vendor Po.Bus'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();

        //ambil data dari tabel master_data
        $data['po_bus'] = $this->Menu_model->getPoBus();

        // Paginationnya
        $this->load->library('pagination');

        // Config
        $config['base_url'] = 'http://localhost/miniproject/user/master_denda';

        $data['start'] = $this->uri->segment(3);

        $this->form_validation->set_rules('no_bus_vendor', 'No. Bus', 'required|callback_check_no_bus');
        $this->form_validation->set_rules('per_oto_bus', 'Per. Oto Bus', 'required');
        $this->form_validation->set_rules('valid_from', 'Valid From', 'required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'required');
        $this->form_validation->set_rules('pc', 'PC Bus', 'required');
        $this->form_validation->set_rules('type_bus', 'Tipe Bus', 'required');
        $this->form_validation->set_rules('route', 'Route Bus', 'required');
        $this->form_validation->set_rules('jum_rit_b', 'Jumlah Rit/Bln', 'required');
        $this->form_validation->set_rules('jum_hk', 'Jumlah Hari Kerja', 'required');
        $this->form_validation->set_rules('hrg_sewa', 'Harga Sewa Kendaraan', 'required');
        $this->form_validation->set_rules('kap_bus', 'Kapasitas Penumpang', 'required');
        $this->form_validation->set_rules('jum_pnp', 'Jumlah Penumpang', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_egm', 'Jumlah Penumpang EGM', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mgc', 'Jumlah Penumpang MGC', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mkr', 'Jumlah Penumpang MKR', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mgf', 'Jumlah Penumpang MGF', 'required|numeric');

        // Tambahkan aturan validasi khusus untuk jumlah penumpang total
        $this->form_validation->set_rules('total_pnp', 'Total Jumlah Penumpang', 'callback_validate_total_pnp');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_bus', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            $data = [
                'no_bus_vendor' => $this->input->post('no_bus_vendor'),
                'per_oto_bus' => $this->input->post('per_oto_bus'),
                'valid_from' => $this->input->post('valid_from'),
                'valid_to' => $this->input->post('valid_to'),
                'deletion' => $this->input->post('deletion'),
                'pc' => $this->input->post('pc'),
                'type_bus' => $this->input->post('type_bus'),
                'route' => $this->input->post('route'),
                'jum_rit_b' => $this->input->post('jum_rit_b'),
                'jum_hk' => $this->input->post('jum_hk'),
                'hrg_sewa' => $this->input->post('hrg_sewa'),
                'no_polisi' => $this->input->post('no_polisi'),
                'kap_bus' => $this->input->post('kap_bus'),
                'jum_pnp' => $this->input->post("jum_pnp"),
                'jum_pnp_egm' => $this->input->post('jum_pnp_egm'),
                'jum_pnp_mgc' => $this->input->post('jum_pnp_mgc'),
                'jum_pnp_mkr' => $this->input->post('jum_pnp_mkr'),
                'jum_pnp_mgf' => $this->input->post('jum_pnp_mgf'),
                'ppn' => $this->input->post('ppn')
            ];
            $this->db->insert('bus_master', $data);
            $this->db->order_by('per_oto_bus, desc');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">New PO.Bus Added! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) menu berhasil ditambahkan
            redirect('user/master_bus'); //dilempar kembali ke halaman submenu
        }
    }

    //Validasi total penumpang mi,mgc,mkr, mgf tidak boleh melebihi jumlah penumpang yang sudah diinputkan
    public function validate_total_pnp()
    {
        $jum_pnp = $this->input->post('jum_pnp');
        $jum_pnp_egm = $this->input->post('jum_pnp_egm');
        $jum_pnp_mgc = $this->input->post('jum_pnp_mgc');
        $jum_pnp_mkr = $this->input->post('jum_pnp_mkr');
        $jum_pnp_mgf = $this->input->post('jum_pnp_mgf');

        // Hitung total jumlah penumpang
        $total_pnp = $jum_pnp_egm + $jum_pnp_mgc + $jum_pnp_mkr + $jum_pnp_mgf;

        // Pemeriksaan apakah total melebihi jumlah penumpang utama
        if ($total_pnp > $jum_pnp) {
            $this->form_validation->set_message('validate_total_pnp', 'Total Jumlah Penumpang EGM, MGC, MKR, dan MGF tidak boleh melebihi Jumlah Penumpang utama.');
            return false;
        }
        return true;
    }

    // Validasi jika no bus yang ingin didaftarkan sama, maka harus mencari no bus yang berbeda
    public function check_no_bus($no_bus)
    {
        $existing_no_bus = $this->Menu_model->checkNoBusExists($no_bus);

        if ($existing_no_bus) {
            $this->form_validation->set_message('check_no_bus', 'Nomor Bus sudah terdaftar. Silakan gunakan Nomor Bus yang lain.');
            return false;
        }

        return true;
    }


    public function edit_po_bus($id)
    {
        $data['title'] = 'Edit PO. Bus'; //Judulnya disesuaikan aja
        // Set rules presensinya
        $this->form_validation->set_rules('no_bus_vendor', 'No. Bus', 'required');
        $this->form_validation->set_rules('per_oto_bus', 'Per. Oto Bus', 'required');
        $this->form_validation->set_rules('valid_from', 'Valid From', 'required');
        $this->form_validation->set_rules('valid_to', 'Valid To', 'required');
        $this->form_validation->set_rules('pc', 'PC Bus', 'required');
        $this->form_validation->set_rules('type_bus', 'Tipe Bus', 'required');
        $this->form_validation->set_rules('route', 'Route Bus', 'required');
        $this->form_validation->set_rules('jum_rit_b', 'Jumlah Rit/Bln', 'required');
        $this->form_validation->set_rules('jum_hk', 'Jumlah Hari Kerja', 'required');
        $this->form_validation->set_rules('hrg_sewa', 'Harga Sewa Kendaraan', 'required');
        $this->form_validation->set_rules('kap_bus', 'Kapasitas Penumpang', 'required');
        $this->form_validation->set_rules('jum_pnp', 'Jumlah Penumpang', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_egm', 'Jumlah Penumpang EGM', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mgc', 'Jumlah Penumpang MGC', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mkr', 'Jumlah Penumpang MKR', 'required|numeric');
        $this->form_validation->set_rules('jum_pnp_mgf', 'Jumlah Penumpang MGF', 'required|numeric');
        $this->form_validation->set_rules('total_pnp', 'Total Jumlah Penumpang', 'callback_validate_total_pnp');

        // Validasi berhasil, proses penyuntingan data denda
        $this->Menu_model->editPoBus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/master_bus');
    }

    public function delete_po_bus($id)
    {
        $this->Menu_model->deletePoBus($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data PO. BUS berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/master_bus');
        // Lalu, dalam tampilan HTML, Anda dapat menangani SweetAlert dengan JavaScript
    }

    // Controller menampilkan detail dari data presensi
    public function detail_po_bus($id)
    {
        $data['po_bus'] = $this->Menu_model->getdetailPoBus('id');

        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('user/master_bus', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }
    // =============================================================================================================================================




    // =============================================================================================================================================
    // Bagian Cetak Laporan
    public function cetak_laporan()
    {
        $data['title'] = 'Cetak Laporan Tagihan';
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();

        $per_oto_bus = $this->input->post('per_oto_bus');
        $type_bus = $this->input->post('type_bus');
        // Mengambil data perusahaan oto bus dari database master_data_bus
        // Yang ada di dalam $data[yang dalem sini harus sama dengan foreach yang dipakai di views nya]
        $data['per_oto_bus'] = $this->Menu_model->getPerusahaanBus($per_oto_bus); // Buat method getPerusahaanBus di Menu_model
        $data['type_bus'] = $this->Menu_model->getTypeBus($type_bus); // Buat method getPerusahaanBus di Menu_model

        // Pagination dan data presensi
        $this->load->library('pagination');
        $config['base_url'] = 'http://localhost/miniproject/user/presensi';
        $data['start'] = $this->uri->segment(3);
        $data['presensi'] = $this->Menu_model->getCetakPresensi();
        $data['no_bus_list'] = $this->Menu_model->getNoBusList();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/master_cetak_tagihan', $data);
        $this->load->view('templates/footer');
    }

    public function get_filtered_presensi()
    {
        $per_oto_bus = $this->input->post('per_oto_bus');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $type_bus = $this->input->post('type_bus');
        $filtered_presensi = $this->Menu_model->getPresensiFiltered($per_oto_bus, $date_from, $date_to, $type_bus);
        $filtered_master_bus_array = array();
        foreach ($filtered_presensi as $data) {
            $filtered_master_bus = $this->Menu_model->getFilterCetakMasterBus($data['no_bus']);
            $filtered_master_bus_presentase = $this->Menu_model->getFilterCetakMasterPresentase($data['no_bus']);
            $filtered_master_bus_array[] = [
                'presensi' => $data,
                'master_bus_data' => $filtered_master_bus,
                'master_bus_presentase' => $filtered_master_bus_presentase,
            ];
        }
        echo json_encode($filtered_master_bus_array);
        // if ($filtered_presensi) {
        //     echo json_encode($filtered_presensi);
        // } else {
        //     echo json_encode(['error' => 'Data not found']);
        // }
    }

    public function get_vendor()
    {
        $per_oto_bus = $this->input->post('per_oto_bus');
        $vendor = $this->Menu_model->getJumlahDenda($per_oto_bus);

        // Mengirim jumlah denda sebagai respons AJAX
        echo json_encode($vendor);
    }
    // =============================================================================================================================================





    // =============================================================================================================================================
    public function presentasebus()
    {
        $data['title'] = 'Presentase Bus'; //Judulnya disesuaikan aja
        $data['user'] = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari tabel master_data


        // Paginationnya
        $this->load->library('pagination');

        // Config
        $config['base_url'] = 'http://localhost/miniproject/user/presentasebus';

        $data['start'] = $this->uri->segment(3);
        $data['presentase_bus'] = $this->Menu_model->getPresentaseBus();
        $data['no_bus_list'] = $this->Menu_model->getNoBusList();

        // Set rules presensinya
        $this->form_validation->set_rules('No_Bus_P', 'No. Bus', 'required');
        $this->form_validation->set_rules('Type_Bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('PO_Bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('periode_bus', 'Periode', 'required');
        $this->form_validation->set_rules('t_pnp_egm', 'Total Penumpang EGM', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mkr', 'Total Penumpang MKR', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mgf', 'Total Penumpang MGF', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mgc', 'Total Penumpang MGC', 'required|numeric');
        $this->form_validation->set_rules('t_pnp', 'Total Penumpang', 'required');
        $this->form_validation->set_rules('persentase_egm', 'Persentase EGM', 'required|decimal');
        $this->form_validation->set_rules('persentase_mkr', 'Persentase MKR', 'required|decimal');
        $this->form_validation->set_rules('persentase_mgf', 'Persentase MGF', 'required|decimal');
        $this->form_validation->set_rules('persentase_mgc', 'Persentase MGC', 'required|decimal');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('user/master_bus_presentase', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
            $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        } else {
            // $userData = $this->db->get_where('master_user', ['email' => $this->session->userdata('email')])->row_array();
            $data = [
                'No_Bus' => $this->input->post('No_Bus_P'),
                'Type_Bus' => $this->input->post('Type_Bus'),
                'PO_Bus' => $this->input->post('PO_Bus'),
                'periode' => $this->input->post('periode_bus'),
                'T_PNP_EGM' => $this->input->post('t_pnp_egm'),
                'T_PNP_MKR' => $this->input->post('t_pnp_mkr'),
                'T_PNP_MGF' => $this->input->post('t_pnp_mgf'),
                'T_PNP_MGC' => $this->input->post('t_pnp_mgc'),
                'T_PNP' => $this->input->post('t_pnp'),
                'persentase_egm' => $this->input->post('persentase_egm'),
                'persentase_mkr' => $this->input->post('persentase_mkr'),
                'persentase_mgf' => $this->input->post('persentase_mgf'),
                'persentase_mgc' => $this->input->post('persentase_mgc'),
            ];
            $this->Menu_model->insertPresentaseBus($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            redirect('user/presentasebus');
        }
    }

    public function edit_presentasebus($id)
    {
        $data['title'] = 'Edit Presentase Bus';
        // Set rules presensinya
        $this->form_validation->set_rules('No_Bus_P', 'No. Bus', 'required');
        $this->form_validation->set_rules('Type_Bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('PO_Bus', 'Type Bus', 'required');
        $this->form_validation->set_rules('periode_bus', 'Periode', 'required');
        $this->form_validation->set_rules('t_pnp_egm', 'Total Penumpang EGM', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mkr', 'Total Penumpang MKR', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mgf', 'Total Penumpang MGF', 'required|numeric');
        $this->form_validation->set_rules('t_pnp_mgc', 'Total Penumpang MGC', 'required|numeric');
        $this->form_validation->set_rules('t_pnp', 'Total Penumpang', 'required');
        $this->form_validation->set_rules('persentase_egm', 'Persentase EGM', 'required|decimal');
        $this->form_validation->set_rules('persentase_mkr', 'Persentase MKR', 'required|decimal');
        $this->form_validation->set_rules('persentase_mgf', 'Persentase MGF', 'required|decimal');
        $this->form_validation->set_rules('persentase_mgc', 'Persentase MGC', 'required|decimal');

        $this->Menu_model->edit_presentasebus($id);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diubah! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/presentasebus');
    }


    // Controller menampilkan detail dari data presensi
    public function detail_presentasebus($id)
    {
        $data['No_Bus'] = $this->Menu_model->getdetailPresentaseBus('id');

        $this->load->view('templates/header', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/sidebar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/topbar', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('user/presentasebus', $data); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
        $this->load->view('templates/footer'); //Untuk masuk ke view folder user file index untuk masuk ke halaman utama
    }

    public function deletepresentasebus($id)
    {
        $this->Menu_model->deletePresentaseBus($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Presentase Bus berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
        redirect('user/presentasebus');
        // Lalu, dalam tampilan HTML, Anda dapat menangani SweetAlert dengan JavaScript
    }

    public function get_bus_nomor()
    {
        $No_Bus = $this->input->post('No_Bus');
        $bus_nomor = $this->Menu_model->getBusNomor($No_Bus);

        if ($bus_nomor) {
            echo json_encode($bus_nomor);
        } else {
            echo json_encode(false);
        }
    }
}
