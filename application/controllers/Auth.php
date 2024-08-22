<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); //form valifation dibuat di construct agar di setiap method terpanggil tidak perlu masukin satu per satu di setiap method

    }



    public function index() // fungsi untuk controller bagian loginnya (Buat file, auth_header dan auth_footer di folder views/templates)
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email'); //Membuat rules dari email login
        $this->form_validation->set_rules('password', 'Password', 'required|trim'); //Membuat rules dari password login

        if ($this->form_validation->run() == false) { //membuat form validation login
            $data['title'] = 'Login Page';
            $this->load->view('templates/auth_header', $data); //dibuat terpisah agar nantinya halaman registrasi tidak perlu tambahkan lagi, tinggal panggil dari controller saja
            $this->load->view('auth/login', $data); //buat view login di folder views buat folders namanya auth dan nama filenya login.php buat nampilin view loginnya
            $this->load->view('templates/auth_footer'); //dibuat terpisah agar nantinya halaman registrasi tidak perlu tambahkan lagi, tinggal panggil dari controller saja
        } else {
            $this->_login();
        }
    }

    private function _login() // private agar tidak bisa diakses melalui URL
    {
        $email = $this->input->post('email'); //menangkap email yang diinputkan
        $password = $this->input->post('password'); //menangkap password yang diinputkan

        $user = $this->db->get_where('master_user', ['email' => $email])->row_array(); //select * from tabel master_user where email = email ->meminta satu baris nya data di database

        if ($user) { //mengecek apakah user nya ada dalam database
            //Jika usernya aktif maka,
            if ($user['is_active'] == 1) {
                //Cek Passwordnya
                if (password_verify($password, $user['password'])) {
                    $data = [ //simpan data ke $user yaitu email dan role_id saja
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data); //disimpan ke dalam set flashdata
                    if ($user['role_id' == 1]) { //cek role saat login, jika role_id = 1 maka masuk ke admin, tapi kalau role_id = 2 maka masuk ke member
                        redirect('admin'); //masuk ke menunya si mimin
                    } else {
                        redirect('user'); //masuk deh ke halaman utamanya, Sekarang buat file User.php di controller
                    }
                } else { //Jika password salah maka akan kembali ke halaman login
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>'); //Menampilkan notifikasi(alert) password salah
                    redirect('auth'); //dilempar kembali ke halaman login
                }
            } else { //Jika belum diaktivasi maka akan kembali ke halaman login
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email has not activated!</div>'); //Menampilkan notifikasi(alert) akun belum active
                redirect('auth'); //dilempar kembali ke halaman login
            }
        } else { //Jika belum diregistrasi maka akan kembali ke halaman login
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email is not registered!</div>'); //Menampilkan notifikasi(alert) akun tidak ada dalam database
            redirect('auth'); //dilempar kembali ke halaman login
        }
    }

    public function registration() // fungsi untuk controller bagian registrasi
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim'); //membuat rulesnya untuk input registrasi name nya
        $this->form_validation->set_rules('address', 'Address', 'required|trim'); //membuat rulesnya untuk input registrasi name nya
        $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|max_length[12]'); //membuat rulesnya untuk input registrasi name nya
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[master_user.email]', [
            'is_unique' => 'This email has already used, use the other email!' //membuat rules agar email yang sudah terpakai tidak bisa dipakai lagi
        ]); //membuat rulesnya untuk input registrasi email nya

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password dont match!', //Pesan jika input password tidak sama
            'min_length' => 'Password too short!' //Pesan jika input password terlalu pendek
        ]); //membuat rulesnya untuk input registrasi email nya
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|min_length[8]|matches[password1]'); //membuat rulesnya untuk input registrasi email nya

        if ($this->form_validation->run() == false) { //mengecek apakah proses registrasi sudah dilakukan dengan benar atau belum, jika gagal maka akan menampilkan halaman registrasi kembali
            $data['title'] = 'User Registration'; //Buat bikin judul halaman websitenya 
            $this->load->view('templates/auth_header', $data); //dibuat terpisah agar nantinya halaman registrasi tidak perlu tambahkan lagi, tinggal panggil dari controller saja
            $this->load->view('auth/registration', $data); //buat view login di folder views buat folders namanya auth dan nama filenya login.php buat nampilin view loginnya
            $this->load->view('templates/auth_footer'); //dibuat terpisah agar nantinya halaman registrasi tidak perlu tambahkan lagi, tinggal panggil dari controller saja 
        } else { //jika benar maka akan ada tampilan berhasil melakukan registrasi dan kembali ke halaman login dan melakukan login
            $data = [  // Data yang sudah diinputkan akan di post dan selanjutnya dibawah $data ini akan di inputkan ke database, data ini harus urut sesuai dengan isi tabel master_user agar saat proses input ke database dibawah tidak terjadi error
                'name' => htmlspecialchars($this->input->post('name', true)),
                'address' => htmlspecialchars($this->input->post('address', true)),
                'phone_number' => htmlspecialchars($this->input->post('phone_number', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'),  PASSWORD_DEFAULT),
                'role_id' => 2, // mengapa diisi 2, kita anggap bahwa semua yang melakukan registrasi adalah member
                'is_active' => 1,
                'date_created' => time(),
            ];

            $this->db->insert('master_user', $data); // data yang diatas dimasukkan kesini dengan db(database)->insert(menambahkan ke database)
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Your account has been registered! Please Login. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
            redirect('auth'); //setelah berhasil, dilempar kembali ke halaman login
        }
    }

    public function logout() //method logout
    {
        // bersikan sessionnya ketika logout
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout! <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); //Menampilkan notifikasi(alert) jika berhasil melakukan registrasi kemudian panggil fungsi ini ke page login
        redirect('auth'); //setelah berhasil, dilempar kembali ke halaman login
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
